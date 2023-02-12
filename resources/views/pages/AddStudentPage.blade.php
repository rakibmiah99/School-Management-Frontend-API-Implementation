@extends('layout.App')
@section('MainContent')
    <!-- START ADD STUDENT HEADING -->
    <section class="section-addStudent--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Add Student</h2>
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
                    <a class="btn btn-text px-4 py-3" href="/student/import">
                        <i class="bi bi-plus text-white fs-4"></i>
                        Import Student
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
                        <div class="card-title d-flex align-items-center">
                            <h3 class="heading--sub">Student Details</h3>
                            <div class="form-check ms-auto">
                                <input class="form-check-input check-guardian" type="checkbox" value="" id="">
                                <label class="form-check-label" for="">
                                    Same parent
                                </label>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/student/add" method="post" id="addStudentForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="class" id="selectClass" required>
                                            <option class="dropdown-item" value="">Select Class*</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}" class="dropdown-item">{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="section" id="sectionList" required>
                                            <option class="dropdown-item" value="">Select Section*</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="regno" class="form-control" name="registration_number" placeholder="Registration Number*" required />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="roll" class="form-control" name="roll" placeholder="Roll" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input  type="text" id="f_name" class="form-control" name="first_name" placeholder="First Name*" required />
                                    </div>
                                    <div class="col-md-3">
                                        <input  type="text" id="l_name" class="form-control" name="last_name" placeholder="Last Name*" required />
                                    </div>
                                    <div class="col-md-3">
                                        <select name="gender" id="selectGender" required>
                                            <option class="dropdown-item" value="">Gender*</option>
                                            <option value="1" class="dropdown-item">Male</option>
                                            <option value="2" class="dropdown-item">Female</option>
                                            <option value="3" class="dropdown-item">Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex input-daterange">
                                            <input id="dateOfBirth" type="text" name="date_of_birth" class="form-control" placeholder="Date of Birth" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex">
                                            <input id="birthRegNo" required type="text" name="birth_registration_no" class="form-control" placeholder="Birth Reg Number*" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="blood_group" required id="selectBloodGroup">
                                            <option class="dropdown-item" value="">Blood Group*</option>
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
                                    <div class="col-md-3">
                                        <select name="religion" required id="selectReligion">
                                            <option class="dropdown-item" value="">Religion*</option>
                                            <option value="1" class="dropdown-item">Islam</option>
                                            <option value="2" class="dropdown-item">Hinduism</option>
                                            <option value="3" class="dropdown-item">Buddhism</option>
                                        </select>
                                    </div>
                                    <div id="phoneNumber" class="col-md-3">
                                        <input type="text" class="form-control" name="mobile_no" placeholder="Phone Number*"  required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input id="email" type="email" class="form-control" name="email" placeholder="Email Address"  />
                                    </div>
                                    <div class="col-md-3">
                                        <input id="currentAddress" type="text" class="form-control" name="current_address" placeholder="Current Address"  />
                                    </div>
                                    <div class="col-md-3">
                                        <input id="permanentAddress" type="text" class="form-control" name="permanent_address" required placeholder="Permanent Address*"  />
                                    </div>
                                </div>

                                <section class="guardian-details">
                                    <div class="row">
                                        <h4 class="heading--sub mt-5 mb-4">Guardian Details</h4>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="guardian_first_name" placeholder="Guardian's First Name*">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="guardian_last_name" placeholder="Guardian's Last Name*" >
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="guardian_phone" placeholder="Guardian's Number*">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="guardian_nid" placeholder="Guardian's NID*" >
                                        </div>
                                        <div class="col-md-3">
                                            <input type="email" class="form-control" name="guardian_email" placeholder="Guardian's Email">
                                        </div>
                                    </div>
                                </section>

                                <div class="row">
                                    <!-- Hide above details and show the dropdown when checkbox is selected -->
                                    <section class="select-guardian mt-5 d-none">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="heading--sub">Select Guardian</h4>
                                                <select id="selectParent" name="old_parent">
                                                    <option class="dropdown-item" value="">Select Guardian*</option>
                                                    @foreach($parents as $parent)
                                                        <option value="{{$parent->id}}" class="dropdown-item">{{$parent->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-text mt-4">Save Student</button>
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
    {{--<script src="{{asset('assets/js/script.js')}}"></script>--}}
    <!-- Filter items in dropdowns -->
    <script src="{{asset('assets/js/filter.js')}}"></script>
    <script src="{{asset("assets/js/addStudent.js")}}"></script>
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
        Selectize($('#sectionList'));
        Selectize($('#selectBloodGroup'));
        Selectize($('#selectParent'));
        Selectize($('#selectGender'));
        Selectize($('#selectReligion'));
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

        //Add Student
        /*
        $('#addStudentForm').on('submit', function (e){
            e.preventDefault();


            let formData = new FormData();
            formData.append('class',  $('#selectClass').val());
            formData.append('section',  $('#sectionList').val());
            formData.append('religion',  $('#selectReligion').val());
            formData.append('registration_id',  $('#regno').val());
            formData.append('nid',  $('#nid').val());
            formData.append('name',  $('#name').val());
            formData.append('admission_date',  $('#admission_date').val());
            formData.append('date_of_birth',  $('#date_of_birth').val());
            formData.append('mobile_no',  $('#mobile_no').val());
            formData.append('date_of_birth',  $('#date_of_birth').val());
            formData.append('date_of_birth',  $('#date_of_birth').val());

        })
         */
    </script>
@endsection
