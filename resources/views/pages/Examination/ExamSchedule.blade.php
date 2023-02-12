@extends('layout.App')
@section('MainContent')

    <!-- START EXAM SCHEDULE HEADING -->
    <section class="section-examSchedule--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Exam Schedule</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END EXAM SCHEDULE HEADING -->
    <form action="/examination/exam-schedule/save" id="Form" method="post">
    @csrf
    <!-- START EXAM SCHEDULE CRITERIA -->
    <section
        class="section-examSchedule--criteria section-criteria u-padding-lg pt-0 mx-2"
    >
        <div class="card">
            <div class="card-title">
                <h3 class="heading--sub">Select Criteria</h3>
            </div>
            <div class="card-body">
                <select name="exam_type_id" id="selectExamType" class="w-100">
                    <option class="dropdown-item" value="">Select Exam Type</option>
                    @foreach($exam_types as $type)
                        <option value="{{$type->id}}" class="dropdown-item">{{$type->name}}</option>
                    @endforeach
                </select>
                <select name="class_id" id="selectClass" class="w-100">
                    <option class="dropdown-item" value="">Select Class</option>
                    @foreach($classes as $class)
                        <option value="{{$class->id}}" class="dropdown-item">{{$class->name}}</option>
                    @endforeach
                </select>
                <select name="section_id" id="selectSection" class="w-100">
                    <option class="dropdown-item" value="">Select Section</option>
                </select>
            </div>
        </div>
    </section>
    <!-- END EXAM SCHEDULE CRITERIA -->

    <!-- START CREATE EXAM SCHEDULE -->
    <section id="ScheduleArea" class="section-examSchedule--create u-padding-lg pt-0 d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="min-width: min-content">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">
                                <span id="examName"></span> | <span>Bangla</span>
                            </h3>
                            <!-- ADDS NEW ROW TO TABLE -->
                            <button id="addItemBtn" type="button" class="btn btn-text me-5 px-4">
                                + ADD
                            </button>
                        </div>
                        <div
                            class="card-body table-scrollable"
                            style="max-height: 68vh; max-width: 70vw; overflow: auto"
                        >
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Total Marks</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Teacher</th>
                                    <th>Guard</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Room</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="ScheduleItems">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mt-4">
                    <button type="submit" class="btn btn-text">✔ Save</button>
                </div>
            </div>
        </div>
    </section>
    <!-- END CREATE EXAM SCHEDULE -->
    </form>
