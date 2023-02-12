@extends('layout.App')
@section('MainContent')
    <!-- START EXAM TYPE HEADING -->
    <section class="section-examType--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Add Employee Type</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END EXAM TYPE HEADING -->

    <!-- START EXAM TYPE CONTENT -->
    <section class="section-examType--content u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Add Employee Type</h3>
                        </div>
                        <div class="card-body">
                            <form id="CreateForm" class="mb-3">
                                <input
                                        type="text"
                                        class="form-control"
                                        placeholder="EMPLOYEE TYPE*"
                                        id="exam-type-input"
                                        required
                                />
                                <button type="submit" class="btn btn-text">✔ SAVE EMPLOYEE TYPE</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Employee TypeList</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>NAME</th>
                                    <th>ID</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody id="ExamTypeTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END EXAM TYPE CONTENT -->

    <!-- Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog" role="document">

            <form id="UpdateForm" class="modal-content">

                <div class="modal-header">
                    <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                    ></button>
                </div>

                @include('layout.ModalLoader')
                <div id="ModalBody">
                    <div class="modal-body">
                        <input type="hidden" id="exam-type-id">
                        <input
                                type="text"
                                class="form-control"
                                placeholder="EXAM NAME*"
                                value=""
                                id="updateExamType"
                                required
                        />
                    </div>
                    <div class="modal-footer">
                        <button
                                type="submit"
                                class="btn btn-text py-1 px-4"
                                data-bs-dismiss="modal"
                        >
                            Update
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <!-- Delete Modal -->
    <div
            class="modal fade"
            id="deleteModal"
            tabindex="-1"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            role="dialog"
            aria-labelledby="modalTitleId"
            aria-hidden="true"
    >
        <div
                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                role="document"
        >
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button
                            type="button"
                            class="btn-close fs-5"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body p-5">
                    <img
                            src="../assets/images/delete.png"
                            alt="dustbin image"
                            class="img-fluid"
                    />
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer border-0">
                    <button
                            type="button"
                            class="btn btn-delete"
                    >
                        Delete
                    </button>
                    <button
                            type="button"
                            class="btn btn-cancel"
                            data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

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
        PreloaderON();
        let table = $('#ExamTypeTable');
        let createForm = $('#CreateForm');
        let updateForm = $('#UpdateForm');



        //Create
        createForm.on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let examType = $('#CreateForm #exam-type-input').val();

            let formData = new FormData();
            formData.append('name', examType);
            axios.post('/employee/type/add', formData)
                .then(function (response) {
                    // PreloaderOFF();
                    if(response.status === 200 && response.data.status == true){
                        Toast("Created Successfully")
                        GetExamType();
                    }else{
                        Toast("Created Failed");
                        PreloaderOFF();
                    }
                })
                .catch(function (error) {
                    alert("Error: Server!");
                    PreloaderOFF();
                })
        });

        //Update
        updateForm.on('submit', function (e) {
            e.preventDefault();
            PreloaderON();
            let examType = $('#updateExamType').val();
            let id = $('#exam-type-id').val();
            let formData = new FormData();
            formData.append('name', examType);
            axios.post('/employee/type/update/'+id, formData)
                .then(function (response) {
                    // PreloaderOFF();
                    if(response.status === 200 && response.data.status == true){
                        Toast('Updated Successfully')
                        GetExamType();
                    }else{
                        Toast("Updated Failed");
                        PreloaderOFF();
                    }

                })
                .catch(function (error) {
                    alert("Error: server")
                    PreloaderOFF();
                })
        });

        //Delete
        table.on('click', '.delete', function () {
            let id = $(this).attr('data-id');
            $('#deleteModal .btn-delete').attr('data-id', id);
        });

        //Final Delete
        $('#deleteModal .btn-delete').on('click', function () {
            $('#deleteModal .btn-close').trigger('click');
            PreloaderON();
            let id = $(this).attr('data-id');
            axios.get('/employee/type/delete/'+id)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        Toast("Deleted Successfully")
                        GetExamType();
                    }else{
                        Toast("Deleted Failed");
                        PreloaderOFF();
                    }
                })
                .catch(function (error) {
                    Toast("Error: server")
                    PreloaderOFF();
                })
        })

        //Get Single Type
        table.on('click', '.edit', function () {
            ModalLoaderON();
            let id = $(this).attr('data-id');
            axios.get('/employee/type/get-single/'+id)
                .then(function (response) {
                    if(response.status === 200){
                        $('#updateExamType').val(response.data.name);
                        $('#exam-type-id').val(response.data.id);
                        ModalLoaderOFF();
                    }
                })
                .catch(function (error) {

                })
        });

        GetExamType();
        function GetExamType() {
            axios.get('/employee/type/get-all')
                .then(function (response) {
                    PreloaderOFF();
                    if(response.status === 200){
                        table.empty();
                        let data = response.data;
                        data.forEach(function (item,index) {
                            ExamTypeItem(table, item, index);
                        })
                    }
                })
                .catch(function (error) {
                    console.log(error)
                })
        }

        function ExamTypeItem(table,item, index){
            table.append(`
                 <tr>
                    <td scope="row">${index+1}</td>
                    <td>${item.name}</td>
                    <td>${item.id}</td>
                    <td>
                        <button data-id="${item.id}" type="button" class="btn delete px-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash text-danger"></i>
                         </button>
                    </td>
                </tr>
            `)
        }


        let edit_btn_copy = `
            <button
                data-id="${item.id}"
                type="button"
                class="btn btn-text edit px-4 edit py-2 bg-green"
                data-bs-toggle="modal"
                data-bs-target="#editModal"
            >
            edit
            </button>
        `;
    </script>
@endsection
