@extends('layout.App')
@section('MainContent')
    <!-- START ADD MARKS HEADING -->
    <section class="section-addMarks--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Add Marks</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END ADD MARKS HEADING -->

    <form action="/examination/add-mark/save" id="MarksForm" method="post">
        @csrf
        <!-- START ADD MARKS CRITERIA -->
        <section
            class="section-addMarks--criteria section-criteria u-padding-lg pt-0 mx-2"
        >
            <div class="card">
                <div class="card-title">
                    <h3 class="heading--sub">Select Criteria</h3>
                </div>
                <div class="card-body">
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
        <!-- END ADD MARKS CRITERIA -->

        <!-- START CREATE ADD MARKS-->
        <section class="section-addMarks--create d-none u-padding-lg pt-0" id="MarksArea">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-title d-flex justify-content-between me-5">
                                <h3 class="heading--sub">Add Marks</h3>
                            </div>
                            <div class="card-body table-scrollable" style="overflow: auto; max-height: 44vh">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Registration Number</th>
                                        <th>Roll Number</th>
                                        <th>Class(Section)</th>
                                        <th>Student Name</th>
                                        <th>Total Marks</th>
                                        <th>Obtained Marks</th>
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
                    <div class="col-md-12 text-center mt-4">
                        <button type="submit" class="btn btn-text">✔ Save</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- END CREATE ADD MARKS -->
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
        let selectClass = $('#selectClass');
        let selectExamType = $('#selectExamType');
        let selectSection = $('#selectSection');
        let selectSubject = $('#selectSubject');
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

        /*       selectExamType.selectize({
                   onChange: function (value) {
                       GetAttendanceItems()
                   }
               });*/
        selectExamType.on('change', function () {
            GetMarksItems()
        });

        selectSection.on('change', function () {
            GetMarksItems()
        });
        selectSubject.on('change', function () {
            GetMarksItems()
        });


        function GetMarksItems(){
            if(selectClass.val() != "" && selectSection.val() != "" && selectExamType.val() != "" && selectSubject.val() != ""){
                $('#MarksArea').removeClass('d-none');
                axios.get(`/examination/mark/get/${selectClass.val()}/${selectSection.val()}/${selectSubject.val()}/${selectExamType.val()}`)
                    .then(function (response) {
                        console.log(response)
                        if(response.status === 200){
                            let action = response.data.action;
                            let total_marks = response.data.total_marks;
                            let data = response.data.info;
                            console.log(response.data)
                            if(action == "error"){
                                $('#MarksArea').addClass('d-none');
                                Toast("Attendance not found.");
                            }
                            else if(action == "create"){
                                $('#MarksForm').attr('action', '/examination/add-mark/save');
                                table.empty()
                                data.forEach(function (item) {
                                    ListItem(item, total_marks);
                                });
                            }
                            else if(action == "update"){
                                $('#MarksForm').attr('action', '/examination/add-mark/update');
                                table.empty()
                                data.forEach(function (item) {
                                    UpdateList(item, total_marks);
                                });
                            }
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            }else{
                $('#MarksArea').addClass('d-none');
            }
        }


        function ListItem(item, total_marks) {
            table.append(`
                 <tr>
                    <td scope="row">15134</td>
                    <td>${item.students.roll} </td>
                    <td>${selectClass.text()}(${selectSection.text()})</td>
                    <td>${item.students.name}</td>
                    <td>${total_marks}</td>
                    <td>
                        <input type="hidden" name="student_id[]" value="${item.student_id}">
                        <input type="text" value="${(item.marks != "0" ? item.marks  : "")}" name="student${item.student_id}" class="w-25 form-control" />
                    </td>
                </tr>
            `);
        }

        function UpdateList(item, total_marks) {
            table.append(`
                 <tr>
                    <td scope="row">${(item.student_data != null) ? item.student_data.registration_number : "-"}</td>
                    <td>${(item.student_data != null) ? item.student_data.roll : "-"} </td>
                    <td>${selectClass.text()}(${selectSection.text()})</td>
                    <td>${(item.student_data != null) ? item.student_data.name : "-"}</td>
                    <td>${total_marks}</td>
                    <td>
                        <input type="hidden" name="student_id[]" value="${item.student_id}">
                        <input type="text" value="${(item.marks != "0" ? item.marks  : "")}" name="student${item.student_id}" class="w-25 form-control" />
                    </td>
                </tr>
            `);
        }


    </script>
@endsection
