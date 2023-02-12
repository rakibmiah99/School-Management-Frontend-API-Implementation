@extends('layout.App')
@section('MainContent')
    <!-- START FEES HEADING -->
    <section class="section-fees--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Fees</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END FEES HEADING -->

    <div class="container">
        <div class="row u-padding-lg pt-0">
            <div class="col-md-4">

                <!-- START ASSIGN STUDENT FEES -->
                <section class="section-assignStudentFees">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Assign Student Fee</h3>
                        </div>
                        <div class="card-body">
                            <form id="CreateForm" action="">
                                <select id="selectClass" class="w-100">
                                    <option class="dropdown-item" value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}" class="dropdown-item">{{$class->name}}</option>
                                    @endforeach
                                </select>
                                <select id="selectFees" class="w-100">
                                    <option class="dropdown-item" value="">Select Fee Type</option>
                                    @foreach($feeTypes as $type)
                                        <option value="{{$type->id}}" class="dropdown-item">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control" id="amount" placeholder="Amount*" required />
                                <div id="dueDateInput">
                                    <input type="text" class="form-control dueDate1" id="dueDate" placeholder="Due Date*" required />
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-text mt-4">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- END ASSIGN STUDENT FEES -->
            </div>

            <div class="col-md-8">

                <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
                <!-- START STUDENT FEE LIST-->
                <section class="section-studentFee--list">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Student Fee List</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 68vh">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class</th>
                                    <th>Fee Type</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="ContentTable">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END STUDENT FEE LIST -->

    <!--Delete Modal -->
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
                            src="{{asset("/assets/images/delete.png")}}"
                            alt="dustbin image"
                            class="img-fluid"
                    />
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer border-0">
                    <button
                        id="deleteModalBtn"
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
    </script>
    <script>
        let table = $('#ContentTable');
        let createForm = $('#CreateForm');
        let updateForm = $('#UpdateForm');
        Selectize($('#CreateForm #selectClass'))
        // Selectize($('#CreateForm #selectFees'))
        Selectize($('#UpdateForm #selectClass'))
        Selectize($('#UpdateForm #selectFees'))
        let dueInput = $('#dueDateInput')
        $('#selectFees').selectize({
            onChange: function (value) {
                if(value != 2){
                    let input = `
                            <div class="d-flex input-daterange">
                                <input type="text" class="form-control dueDate" id="dueDate" placeholder="Due Date*" required />
                            </div>
                        `;
                    dueInput.empty();
                    dueInput.append(input);
                    $('.input-daterange').datepicker({
                        todayBtn: 'linked',
                        format: 'dd/mm/yyyy',
                        autoclose: true,
                    });
                }
                else{
                    let input = `
                              <input type="text" class="form-control dueDate" id="dueDate" placeholder="Due Date*" required />
                        `;
                    dueInput.empty();
                    dueInput.append(input);
                }
            }
        });


        function hd(){
            $('.input-daterange').datepicker('').on('show', function (e) {
                return console.log(e.currentTarget);
            })
        }
        let d = new Date();

        //Create Exam Type
        createForm.on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let class_id = $('#CreateForm #selectClass').val();
            let fee_type = $('#CreateForm #selectFees').val();
            let amount = $('#CreateForm #amount').val();
            let dueDate = $('#CreateForm #dueDate').val();
            let formData = new FormData();
            formData.append('class_id', class_id);
            formData.append('create_date', d.getDate() + "-" + d.getMonth() + "-" + d.getFullYear());
            formData.append('due_date', dueDate);
            formData.append('payable_amount', amount);
            formData.append('fees_type', fee_type);
            axios.post('/accounts/fees/add', formData)
                .then(function (response) {
                    // PreloaderOFF();
                    if(response.status === 200 && response.data.status == true){
                        createForm.trigger('reset');
                        Toast(response.data.message)
                        GetAll();
                    }
                    else{
                        PreloaderOFF();
                        Toast(response.data.message)
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                    Toast("Server Error")
                })
        });

        //Update Exam Type
        updateForm.on('submit', function (e) {
            e.preventDefault();
            PreloaderON();
            let examType = $('#updateExamType').val();
            let id = $('#exam-type-id').val();
            // return console.log(id);
            let formData = new FormData();
            formData.append('name', examType);
            axios.post('/academics/class/update/'+id, formData)
            .then(function (response) {
                // PreloaderOFF();
                if(response.status === 200 && response.data.status == true){
                    Toast(response.data.message)
                    GetAll();
                }
                else{
                    PreloaderOFF();
                    Toast(response.data.message)
                }
            })
            .catch(function (error) {
                PreloaderOFF();
                Toast("Server Error")
            })
        });






        $('#deleteModal #deleteModalBtn').on('click', function () {
            PreloaderON();
            $('.btn-close').trigger('click');
            let id = $(this).attr('data-id');
            axios.get('/academics/class/delete/'+id)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        Toast(response.data.message)
                        GetAll();
                    }
                    else{
                        PreloaderOFF();
                        Toast(response.data.message)
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                    Toast("Server Error")
                })
        });



        //Delete Exam Type
        table.on('click', '.delete', function () {
            let id = $(this).attr('data-id');
            $('#deleteModal #deleteModalBtn').attr('data-id', id);
        });



        //Get Single Type
        table.on('click', '.edit', function () {
            ModalLoaderON();
            let id = $(this).attr('data-id');
            axios.get('/academics/class/get-single/'+id)
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

        GetAll();
        function GetAll() {
            axios.get('/accounts/fees/get-all')
            .then(function (response) {
                PreloaderOFF();
                if(response.status === 200){
                    table.empty();
                    let data = response.data;
                    data.forEach(function (item,index) {
                        Item(table, item, index);
                    })
                }
            })
            .catch(function (error) {
                console.log(error)
            })
        }

        function Item(table,item, index){
            /*html*/
            table.append(`
                <tr>
                    <td>${++index}</td>
                    <td>
                        ${(item.class_data != null) ? item.class_data.name : ""}
                    </td>
                    <td>${(item.fee_type != null ? item.fee_type.name : "")}</td>
                    <td>${item.payable_amount}</td>
                    <td> ${(item.due_date != null) ? (item.due_date.length > 2) ? item.due_date : item.due_date + " of every month" : "-"} </td>
                    <td>
                        <div>
                            <button data-id="${item.id}" type="button" class="btn delete px-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `)
        }
    </script>
@endsection
