@extends('layout.App')
@section('MainContent')
    <section class="section-addAdmin--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Add Admin</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- START ADD ADMIN -->
    <section class="section-addAdmin--content u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Add Admin</h3>
                        </div>
                        <div class="card-body">
                            <form action="" id="CreateForm" class="mb-3">
                                <input id="name" type="text" class="form-control" name="" placeholder="Name*"
                                       required />
                                <input id="email" type="email" class="form-control" name="" placeholder="Email*"
                                       required />
                                <input
                                        id="phone"
                                        type="text"
                                        class="form-control"
                                        placeholder="PHONE NUMBER*"
                                        required
                                />
                                <select id="gender" required>
                                    <option class="dropdown-item" value="">GENDER*</option>
                                    <option value="1" class="dropdown-item">Male</option>
                                    <option value="2" class="dropdown-item">Female</option>
                                    <option value="3" class="dropdown-item">Others</option>
                                </select>

                                <input
                                        id="nid"
                                        type="text"
                                        class="form-control"
                                        placeholder="NID*"
                                        required
                                />
                                <input
                                        id="permanentAddress"
                                        type="text"
                                        class="form-control"
                                        placeholder="PERMANENT ADDRESS*"
                                        required
                                />
                                <button class="btn btn-text ms-5">✔ ADD ADMIN</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">List of Admin</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow-y: auto; max-height: 68vh;">
                            <table class="table table-responsive" id="adminListTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Details</th>
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
    <!-- END ADD ADMIN -->

    <!--Edit Modal -->
    <div class="modal fade" id="editContent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                </div>
                @include('layout.ModalLoader')
                <div id="ModalBody" class="modal-body">
                    <form action="" id="UpdateForm">
                        <input type="hidden" id="data-id">
                        <input id="name" type="text" class="form-control" name="" placeholder="Name*"
                               required />
                        <input id="email" type="email" class="form-control" name="" placeholder="Email*"
                               required />
                        <input
                                id="phone"
                                type="text"
                                class="form-control"
                                placeholder="PHONE NUMBER*"
                                required
                        />
                        <select id="gender" required>
                            <option class="dropdown-item" value="">GENDER*</option>
                            <option value="1" class="dropdown-item">Male</option>
                            <option value="2" class="dropdown-item">Female</option>
                            <option value="3" class="dropdown-item">Others</option>
                        </select>
                        <input
                                id="nid"
                                type="text"
                                class="form-control"
                                placeholder="NID*"
                                required
                        />
                        <input
                                id="permanentAddress"
                                type="text"
                                class="form-control"
                                placeholder="PERMANENT ADDRESS*"
                                required
                        />
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-text px-4" data-bs-dismiss="modal">Update</button>
                        </div>
                    </form>
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

    <script>
        PreloaderON();
        let tableBody = $('#TableBody');
        Selectize($('#CreateForm #gender'));
        Selectize($('#UpdateForm #gender'));
        GetAll();
        function GetAll(){
            axios.get('/users/admin/list')
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


        Create();
        function Create(){
            $('#CreateForm').on('submit', function (e) {
                PreloaderON();
                e.preventDefault();
                let name = $('#CreateForm #name');
                let phone = $('#CreateForm #phone');
                let email = $('#CreateForm #email');
                let nid = $('#CreateForm #nid');
                let permanentAddress = $('#CreateForm #permanentAddress');
                let gender = $('#CreateForm #gender');

                let formData = new FormData();
                formData.append('name', name.val());
                formData.append('email', email.val());
                formData.append('phone', phone.val());
                formData.append('gender', gender.val());
                formData.append('nid', nid.val());
                formData.append('nid', nid.val());
                formData.append('permanent_address', permanentAddress.val());
                formData.append('role_id', 1);

                axios.post('/users/admin/create', formData)
                .then(function (response) {
                    let status = response.data.status;
                    console.log(typeof response.data.status)
                    if(response.status === 200 && status == undefined){
                        GetAll();
                        Toast("Created");
                        $('#CreateForm').trigger("reset");
                    }
                    else if(response.status === 200 && status  != undefined){
                        Toast(response.data.message);
                    }
                    else {
                        Toast(typeof  status);
                    }
                })
                .catch(function (error) {
                    Toast("Server Error");
                })
            })
        }


        //update()
        $("#UpdateForm").on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let id = $('#UpdateForm #data-id').val();
            let name = $('#UpdateForm #name');
            let phone = $('#UpdateForm #phone');
            let email = $('#UpdateForm #email');
            let nid = $('#UpdateForm #nid');
            let permanentAddress = $('#UpdateForm #permanentAddress');
            let gender = $('#UpdateForm #gender');

            let formData = new FormData();
            formData.append('name', name.val());
            formData.append('email', email.val());
            formData.append('phone', phone.val());
            formData.append('gender', gender.val());
            formData.append('nid', nid.val());
            formData.append('nid', nid.val());
            formData.append('permanent_address', permanentAddress.val());
            formData.append('role_id', 1);
            formData.append('user_id', id);

            axios.post('/users/admin/update', formData)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        GetAll();
                        Toast(response.data.message);
                    }
                    else{
                        Toast(response.data.message);
                    }
                })
                .catch(function (error) {
                    alert("Server Error");
                })
        });


        //Get Single
        tableBody.on('click', '.edit', function () {
            ModalLoaderON();
            let id = $(this).attr('data-id');
            let url = `/users/admin/list/${id}`;
            axios.get(url)
                .then(function (response_details) {
                    if(response_details.status === 200){
                        let data = response_details.data;
                        $('#data-id').val(data.id);
                        $('#UpdateForm #name').val(data.name);
                        $('#UpdateForm #phone').val(data.phone);
                        $('#UpdateForm #email').val(data.email);
                        $('#UpdateForm #nid').val(data.nid);
                        $('#UpdateForm #permanentAddress').val(data.permanent_address);
                        $('#UpdateForm #gender').data('selectize').setValue(data.gender);
                        ModalLoaderOFF()
                        // $('#selectGender').data('selectize').setValue();
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
            tableBody.append(`
                <tr>
                    <td scope="row">${item.name}</td>
                    <td>${item.email}</td>
                    <td>
                        <div>
                            <p>
                                <b>
                                    Phone:
                                </b>
                                <span>
                                    ${item.phone}
                                </span>
                            </p>
                            <p>
                                <b>
                                    Gender:
                                </b>
                                <span>
                                    ${gender[parseInt(item.gender)]}
                                </span>
                            </p>
                            <p>
                                <b>
                                    NID:
                                </b>
                                <span>
                                    ${item.nid}
                                </span>
                            </p>
                            <p>
                                <b>
                                    Address:
                                </b>
                                <span>
                                   ${item.permanent_address}
                                </span>
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <button data-id="${item.id}" type="button" class="btn edit px-2">
                                    <i class="bi bi-pencil-fill text-success me-2" data-bs-toggle="modal"
                                       data-bs-target="#editContent"></i>
                                </button>

                            </div>
                        </div>
                    </td>
                </tr>
            `)
        }
    </script>
@endsection
