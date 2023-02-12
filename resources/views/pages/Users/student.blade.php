@extends('layout.App')
@section('MainContent')
    <!-- START STUDENT HEADING -->
    <section class="section-addStudent--heading u-padding-lg pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Add Student</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END STUDENT HEADING -->

    <!-- START ADD STUDENT -->
    <section class="section-addStudent--button u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4 ms-auto text-end">
                    <a class="btn btn-text px-4 py-3" href="/student/add">
                        <i class="bi bi-plus text-white fs-4"></i>
                        Add Student
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END ADD STUDENT -->

    <!-- START STUDENT LIST-->
    <section class="section-addStudent--content u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">List of Students</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow-y: auto; max-height: 62vh;">
                            <table class="table table-responsive" id="adminListTable">
                                <thead>
                                <tr>
                                    <th>Registration Number</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone Number</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="TableBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STUDENT LIST-->

    <!--Edit Modal-->
    <div class="modal fade" id="editContent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                @include('layout.ModalLoader')
                <div id="ModalBody" class="modal-body">
                    <form id="Form">
                        <input type="hidden" id="data-id">
                        <select id="selectGuardian" required>
                            <option class="dropdown-item" value="">Select Guardian*</option>
                            @foreach($guardians as $item)
                                <option value="{{($item->id)}}" class="dropdown-item">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <select id="selectClass" required>
                            <option class="dropdown-item" value="">Select Class*</option>
                            @foreach($classes as $item)
                                <option value="{{$item->id}}" class="dropdown-item">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <select id="selectSection" required>
                            <option class="dropdown-item" value="">Select Section*</option>
                            <option value="1" class="dropdown-item">Padma</option>
                            <option value="2" class="dropdown-item">Meghna</option>
                            <option value="3" class="dropdown-item">Jamuna</option>
                        </select>
                        <input type="text" id="regNo" class="form-control" name=""
                               placeholder="Registration Number*" required />
                        <input type="text" id="roll" class="form-control" name="" placeholder="Roll" />
                        <input type="text" id="firstName" class="form-control" name="" placeholder="First Name*"
                               required />

                        <input type="text" id="lastName" class="form-control" name="" placeholder="Last Name*"
                               required />

                        <select id="selectGender" required>
                            <option class="dropdown-item" value="">Gender*</option>
                            <option value="1" class="dropdown-item">Male</option>
                            <option value="2" class="dropdown-item">Female</option>
                            <option value="3" class="dropdown-item">Others</option>
                        </select>
                        <div class="d-flex input-daterange">
                            <input type="text" id="dateOfBirth" class="form-control" placeholder="Date of Birth*"
                                   required />
                        </div>
                        <input type="text" class="form-control" id="birthRegNo" placeholder="Birth Reg Number*"
                               required />

                        <select id="selectBlood" required>
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
                        <select id="selectReligion" required>
                            <option class="dropdown-item" value="">Religion*</option>
                            <option value="1" class="dropdown-item">Islam</option>
                            <option value="2" class="dropdown-item">Hinduism</option>
                            <option value="3" class="dropdown-item">Buddhism</option>
                        </select>

                        <input type="text" id="phoneNumber" class="form-control" name="" placeholder="Phone Number*"
                               required />
                        <input type="text" id="email" class="form-control" name="" placeholder="Email" />
                        <input type="text" id="currentAddress" class="form-control" name="" placeholder="Current Address" />

                        <input type="text" id="permanentAddress" class="form-control" name="" placeholder="Permanent Address*"
                               required />

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-text px-4"
                            >Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static"
         data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
             role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close fs-5" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <img src="{{asset("/assets/images/delete.png")}}" alt="dustbin image" class="img-fluid">
                    <p>
                        Are you sure?
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-delete">Delete</button>
                    <button type="button" class="btn btn-cancel"
                            data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts-before')


    <!-- Datatable JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js">
    </script>

    <!-- Selectize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>



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

    <!-- Initialize Datatable -->
    <script>
        $(document).ready(function () {

        });
    </script>

    <script>
        PreloaderON();
        let uSelectClass = $('#selectClass');
        let uSelectSection = $('#selectSection');
        Selectize(uSelectSection)
        Selectize($('#selectGuardian'))
        Selectize($('#selectGender'))
        Selectize($('#selectBlood'))
        Selectize($('#selectReligion'))

        uSelectClass.selectize({
            onChange: function (value){
                uSelectSection.each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });
                axios.get('/class-wise-section/'+value)
                    .then(function(response){
                        if(response.status == 200){
                            uSelectSection.each(function() {
                                if (this.selectize) {
                                    this.selectize.destroy();
                                }
                            });

                            let data = response.data;
                            uSelectSection.empty();
                            uSelectSection.append(`
                                <option class="dropdown-item" value="">Select Section</option>
                            `);
                            data.forEach(function (item){
                                uSelectSection.append(`
                                    <option value="${item.id}" class="dropdown-item">${item.name}</option>
                                `);
                            });
                            Selectize(uSelectSection)
                        }
                    })
                    .catch(function (error){
                        console.log(error)
                    });
            }
        });

        let tableBody = $('#TableBody');

        GetAll();
        function GetAll(){
            axios.get('/users/student/list')
            .then(function (response) {
                if(response.status === 200){
                    PreloaderOFF();
                    let data = response.data;
                    $('#adminListTable').DataTable().destroy();
                    tableBody.empty();
                    data.forEach(function (item) {
                        ListItem(item);
                    });
                    var table = $('#adminListTable').DataTable({
                        fixedHeader: true,
                    });
                }
            })
            .catch(function (error) {
                console.log(error)
            });
        }


        //set dat to delete modal
        tableBody.on('click', '.delete', function () {
            let id = $(this).attr('data-id');
            $('#deleteModal .btn-delete').attr('data-id', id);
        });



        //final delete
        $('#deleteModal .btn-delete').on('click', function () {
            PreloaderON();
            $('#deleteModal .btn-cancel').trigger('click');
            let id = $(this).attr('data-id');
            let url = `/users/student/delete/${id}`;
            axios.get(url)
            .then(function (response) {
                if(response.status === 200 && response.data.status == true){
                    GetAll();
                    Toast(response.data.message);
                }else{
                    Toast(response.data.message);
                }
            })
            .catch(function (error) {
                console.log(error);
                Toast("Server Error");
            })
        });


        //update()
        $("#Form").on('submit', function (e) {
            e.preventDefault();

            PreloaderON();
            let formData = new FormData();
            formData.append('class',$('#selectClass').val() )
            formData.append('section', uSelectSection.val() )
            formData.append('registration_number',$('#regNo').val() )
            formData.append('first_name',$('#firstName').val() )
            formData.append('last_name',$('#lastName').val() )
            formData.append('birth_registration_no',$('#birthRegNo').val() )
            formData.append('roll',$('#roll').val() )
            formData.append('mobile_no',$('#phoneNumber').val() )
            formData.append('current_address',$('#currentAddress').val() )
            formData.append('permanent_address',$('#permanentAddress').val() )
            formData.append('date_of_birth', $('#dateOfBirth').val().toString() )
            formData.append('email',$('#email').val() )
            formData.append('gender',$('#selectGender').val() )
            formData.append('religion',$('#selectReligion').val() )
            formData.append('blood_group',$('#selectBlood').val() )
            formData.append('parent_id',$('#selectGuardian').val() )

            let id = $('#data-id').val();

            axios.post(`/users/student/update/${id}` , formData)
            .then(function (response) {
                if (response.status ===200 && response.data.status == true){
                    GetAll();
                    $('.btn-close').trigger('click');
                    Toast(response.data.message);

                }
                else{
                    Toast(response.data.message);
                }
            })
            .catch(function (error) {
                Toast("Server Error");
            })

        });


        //Get Single
        tableBody.on('click', '.edit', function () {
            ModalLoaderON();
            let id = $(this).attr('data-id');
            let url = `/users/student/list/${id}`;
            axios.get(url)
                .then(function (response_details) {
                    if(response_details.status === 200){
                        let data = response_details.data;
                        $('#data-id').val(data.id);
                        $('#regNo').val(data.registration_number);
                        $('#firstName').val(data.first_name);
                        $('#lastName').val(data.last_name);
                        $('#birthRegNo').val(data.birth_registration_no);
                        $('#roll').val(data.roll);
                        $('#phoneNumber').val(data.mobile_no);
                        $('#currentAddress').val(data.current_address);
                        $('#permanentAddress').val(data.permanent_address);
                        $('#dateOfBirth').val(data.date_of_birth);
                        $('#email').val(data.email);
                        let class_id = data.class;
                        $('#selectGender').data('selectize').setValue(data.gender);
                        $('#selectClass').data('selectize').setValue(class_id);
                        $('#selectReligion').data('selectize').setValue(data.religion);
                        $('#selectBlood').data('selectize').setValue(data.blood_group);
                        $('#selectGuardian').data('selectize').setValue(data.parent_id);
                        axios.get(`/class-wise-section/${class_id}`)
                        .then(function (response) {
                                ModalLoaderOFF();
                                if(response.status == 200){
                                    uSelectSection.each(function() {
                                        if (this.selectize) {
                                            this.selectize.destroy();
                                        }
                                    });

                                    let ddata = response.data;
                                    uSelectSection.empty();
                                    uSelectSection.append(`
                                        <option class="dropdown-item" value="">Select Section</option>
                                    `);
                                    ddata.forEach(function (item){
                                        uSelectSection.append(`
                                            <option  value="${item.id}" class="dropdown-item">${item.name}</option>
                                        `);
                                    });
                                    Selectize(uSelectSection);
                                    uSelectSection.data('selectize').setValue(response_details.data.section);
                                }
                            })
                    }else{
                        Toast("Failed");
                    }
                })
                .catch(function (error) {
                    console.log(error);
                    Toast("Server Error");
                })
        });





        function ListItem(item) {
            console.log(item.registration_number)
            tableBody.append(`
                <tr>
                    <td scope="row">${ item.registration_number }</td>
                    <td>${ item.name}</td>
                    <td>${gender[parseInt(item.gender)]}</td>
                    <td>${ item.mobile_no}</td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <button data-id="${item.id}" type="button" class="btn edit px-2">
                                    <i class="bi bi-pencil-fill text-success me-2" data-bs-toggle="modal"
                                       data-bs-target="#editContent"></i>
                                </button>

                            </div>
                            <div>
                                <button data-id="${item.id}" type="button" class="btn delete px-2" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>

                            </div>
                        </div>
                    </td>
                </tr>
            `)
        }
        
    </script>
@endsection
