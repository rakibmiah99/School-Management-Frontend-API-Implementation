@extends('layout.App')
@section('MainContent')
    <!-- START ADD EXPENSE HEADING -->
    <section class="section-addExpense--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Add Expense</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END ADD EXPENSE HEADING -->

    <div class="container">
        <div class="row u-padding-lg pt-0">
            <div class="col-md-4">

                <!-- START ADD EXPENSE -->
                <section class="section-addExpense">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Add Expense</h3>
                        </div>
                        <div class="card-body">
                            <form id="CreateForm" action="">
                                <div class="d-flex input-daterange" required>
                                    <input type="text" id="date" class="form-control" placeholder="Date" />
                                </div>
                                <select id="selectType" class="w-100" required>
                                    <option class="dropdown-item" value="">Expense Type</option>
                                    @foreach($expense_types as $type)
                                        <option value="{{$type->id}}" class="dropdown-item">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="ammount" class="form-control" placeholder="Amount*" required />
                                <div class="text-center">
                                    <button class="btn btn-text mt-4" type="submit">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- END ADD EXPENSE -->
            </div>

            <div class="col-md-8">

                <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
                <!-- START EXPENSE LIST-->
                <section class="section-expense--list">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Expense List</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 68vh">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Expense Type</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="TableList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- END EXPENSE LIST -->
            </div>
        </div>
    </div>

{{--    EDIT MODAL--}}
    <div class="modal fade" id="editContent" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                @include('layout.ModalLoader')

                <div id="ModalBody" class="modal-body">
                    <form id="UpdateForm" action="">
                        <input type="hidden" id="data-id">
                        <div class="d-flex input-daterange" required>
                            <input type="text" id="date" class="form-control" placeholder="Date" />
                        </div>
                        <select id="selectType" class="w-100" required>
                            <option class="dropdown-item" value="">Expense Type</option>
                            @foreach($expense_types as $type)
                                <option value="{{$type->id}}" class="dropdown-item">{{$type->name}}</option>
                            @endforeach

                        </select>
                        <input type="text" id="ammount" class="form-control" placeholder="Amount*" required />

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-text px-4" data-bs-dismiss="modal">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--    DELETE MODAL--}}
    <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static"
         data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
             role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close fs-5" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <img src="../assets/images/delete.png" alt="dustbin image" class="img-fluid" />
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-delete">
                        Delete
                    </button>
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts-last')
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <!-- Selectize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    <!--Calendar JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
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
        let table = $('#TableList');
        let createForm = $('#CreateForm');
        let updateForm = $('#UpdateForm');

        PreloaderON();
        Selectize($('#CreateForm #selectType'));
        Selectize($('#UpdateForm #selectType'));

        function convertDate(dte){
            let d = dte.split('/');
            return d[2] + "-" + d[1] + "-" + d[0];
        }

        //Create Exam Type
        createForm.on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let dte = $('#CreateForm #date').val();
            let expense_type = $('#CreateForm #selectType').val();
            let amount = $('#CreateForm #ammount').val();
            let formData = new FormData();
            formData.append('date', convertDate(dte));
            formData.append('expense_type', expense_type);
            formData.append('amount', amount);
            axios.post('/accounts/add-expense/add', formData)
                .then(function (response) {
                    // PreloaderOFF();
                    if(response.status === 200 && response.data.status == true){
                        GetAll();
                    }
                })
                .catch(function (error) {

                })
        });

        //Update Exam Type
        updateForm.on('submit', function (e) {
            e.preventDefault();
            PreloaderON();
            let id = $('#data-id').val();
            let dte = $('#UpdateForm #date').val();
            let expense_type = $('#UpdateForm #selectType').val();
            let amount = $('#UpdateForm #ammount').val();
            let formData = new FormData();
            formData.append('date', convertDate(dte));
            formData.append('expense_type', expense_type);
            formData.append('amount', amount);
            axios.post('/accounts/add-expense/update/'+id, formData)
                .then(function (response) {
                    // PreloaderOFF();
                    if(response.status === 200 && response.data.status == true){
                        GetAll();
                    }
                })
                .catch(function (error) {

                })
        });

        //Delete
        $('#deleteModal .btn-delete').on('click', function () {
            PreloaderON();
            $('#deleteModal .btn-cancel').trigger('click');
            let id = $(this).attr('data-id');
            axios.get('/accounts/add-expense/delete/'+id)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        GetAll();
                    }
                })
                .catch(function (error) {

                })
        });

        // SetDataToDeleteModal
        table.on('click', '.delete', function () {
            let id = $(this).attr('data-id');
            $('#deleteModal .btn-delete').attr('data-id', id);
        });


        //Get Single Type
        table.on('click', '.edit', function () {
            ModalLoaderON();
            let id = $(this).attr('data-id');
            axios.get('/accounts/add-expense/get-single/'+id)
                .then(function (response) {
                    if(response.status === 200){
                        let data = response.data;
                        let dte = data.date.split('-');
                        $('#data-id').val(data.id);
                        $('#UpdateForm #date').val(dte[2] + "/" + dte[1] + "/" + dte[0]);
                        $('#UpdateForm #selectType').data('selectize').setValue(data.expense_data.id);
                        $('#UpdateForm #ammount').val(data.amount);
                        ModalLoaderOFF();

                    }
                })
                .catch(function (error) {
                    // ModalLoaderOFF();
                })
        });

        GetAll();
        function GetAll() {
            axios.get('/accounts/add-expense/get-all')
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
            table.append(`
                  <tr>
                        <td scope="row">${++index}</td>
                        <td>
                            ${item.date}
                        </td>
                        <td>${(item.expense_data != null) ? item.expense_data.name : "" }</td>
                        <td>${item.amount}</td>
                        <td>
                            <div class="d-flex">
                                <button data-id="${item.id}" type="button" class="btn edit px-2">
                                    <i class="bi bi-pencil-fill text-success me-2" data-bs-toggle="modal" data-bs-target="#editContent"></i>
                                </button>
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
