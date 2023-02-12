@extends('layout.App')
@section('MainContent')
<!-- START STUDENT ATTENDANCE HEADING -->
<section class="section-studentAttendance--heading u-padding-lg">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="heading--main">Student Attendance</h2>
            </div>
        </div>
    </div>
</section>
<!-- END STUDENT ATTENDANCE HEADING -->

<form action="/student/attendance" id="stdAttendanceForm" method="post">
    @csrf
    <!-- START STUDENT ATTENDANCE CRITERIA -->
    <section class="section-studentAttendance--criteria section-criteria u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Select Criteria</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-4">
                                <select required="" name="class" id="selectClass">
                                    <option  class="dropdown-item" value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}"  class="dropdown-item">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select required name="section" id="sectionList">
                                    <option class="dropdown-item" value="">Select Section</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="dropdown">
                                    <div class="d-flex input-daterange">
                                        <input name="date" type="text" id="date" class="form-control btn-dropdown m-0" placeholder="Attendance Date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STUDENT ATTENDANCE CRITERIA -->

    <div class="container d-none" id="StudentAttendanceArea">
        <div class="row u-padding-lg pt-0">
            <div class="col-md-12">
                <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
                <!-- START MARK STUDENT ATTENDANCE-->
                <section class="section-studentAttendance--list">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Mark Student Attendance</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 52vh; min-height: 47.5vh;">
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
                                <tbody id="StudentListTable">

                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-text mt-4">Save </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END MARK STUDENT ATTENDANCE -->
            </div>
        </div>
    </div>

</form>
@endsection

@section('scripts-before')
    <!-- Selectize JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    <!--Calendar JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
@endsection
@section('scripts-last')
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
        let table = $('#StudentListTable');
        let classElem = $('#selectClass');
        let sectionElem = $('#sectionList');
        let dateElem = $("#date");

        Selectize($('#sectionList'));
        $('#selectClass').selectize({
            onChange: function (value){
                $('#StudentAttendanceArea').addClass('d-none');
                $('#sectionList').each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });
                axios.get('/class-wise-section/'+value)
                    .then(function(response){
                        if(response.status == 200){
                            let data = response.data;
                            let sectionList = $('#sectionList');
                            sectionList.empty();
                            sectionList.append(`
                                <option class="dropdown-item" value="">Select Section</option>
                            `);
                            data.forEach(function (item){
                                sectionList.append(`
                                    <option value="${item.id}" class="dropdown-item">${item.name}</option>
                                `);
                            });
                            Selectize(sectionList);
                        }
                    })
                    .catch(function (error){
                        console.log(error)
                    });
                // GetAttendance();
            }
        });

        sectionElem.on('change', function () {
            GetAttendance();
        });

        dateElem.on('change', function () {
            GetAttendance();
        });



        function GetAttendance() {
            if(classElem.val() != "" && sectionElem.val() != "" && dateElem.val() != ""){
                PreloaderON();
                $('#StudentAttendanceArea').removeClass('d-none');
                let date = dateElem.val();
                date = date.split('/');
                date = date[2]+"-"+date[1]+"-"+date[0];
                axios.get(`/student/attendance/get/${classElem.val()}/${sectionElem.val()}/${date}`)
                .then(function (response) {
                    PreloaderOFF();
                    if(response.status === 200){
                        let action = response.data.action;
                        let form = $('#stdAttendanceForm');
                        let data = response.data.info;
                        table.empty();
                        if(action == "create"){
                            form.attr('action','/student/attendance')
                            data.forEach(function (item, index) {
                                StdAttendance(table,item, index);
                            });
                        }else if(action == "update"){
                            form.attr('action', '/student/attendance/update')
                            data.forEach(function (item, index) {
                                StdAttendance(table,item, index);
                            });
                        }
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                    Toast("Server Error.")
                });
            }
            else{
                $('#StudentAttendanceArea').addClass('d-none');
                console.log("empty");
            }
        }





        function StdAttendance(table, item, index) {
            table.append(`
                <tr>
                    <td scope="row">
                      ${item.student.registration_number}
                    </td>
                    <td>${item.student.roll}</td>
                    <td>${classElem.text()}(${sectionElem.text()})</td>
                    <td>${item.student.name}</td>
                    <td>
                      <input type="hidden" name="student_ids[]" value="${item.std_id}">
                      <select id="att_row_${index}" required name="attendance_${item.std_id}" id="selected">
                          <option class="dropdown-item" value="" >Attendance Type</option>
                          <option value="0" ${(item.remark == "0") ? "selected" : "" } class="dropdown-item">Present</option>
                          <option value="1" ${(item.remark == "1") ? "selected" : "" } class="dropdown-item">Late</option>
                          <option value="2" ${(item.remark == "2") ? "selected" : "" } class="dropdown-item">Absent</option>
                          <option value="3" ${(item.remark == "3") ? "selected" : "" } class="dropdown-item">Half Day</option>
                      </select>
                    </td>
                  </tr>
            `);

            Selectize($('#att_row_'+index));
        }


    </script>
@endsection
