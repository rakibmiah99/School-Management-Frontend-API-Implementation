@extends('layout.App')
@section('MainContent')
    <!-- START EMPLOYEE ATTENDANCE HEADING -->
    <section class="section-employeeAttendance--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="heading--main">Employee Attendance</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END EMPLOYEE ATTENDANCE HEADING -->

    <!-- START EMPLOYEE ATTENDANCE CRITERIA -->
    <section class="section-employeeAttendance--criteria section-criteria u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Select Criteria</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6">
                                <div class="dropdown">
                                    <div class="d-flex input-daterange">
                                        <input type="text" id="date" class="form-control btn-dropdown m-0" placeholder="Attendance Date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END EMPLOYEE ATTENDANCE CRITERIA -->

    <div class="container d-none" id="AttendanceListArea">
        <div class="row u-padding-lg pt-0">

            <div class="col-md-12">
                <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
                <!-- START MARK EMPLOYEE ATTENDANCE-->
                <section class="section-employeeAttendance--list">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Mark Employee Attendance</h3>
                            <div>
                                <button id="presentAllBtn" type="button" class="btn btn-text px-4 py-2 me-4">All Present </button>
                                <button type="button" id="absentAllBtn" class="btn btn-text px-4 py-2">All Absent</button>
                            </div>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 52vh; min-height: 47.5vh;">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Employee Type</th>
                                    <th>Employee Name</th>
                                    <th>Attendance</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody id="tableBody">

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-end p-0">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </section>
                <!-- END MARK EMPLOYEE ATTENDANCE -->
            </div>
        </div>
    </div>
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
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'dd/mm/yyyy',
            autoclose: true,
        });
    </script>

    <script>
        //Selectize
        Selectize($('#sectionList'))
        Selectize($('#selectBloodGroup'))
        Selectize($('#selectGender'))
        Selectize($('#selectReligion'))
        Selectize($('#employeeType'))
        //End Selectize

        let attendanceListArea = $('#AttendanceListArea');
        let table = $('#tableBody');
        let dateElem = $('#date');
        dateElem.on('change', function () {
            attendanceListArea.addClass('d-none');
            let getDate = $(this).val().split('/');
            let newDate = getDate[2] + "-" + getDate[1] + "-" + getDate[0];

            Get(newDate);
        });


        //PRESENT ALL
        $('#presentAllBtn').on('click', function () {
            let getDate = dateElem.val().split('/');
            let newDate = getDate[2] + "-" + getDate[1] + "-" + getDate[0];
            let url = `/employee/present-all/${newDate}`;
            axios.get(url)
            .then(function (response) {
                if(response.status === 200){
                    Get(newDate);
                }
            })
            .catch(function (error) {
                console.log(error)
            })
        });

        //ABSENT ALL
        $('#absentAllBtn').on('click', function () {
            let getDate = dateElem.val().split('/');
            let newDate = getDate[2] + "-" + getDate[1] + "-" + getDate[0];
            let url = `/employee/absent-all/${newDate}`;
            axios.get(url)
            .then(function (response) {
                if(response.status === 200){
                    Get(newDate);
                }
            })
            .catch(function (error) {
                console.log(error)
            })
        });

        table.on('change', '.change-attendance', function () {
           let remark = $(this).val();
           let emp_id = $(this).attr('emp-id');
           let url = `/employee/attendance`;
           let getDate = dateElem.val().split('/');
           let newDate = getDate[2] + "-" + getDate[1] + "-" + getDate[0];
           axios.post(url,{
               remark: remark,
               emp_id: emp_id,
               attendance_date: newDate
           });
        });


        function Get(date) {
            let url = `/employee/attendance/get/${date}`;
            axios.get(url)
                .then(function (response) {
                    if(response.status === 200){
                        let data = response.data;
                        if(data.length > 0){
                            attendanceListArea.removeClass('d-none')
                            table.empty();
                            data.forEach(function (item, index) {
                                Item(item, index)
                            })
                        }
                    }
                    else{
                        alert("Something Went Wrong")
                    }
                })
                .catch(function (error) {
                    alert("Error: Server!")
                })
        }
        function Item(item, index) {
            table.append(`
                <tr>
                    <td scope="row">
                        ${(item.type != null ? item.type : "")}
                    </td>
                    <td>${(item.name != null ? item.name : "")}</td>
                    <td>
                      <div class="d-flex">
                        <div class="form-check">
                          <input emp-id="${item.emp_id}" class="form-check-input change-attendance" type="radio" name="${item.emp_id}" id="emp-1${item.emp_id}" value="1" ${(item.remark == "1") ? "checked" : "" }>
                          <label class="form-check-label" for="emp-1${item.emp_id}">
                            Present
                          </label>
                        </div>
                        <div class="form-check ms-5">
                          <input emp-id="${item.emp_id}" class="form-check-input change-attendance" type="radio" name="${item.emp_id}" id="emp-0${item.emp_id}" value="0" ${(item.remark == "0") ? "checked" : "" }>
                          <label class="form-check-label" for="emp-0${item.emp_id}">
                            Absent
                          </label>
                        </div>
                      </div>
                    </td>
                </tr>
            `);
            Selectize($('#attendanceType-'+index));
        }
/*
       let attendanceDropdown =  `<td>
            <select emp-id="${item.emp_id}" class="change-attendance"  id="attendanceType-${index}">
                <div class="dropdown-menu">
                    <option class="dropdown-item" value="" >Attendance Type</option>
                    <option value="0" ${(item.remark == "0") ? "selected" : "" } class="dropdown-item">Present</option>
                    <option value="1" ${(item.remark == "1") ? "selected" : "" } class="dropdown-item">Late</option>
                    <option value="2" ${(item.remark == "2") ? "selected" : "" } class="dropdown-item">Absent</option>
                    <option value="3" ${(item.remark == "3") ? "selected" : "" } class="dropdown-item">Half Day</option>
                </div>
            </select>
        </td>`

        */
    </script>
@endsection
