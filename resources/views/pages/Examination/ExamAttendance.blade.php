@extends('layout.App')
@section('MainContent')
    <!-- START EXAM ATTENDANCE HEADING -->
    <section class="section-examSchedule--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Exam Attendance</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END EXAM ATTENDANCE HEADING -->
    <form id="ExamAttendanceForm" action="/examination/attendance/save" method="post">
    @csrf
    <!-- START EXAM ATTENDANCE CRITERIA -->
    <section
        class="section-examAttendance--criteria section-criteria u-padding-lg pt-0 mx-2"
    >
        <div class="card">
            <div class="card-title">
                <h3 class="heading--sub">Select Criteria</h3>
            </div>
            <div class="card-body">
                <div class="d-flex input-daterange">
                    <input
                        id="examDate"
                        type="text"
                        name="dob"
                        class="form-control"
                        placeholder="Exam Date"
                    />
                </div>
                <select name="exam_type" id="selectExamType">
                    <option  class="dropdown-item" value="">Select Exam Type</option>
                    @foreach($exam_types as $type)
                        <option value="{{$type->id}}" class="dropdown-item">{{$type->name}}</option>
                    @endforeach
                </select>
                <select name="class" id="selectClass">
                    <option class="dropdown-item" value="">Select Class</option>
                    @foreach($classes as $class)
                        <option value="{{$class->id}}" class="dropdown-item">{{$class->name}}</option>
                    @endforeach
                </select>
                <select name="section" id="selectSection">
                    <option class="dropdown-item" value="">Select Section</option>
                </select>
                <select name="subject" id="selectSubject">
                    <option class="dropdown-item" value="">Select Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{$subject->id}}" class="dropdown-item">{{$subject->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </section>
    <!-- END EXAM ATTENDANCE CRITERIA -->

    <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
    <!-- START CREATE EXAM ATTENDANCE -->
    <section id="AttendanceArea" class="section-examAttendance--create u-padding-lg pt-0 d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">
                                <span id="examName"></span> Attendance
                              </h3>
                              <button
                                type="button"
                                class="btn btn-text bg-danger px-4 py-2"
                                id="deleteAttendanceBtn"
                              >
                                <i class="bi bi-trash me-1"></i>
                                Delete
                              </button>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 44vh">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Registration Number</th>
                                    <th>Roll Number</th>
                                    <th>Class(Section)</th>
                                    <th>Student Name</th>
                                    <th>Attendance</th>
                                </tr>
                                </thead>
                                <tbody id="ListTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-text">✔ Save</button>
                </div>
            </div>
        </div>
    </section>
    <!-- END CREATE EXAM ATTENDANCE -->

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
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'dd/mm/yyyy',
            autoclose: true,
        });
    </script>


    <script>
        let selectClass = $('#selectClass');
        let selectExamType = $('#selectExamType');
        let selectSection = $('#selectSection');
        let selectSubject = $('#selectSubject');
        let examDate = $('#examDate');
        let table = $('#ListTable');


        Selectize(selectExamType);
        Selectize(selectSection);
        Selectize(selectSubject);

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
                $('#AttendanceArea').addClass('d-none');
            }
        });

        selectExamType.on('change', function () {
            GetAttendanceItems()
        });

        selectSection.on('change', function () {
            GetAttendanceItems()
        });
        selectSubject.on('change', function () {
            GetAttendanceItems()
        });



        $('#deleteAttendanceBtn').on('click', function () {
            if(selectClass.val() != "" && selectSection.val() != "" && selectExamType.val() != "" && selectSubject.val() != "") {
                PreloaderON();
                let data = {
                    'exam_id' : selectExamType.val(),
                    'class_id' : selectClass.val(),
                    'section_id' : selectSection.val(),
                    'subject_id' : selectSubject.val(),
                };
                let url = "/examination/attendance/delete";

                console.log(data)
                axios.post(url, data)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        window.location.reload();
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                    console.log(error)
                })

            }
        });


        function GetAttendanceItems(){
            if(selectClass.val() != "" && selectSection.val() != "" && selectExamType.val() != "" && selectSubject.val() != "" && examDate.val() != "" ){

                let splitDate = examDate.val().split('/');
                let newDate = splitDate[2] + "-" + splitDate[1] + "-" + splitDate[0];

                PreloaderON();

                axios.get(`/examination/exam-schedule/check/${selectExamType.val()}/${selectClass.val()}/${selectSection.val()}/${selectSubject.val()}/${newDate}`)
                    .then(function (check_response) {
                        PreloaderOFF();
                        if(check_response.status === 200 && check_response.data.status === true){
                            get();
                        }
                        else{
                            table.empty();
                            Toast(check_response.data.message);
                        }
                    })
                    .catch(function (check_error) {
                        PreloaderOFF()
                        console.log(check_error)
                        Toast("Server Error")
                    });




                function get() {
                    $('#examName').html(selectExamType.text());
                    axios.get(`/examination/attendance/get-student/${selectClass.val()}/${selectSection.val()}/${selectSubject.val()}/${selectExamType.val()}`)
                        .then(function (response) {
                            PreloaderOFF();
                            if(response.status === 200){
                                let action = response.data.action;
                                let data = response.data.info;
                                table.empty();
                                if(data.length > 0){
                                    $('#AttendanceArea').removeClass('d-none');
                                    if(action == "create"){
                                        $('#ExamAttendanceForm').attr('action', '/examination/attendance/save');
                                        data.forEach(function (item) {
                                            ListItem(item);
                                        });
                                    }
                                    else if(action == "update"){
                                        $('#ExamAttendanceForm').attr('action', '/examination/attendance/update');
                                        data.forEach(function (item) {
                                            UpdateListItem(item);
                                        });
                                    }
                                }
                                else{
                                    $('#AttendanceArea').addClass('d-none');
                                    Toast("Not found");
                                }
                            }
                        })
                        .catch(function (error) {
                            PreloaderOFF();
                        });
                }
            }else{
                $('#AttendanceArea').addClass('d-none');
            }
        }


        function ListItem(item) {
            table.append(`
                 <tr>
                    <td scope="row">${(item.students.registration_number)}</td>
                    <td>${(item.students.roll)}</td>
                    <td>${selectClass.text()}(${selectSection.text()})</td>
                    <td>${(item.students.name)}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input type="hidden" name="student_id[]" value="${item.student_id}">
                            <input
                                name="student${item.student_id}"
                                class="form-check-input"
                                type="checkbox"
                                ${(item.status == "1") ? "checked" : "" }
                            />
                        </div>
                    </td>
                </tr>
            `);
        }

        function UpdateListItem(item) {
            table.append(`
                 <tr>
                    <td scope="row">${(item.student_data != null) ? item.student_data.registration_number : ""}</td>
                    <td>${(item.student_data != null) ? item.student_data.roll : ""}</td>
                    <td>${selectClass.text()}(${selectSection.text()})</td>
                    <td>${(item.student_data != null) ? item.student_data.name : ""}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input type="hidden" name="student_id[]" value="${item.student_id}">
                            <input
                                name="student${item.student_id}"
                                class="form-check-input"
                                type="checkbox"
                                ${(item.status == "1") ? "checked" : "" }
                            />
                        </div>
                    </td>
                </tr>
            `);
        }



    </script>
@endsection
