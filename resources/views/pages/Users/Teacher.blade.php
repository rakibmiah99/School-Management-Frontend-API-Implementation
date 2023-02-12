@extends('layout.App')
@section('MainContent')
    <!-- START TEACHER HEADING -->
    <section class="section-addStudent--heading u-padding-lg pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Add Teacher</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END TEACHER HEADING -->

    <!-- START ADD TEACHER -->
    <section class="section-add--button u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4 ms-auto text-end">
                    <a class="btn btn-text px-4 py-3" href="/employee/add">
                        <i class="bi bi-plus text-white fs-4"></i>
                        Add Teacher
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END ADD TEACHER -->

    <!-- START TEACHER LIST-->
    <section class="section-addTeacher--content u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">List of Teacher</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow-y: auto; max-height: 62vh;">
                            <table class="table table-responsive" id="adminListTable">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
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
    <!-- END TEACHER LIST-->

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
                    <form id="Form" action="">
                        <input type="hidden" id="data-id">
                        <input type="text" id="firstName" class="form-control" name="" placeholder="First Name*"
                               required />
                        <input type="text" id="lastName" class="form-control" name="" placeholder="Last Name*"
                               required />
                        <select id="selectEmployee">
                            <option class="dropdown-item" value="">Employee Type*</option>
                             @foreach($employeeType as $type)
                                <option value="{{$type->index}}" class="dropdown-item">{{$type->value}}</option>
                             @endforeach
                        </select>
                        <input type="text" id="employeeID" class="form-control" name="" placeholder="Employee ID*"
                               required />
                        <input type="text" class="form-control" id="nid" name="" placeholder="NID*" required />
                        <select id="selectGender">
                            <option class="dropdown-item" value="">Gender*</option>
                            <option value="1" class="dropdown-item">Male</option>
                            <option value="2" class="dropdown-item">Female</option>
                            <option value="3" class="dropdown-item">Others</option>
                        </select>
                        <div class="d-flex  input-daterange">
                            <input  id="dob" type="text" class="form-control" placeholder="Date of Birth" />
                        </div>
                        <select id="selectBlood">
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
                        <select id="selectReligion">
                            <option class="dropdown-item" value="">Religion</option>
                            <option value="1" class="dropdown-item">Islam</option>
                            <option value="2" class="dropdown-item">Hinduism</option>
                            <option value="3" class="dropdown-item">Buddhism</option>
                        </select>
                        <input type="email" id="email" class="form-control" name="" placeholder="Email Address" />
                        <input type="text" id="phone" class="form-control" name="" placeholder="Phone Number*"
                               required />
                        <input type="text" id="currentAddress" class="form-control" name="" placeholder="Current Address" />
                        <input type="text" class="form-control" id="permanentAddress" name="" placeholder="Permanent Address*"
                               required />

                        <input type="text" id="salary" class="form-control" name="" placeholder="Salary*"
                               required />
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-text px-4"
                                    data-bs-dismiss="modal">Update
                            </button>
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
        Selectize($('#selectReligion'));
        Selectize($('#selectEmployee'));
        Selectize($('#selectGender'));
        Selectize($('#selectBlood'));


        let tableBody = $('#TableBody');

        GetAll();
        function GetAll(){
            axios.get('/users/teacher/list')
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
            $('#deleteModal .btn-cancel').trigger('click');
            PreloaderON();
            let id = $(this).attr('data-id');
            let url = `/users/teacher/delete/${id}`;
            axios.get(url)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        GetAll();
                        Toast(response.data.message);
                    }else{
                        PreloaderOFF();
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
            PreloaderON();
            e.preventDefault();
            let formData = new FormData();
            let id = $('#data-id').val();

            formData.append('id', id );
            formData.append('employee_type',$('#selectEmployee').val() );
            formData.append('employee_id', $('#employeeID').val() );
            formData.append('first_name',$('#firstName').val() );
            formData.append('last_name',$('#lastName').val() );
            formData.append('mobile', $('#phone').val() );
            formData.append('email', $('#email').val() );
            formData.append('current_address', $('#currentAddress').val() );
            formData.append('permanent_address',$('#permanentAddress').val() );
            formData.append('nid',$('#nid').val() );
            formData.append('total_salary', $('#salary').val() );
            formData.append('dob', $('#dob').val() );
            formData.append('blood_group',$('#selectBlood').val() );
            formData.append('gender',$('#selectGender').val() );
            formData.append('religion',$('#selectReligion').val() );

            axios.post(`/users/teacher/update` , formData)
                .then(function (response) {
                    if (response.status ===200 && response.data.status == true){
                        GetAll();
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
            let url = `/users/teacher/list/${id}`;
            axios.get(url)
                .then(function (response_details) {
                    if(response_details.status === 200){
                        ModalLoaderOFF();
                        let data = response_details.data;
                        $('#data-id').val(data.id);
                        $('#firstName').val(data.first_name);
                        $('#lastName').val(data.last_name);
                        $('#employeeID').val(data.employee_id);
                        $('#nid').val(data.nid);
                        $('#dob').val(data.dob);
                        $('#email').val(data.email);
                        $('#phone').val(data.mobile);
                        $('#currentAddress').val(data.current_address);
                        $('#permanentAddress').val(data.permanent_address);
                        $('#salary').val(data.total_salary);

                        $('#selectGender').data('selectize').setValue(data.gender);
                        $('#selectEmployee').data('selectize').setValue(data.employee_type);
                        $('#selectBlood').data('selectize').setValue(data.blood_group);
                        $('#selectReligion').data('selectize').setValue(data.religion);
                    }else{
                        Toast("Failed");
                    }
                })
                .catch(function (error) {
                    console.log(error);
                    Toast("Server Error");
                });
        });





        function ListItem(item) {
            tableBody.append(`
                <tr>
                    <td scope="row">${item.employee_id}</td>
                    <td>${item.first_name + " " + item.last_name}</td>
                    <td>${gender[parseInt(item.gender)]}</td>
                    <td>${item.mobile}</td>
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
