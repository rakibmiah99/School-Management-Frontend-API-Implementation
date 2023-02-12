@extends('layout.App')
@section('MainContent')
    <!-- START ADD STUDENT HEADING -->
    <section class="section-addStudent--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Add Employee</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END ADD STUDENT HEADING -->

    <!-- START ADD STUDENT BUTTON -->
    <section class="section-addStudent--import u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4 ms-auto text-end">
                    <a class="btn btn-text px-4 py-3" href="/employee/import">
                        <i class="bi bi-plus text-white fs-4"></i>
                        Import Employee
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END ADD STUDENT BUTTON -->

    <!-- START ADD STUDENT DETAILS -->
    <section id="stdAddCriteria" class="section-addStudent--details u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Personal Details</h3>
                        </div>
                        <div class="card-body">
                            <form action="/employee/save" method="post" id="addStudentForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <input  type="text" id="name" class="form-control" name="first_name" placeholder="First Name*" required />
                                    </div>
                                    <div class="col-md-3">
                                        <input  type="text" id="name" class="form-control" name="last_name" placeholder=" Last Name*" required />
                                    </div>
                                    <div class="col-md-3">
                                        <select name="employee_type" id="employeeType" style="visibility: hidden" required>
                                            <option class="dropdown-item" value="">Employee Type*</option>
                                            @foreach($employeeType as $type)
                                                <option class="dropdown-item" value="{{$type->index}}">{{$type->value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" required class="form-control" name="employee_id" placeholder="Employee ID*" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" id="nid" class="form-control" name="nid" placeholder="NID*" required />
                                    </div>
                                    <div class="col-md-3">
                                        <select name="gender"  id="selectGender" required>
                                            <option class="dropdown-item" value="">Gender*</option>
                                            <option value="1" class="dropdown-item">Male</option>
                                            <option value="2" class="dropdown-item">Female</option>
                                            <option value="3" class="dropdown-item">Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex input-daterange">
                                            <input id="dateOfBirth" type="text" name="dob" class="form-control" placeholder="Date of Birth" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="blood_group" id="selectBloodGroup">
                                            <option class="dropdown-item" value="">Blood Group</option>
                                            <option value="1" class="dropdown-item">A+</option>
                                            <option value="2" class="dropdown-item">A-</option>
                                            <option value="3" class="dropdown-item">B+</option>
                                            <option value="4" class="dropdown-item">B-</option>
                                            <option value="5" class="dropdown-item">O+</option>
                                            <option value="6" class="dropdown-item">O-</option>
                                            <option value="7" class="dropdown-item">AB+</option>
                                            <option value="8" class="dropdown-item">AB-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="religion" id="selectReligion">
                                            <option class="dropdown-item" value="">Religion</option>
                                            <option value="1" class="dropdown-item">Islam</option>
                                            <option value="2" class="dropdown-item">Hinduism</option>
                                            <option value="3" class="dropdown-item">Buddhism</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input id="email" type="email" class="form-control" name="email" placeholder="Email Address"  />
                                    </div>
                                    <div id="phoneNumber" class="col-md-3">
                                        <input type="text" required class="form-control" name="mobile" placeholder="Phone Number*" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="current_address" placeholder="Current Address">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" required class="form-control" name="permanent_address" placeholder="Permanent Address*" >
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="total_salary" placeholder="Salary*" required="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button class="btn btn-text mt-4">Save Employee</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END ADD STUDENT DETAILS -->
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
        //Selectize
        Selectize($('#sectionList'))
        Selectize($('#selectBloodGroup'))
        Selectize($('#selectGender'))
        Selectize($('#selectReligion'))
        Selectize($('#employeeType'))
        //End Selectize


        $('#selectClass').selectize({
            onChange: function (value){
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
                            Selectize(sectionList)
                        }
                    })
                    .catch(function (error){
                        console.log(error)
                    });
            }
        });
    </script>
@endsection
