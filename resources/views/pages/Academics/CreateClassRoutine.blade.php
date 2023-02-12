@extends('layout.App')
@section('MainContent')


{{--
    @if(session("message"))
        <h5>{{session("message")}}</h5>
    @endif
--}}

    <!-- START CREATE CLASS ROUTINE HEADING -->
<section class="section-classRoutine--heading u-padding-lg">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="heading--main">Create Class Routine </h2>
            </div>
        </div>
    </div>
</section>
<!-- END CREATE CLASS ROUTINE HEADING -->

<!-- START CREATE CLASS ROUTINE CRITERIA -->
<form id="Form" action="/academics/routine" method="post">
    @csrf
    <section class="section-classRoutine--criteria  section-criteria u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Select Criteria</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6">
                                <select name="class" id="selectClass">
                                    <option class="dropdown-item" value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}" class="dropdown-item">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="section" id="sectionList" style="visibility: hidden;">
                                    <option class="dropdown-item" value="">Select Section</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- END CREATE CLASS ROUTINE CRITERIA -->

<!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
<!-- START CREATE CLASS ROUTINE -->
    <section id="RoutineItems" class="section-classRoutine--create d-none u-padding-lg pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-title d-flex justify-content-between me-5">
                                <h3 class="heading--sub">Create Class Routine</h3>
                                <!-- ADDS NEW ROW TO TABLE -->
                                <button id="addRoutineItemBtn" type="button" class="btn btn-text px-4">+ ADD</button>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>Subject</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Room</th>
                                        <th>Teacher</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="Items">
                                        {{--<tr id="row1">
                                            <td scope="row">
                                                <select id="selectDay1" name="day[]" class="px-1">
                                                    <option class="dropdown-item" value="">Select Day</option>
                                                    <option value="1" class="dropdown-item">Sunday</option>
                                                    <option value="2" class="dropdown-item">Monday</option>
                                                    <option value="3" class="dropdown-item">Tuesday</option>
                                                    <option value="4" class="dropdown-item">Wednesday</option>
                                                    <option value="5" class="dropdown-item">Thursday</option>
                                                    <option value="6" class="dropdown-item">Friday</option>
                                                    <option value="7" class="dropdown-item">Saturday</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="selectSubject1" name="subject[]">
                                                    <option class="dropdown-item"  value="">Select Subject</option>
                                                    @foreach($subjects as $subject)
                                                        <option value="{{$subject->id}}" class="dropdown-item">{{$subject->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="starttime[]" id="starttime1" />
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="endtime[]" id="endtime1" />
                                            <td>
                                                <input type="text" class="form-control" name="room[]" placeholder="Room" />
                                            </td>
                                            <td>
                                                <select id="selectTeacher1" name="teacher[]" placeholder="Select teacher">
                                                    <option class="dropdown-item" value="">Select Teacher</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{$teacher->id}}" class="dropdown-item">{{$teacher->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn p-0">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </button>
                                            </td>
                                        </tr>--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center mt-4">
                        <button type="submit" class="btn btn-text">✔ Save</button>
                    </div>
                </div>
            </div>
            </div>
        </section>
</form>
<!-- END CREATE CLASS ROUTINE -->
@endsection

@section('scripts-last')
    <!-- Selectize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    <!-- Include Bootstrap DateTimePicker JS -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
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

        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'dd/mm/yyyy',
            autoclose: true,
        });
    </script>
    <script>


        let row = 1;

        Time(1)
        function Time(id){
            $('#starttime'+id).datetimepicker({
                format: 'hh:mm:ss',
            });
            $('#endtime'+id).datetimepicker({
                format: 'hh:mm:ss',
            });
        }


        let selectClassElem = $('#selectClass');
        let sectionListElem = $('#sectionList');
        let RoutineElem = $('#RoutineItems');
        let items = $('#Items');


        let elemDay = '#selectDay';
        let elemTeacher = '#selectTeacher';
        let elemSubject = '#selectSubject';
        let elemStartTime = '#starttime';
        let elemEndTime = '#endtime';

        Selectize(sectionListElem)
        Selectize(sectionListElem)

        Selectize($(elemDay+row))
        Selectize($(elemTeacher+row))
        Selectize($(elemSubject+row))

        selectClassElem.selectize({
            onChange: function (value){
                sectionListElem.each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });
                axios.get('/class-wise-section/'+value)
                    .then(function(response){
                        if(response.status == 200){
                            let data = response.data;
                            sectionListElem.empty();
                            sectionListElem.append(`
                                <option class="dropdown-item" value="">Select Section</option>
                            `);
                            data.forEach(function (item){
                                sectionListElem.append(`
                                    <option value="${item.id}" class="dropdown-item">${item.name}</option>
                                `);
                            });
                            Selectize(sectionListElem)
                        }
                    })
                    .catch(function (error){
                        console.log(error)
                    });
            }
        });


        selectClassElem.on('change', function () {
            ShowRoutineItems();
            RoutineElem.addClass('d-none')
        })

        sectionListElem.on('change', function () {
            ShowRoutineItems();
        });


        function ShowRoutineItems(){
            if(selectClassElem.val() != "" && sectionListElem.val() != ""){
                PreloaderON();
                axios.get(`/academics/routine/${selectClassElem.val()}/${sectionListElem.val()}`)
                    .then(function (response) {
                        if(response.status === 200){
                            PreloaderOFF();
                            RoutineElem.removeClass('d-none');
                            let form = $('#Form');
                            items.empty();
                            let action = response.data.action;
                            let routines = response.data.routines;
                            if(action == 'create'){
                                form.attr('action', "/academics/routine");
                                items.append(RoutineItem(++row, null));
                            }
                            else if(action == 'update'){
                                form.attr('action', "/academics/routine/update");
                                routines.forEach(function(item){
                                    items.append(RoutineItem(++row, item));
                                });
                            }
                        }
                    })
                    .catch(function (error) {
                        Toast("Server Error")
                        PreloaderOFF();
                    });
            }
            else{
                RoutineElem.addClass('d-none');
            }
        }


        //Add Items
        $('#addRoutineItemBtn').on('click', function(){
            items.append(RoutineItem(++row));
        });

        //Delete Item
        $('#Items').on('click', '.delete-btn', function () {
           $(this).parent().parent().remove();
        });

        function RoutineItem(itemNo, object){
            items.append(`
                     <tr id="row${itemNo}">
                        <td scope="row">
                            <select id="selectDay${itemNo}" name="day[]" class="px-1">
                                <option class="dropdown-item" value="">Select Day</option>
                                <option value="1" class="dropdown-item">Sunday</option>
                                <option value="2" class="dropdown-item">Monday</option>
                                <option value="3" class="dropdown-item">Tuesday</option>
                                <option value="4" class="dropdown-item">Wednesday</option>
                                <option value="5" class="dropdown-item">Thursday</option>
                                <option value="6" class="dropdown-item">Friday</option>
                                <option value="7" class="dropdown-item">Saturday</option>
                            </select>
                        </td>
                        <td>
                            <select id="selectSubject${itemNo}" name="subject[]">
                                <option class="dropdown-item"  value="">Select Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}" class="dropdown-item">{{$subject->name}}</option>
                                @endforeach
                            </select>
                        </td>
                         <td>
                            <input value="${(object != null) ? object.start_time : ""}" class="form-control" type="text" name="starttime[]" id="starttime${itemNo}" />
                        </td>
                        <td>
                            <input value="${(object != null) ? object.end_time : ""}" class="form-control" type="text" name="endtime[]" id="endtime${itemNo}" />
                        <td>
                            <input value="${(object != null) ? object.room_number : ""}" type="text" class="form-control" name="room[]" placeholder="Room" />
                        </td>
                        <td>
                            <select id="selectTeacher${itemNo}" name="teacher[]" placeholder="Select teacher">
                                <option class="dropdown-item" value="">Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}" class="dropdown-item">{{$teacher->name}}</option>
                                @endforeach
                            </select>
                         </td>

                        <td>
                            <button row-id=${itemNo} type="button" class="btn delete-btn p-0">
                                <i class="bi bi-trash  text-danger"></i>
                            </button>
                        </td>
                    </tr>
                `);

            Selectize($(elemDay+itemNo));
            Selectize($(elemTeacher+itemNo));
            Selectize($(elemSubject+itemNo));
            Time(itemNo);

            if(object != null){
                $(elemDay+itemNo).data('selectize').setValue(object.day);
                $(elemTeacher+itemNo).data('selectize').setValue(object.teacher);
                $(elemSubject+itemNo).data('selectize').setValue(object.subject);
            }

        }
    </script>
@endsection