@endsection
@section('scripts-last')
    <!-- Selectize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    <!--Calendar JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>

    <!-- Include Moment.js CDN -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <!-- Include Bootstrap DateTimePicker JS -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>


    <!-- CUSTOM JS -->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <!-- Filter items in dropdowns -->
    <script src="{{asset('assets/js/filter.js')}}"></script>
    <script>
        let date = new Date();

    </script>


    <script>
        let row = 1;

        function Time(id){
            $('#starttime'+id).datetimepicker({
                format: 'hh:mm:ss',
            });
            $('#endtime'+id).datetimepicker({
                format: 'hh:mm:ss',
            });
        }
        let form = $('#Form');
        let selectClass = $('#selectClass');
        let selectExamType = $('#selectExamType');
        let selectSection = $('#selectSection');
        let selectSubject = '#selectSubject';
        let selectTeacher = '#selectTeacher';
        let selectGuard = '#selectGuard';
        let table = $('#ScheduleItems');


        Selectize(selectExamType);
        Selectize(selectSection);

        selectClass.selectize({
            onChange: function (value){
                selectSection.each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });
                axios.get('/class-wise-section/'+value)
                .then(function(response){
                    if(response.status == 200){
                        let data = response.data;
                        selectSection.empty();
                        selectSection.append(`
                            <option class="dropdown-item" value="">Select Section</option>
                        `);
                        data.forEach(function (item){
                            selectSection.append(`
                                <option value="${item.id}" class="dropdown-item">${item.name}</option>
                            `);
                        });
                        Selectize(selectSection)
                    }
                })
                .catch(function (error){
                    console.log(error)
                });
                $('#ScheduleArea').addClass('d-none');
                GetExamSchedule();
            }
        });

        selectExamType.selectize({
            onChange: function (value) {

            }
        });

        selectExamType.on('change', function () {
            GetExamSchedule()
        })


        selectSection.on('change', function () {
            GetExamSchedule();
        });

        function GetExamSchedule(){

            if(selectClass.val() != "" && selectSection.val() != "" && selectExamType.val() != ""){
                $('#examName').html(selectExamType.text());
                $('#ScheduleArea').removeClass('d-none');
                PreloaderON();

                let url = `/examination/exam-schedule/get/${selectExamType.val()}/${selectClass.val()}/${selectSection.val()}`
                axios.get(url)
                .then(function (response) {
                    if (response.status === 200){
                        PreloaderOFF();
                        table.empty();
                        let action = response.data.action;
                        let data = response.data.data;
                        if(action == "update"){
                            form.attr('action', '/examination/exam-schedule/update');
                            data.forEach(function (item) {
                                ScheduleItem(++row, item);
                            })
                        }
                        else if(action == "create"){
                            form.attr('action', '/examination/exam-schedule/save');
                            ScheduleItem(row, null);
                        }
                    }
                })
                .catch(function (error) {
                    console.log(error)
                })

            }else{
                $('#ScheduleArea').addClass('d-none');
            }
        }

        //Add Exam Schedule Item
        $('#addItemBtn').on('click', function(){
           ScheduleItem(++row, null);
        });

        //Remove Schedule Item
        table.on('click', '.delete', function () {
            let rowID = $(this).attr('row-id');
            $('#row-' + rowID).remove();
        });


        function ScheduleItem(id, data) {
            let convertDate;
            if(data != null){
                let  dte = data.exam_date;
                let splitDate = dte.split('-');
                convertDate = `${splitDate[2]}/${splitDate[1]}/${splitDate[0]}`;
            }else{
                let convertDate = "";
            }

            // return console.log(convertDate);
            table.append(`
                 <tr id="row-${id}">
                    <td scope="row">
                        <select required name="subject[]" id="selectSubject${id}">
                            <option class="dropdown-item" value="">
                                Select Subject
                            </option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}"  class="dropdown-item">{{$subject->name}}</option>
                            @endforeach
                        </select>
                        </td>
                        <td>
                            <input required type="text" value="${(data != null ) ? data.total_marks : "" }" name="total_marks[]" class="form-control" />
                        </td>
                        <td>${selectClass.text()}</td>
                        <td>${selectSection.text()}</td>
                        <td>
                            <select required name="teacher[]" id="selectTeacher${id}" placeholder="Select teacher">
                                <option class="dropdown-item" value="">
                                    Select Teacher
                                </option>
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}" class="dropdown-item">{{$teacher->name}}</option>
                                @endforeach

                            </select>
                        </td>
                        <td>
                            <select required name="guard[]" id="selectGuard${id}" placeholder="Select guard">
                                <option class="dropdown-item" value="">
                                    Select Guard
                                </option>
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}"  class="dropdown-item">{{$teacher->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <div class="d-flex input-daterange">
                                <input required value="${(data != null ) ? convertDate : "" }" name="exam_date[]" type="text" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <input
                                required
                                name="start_time[]"
                                class="form-control"
                                type="text"
                                id="starttime${id}"
                                value = " ${(data != null ) ? data.start_time : "" }"
                            />
                        </td>
                        <td>
                            <input
                                name="end_time[]"
                                class="form-control"
                                type="text"
                                id="endtime${id}"
                                value="${(data != null ) ? data.end_time : "" }"
                                required
                            />
                        </td>
                        <td>
                            <input
                                name="room_number[]"
                                class="form-control"
                                type="text"
                                placeholder="Room"
                                value = " ${(data != null ) ? data.room_number : "" }"
                                required
                            />
                        </td>
                        <td>
                            <button type="button" row-id="${id}" class="btn delete p-0">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                        </td>
                    </tr>
                `);

            $(`#selectSubject${id}`).val(
                (data != null) ? data.subject : ""
            );

            $(`#selectTeacher${id}`).val(
                (data != null) ? data.teacher : ""
            );

            $(`#selectGuard${id}`).val(
                (data != null) ? data.guard : ""
            );



            Selectize($(selectSubject+id));
            Selectize($(selectTeacher+id));
            Selectize($(selectGuard+id));
            Time(id);
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'dd/mm/yyyy',
                autoclose: true,
            });
        }
    </script>
@endsection
