@extends('layout.App')
@section('MainContent')
    <!-- START SALARY HEADING -->
    <section class="section-salary--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Salary</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END SALARY HEADING -->

    <div class="container">
        <div class="row u-padding-lg pt-0">
            <div class="col-md-3">
                <!-- START ASSIGN SALARY -->
                <section class="section-assignSalary">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Assign Employee Salary</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <select id="selected" placeholder="Payment Month">
                                    <option class="dropdown-item" value="">
                                        Select Payment Month
                                    </option>
                                    <option value="1" class="dropdown-item">
                                        January
                                    </option>
                                    <option value="2" class="dropdown-item">
                                        February
                                    </option>
                                    <option value="3" class="dropdown-item">
                                        March
                                    </option>
                                    <option value="4" class="dropdown-item">
                                        April
                                    </option>
                                    <option value="5" class="dropdown-item">
                                        May
                                    </option>
                                    <option value="6" class="dropdown-item">
                                        June
                                    </option>
                                    <option value="7" class="dropdown-item">
                                        July
                                    </option>
                                    <option value="8" class="dropdown-item">
                                        August
                                    </option>
                                    <option value="9" class="dropdown-item">
                                        September
                                    </option>
                                    <option value="10" class="dropdown-item">
                                        October
                                    </option>
                                    <option value="11" class="dropdown-item">
                                        November
                                    </option>
                                    <option value="12" class="dropdown-item">
                                        December
                                    </option>
                                </select>
                                <select id="selected" placeholder="Select employee">
                                    <option class="dropdown-item" value="">
                                        Select Employee
                                    </option>
                                    <option value="1" class="dropdown-item">
                                        George E. Pompa
                                    </option>
                                    <option value="2" class="dropdown-item">
                                        Laila R. McCants
                                    </option>
                                    <option value="3" class="dropdown-item">
                                        Justin N. Walker
                                    </option>
                                </select>
                                <input type="text" class="form-control" name="" placeholder="Amount*" required />
                                <input type="text" class="form-control" name="" placeholder="Paid Amount" />
                                <input type="text" class="form-control" name="" placeholder="Due Amount" />
                                <div class="text-center">
                                    <button class="btn btn-text mt-4">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- END ASSIGN SALARY -->
            </div>

            <div class="col-md-9">
                <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
                <!-- START EMPLOYEE SALARY LIST-->
                <section class="section-employeeSalary--list">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Employee Salary List</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 68vh">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Payment Month</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Due Amount</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>January</td>
                                    <td>
                                        George E. Pompa
                                    </td>
                                    <td>10,000</td>
                                    <td>2,000</td>
                                    <td>8,000</td>
                                    <td>30-02-2022</td>
                                    <td>Paid</td>
                                    <td>
                                        <div class="d-flex">
                                            <div>
                                                <button type="button" class="btn px-2">
                                                    <i class="bi bi-pencil-fill text-success me-2" data-bs-toggle="modal"
                                                       data-bs-target="#editContent"></i>
                                                </button>
                                                <div class="modal fade" id="editContent" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <select id="selected" placeholder="Payment Month">
                                                                    <option class="dropdown-item" value="">
                                                                        Select Payment Month
                                                                    </option>
                                                                    <option value="1" class="dropdown-item">
                                                                        January
                                                                    </option>
                                                                    <option value="2" class="dropdown-item">
                                                                        February
                                                                    </option>
                                                                    <option value="3" class="dropdown-item">
                                                                        March
                                                                    </option>
                                                                    <option value="4" class="dropdown-item">
                                                                        April
                                                                    </option>
                                                                    <option value="5" class="dropdown-item">
                                                                        May
                                                                    </option>
                                                                    <option value="6" class="dropdown-item">
                                                                        June
                                                                    </option>
                                                                    <option value="7" class="dropdown-item">
                                                                        July
                                                                    </option>
                                                                    <option value="8" class="dropdown-item">
                                                                        August
                                                                    </option>
                                                                    <option value="9" class="dropdown-item">
                                                                        September
                                                                    </option>
                                                                    <option value="10" class="dropdown-item">
                                                                        October
                                                                    </option>
                                                                    <option value="11" class="dropdown-item">
                                                                        November
                                                                    </option>
                                                                    <option value="12" class="dropdown-item">
                                                                        December
                                                                    </option>
                                                                </select>
                                                                <select id="selected" placeholder="Select employee">
                                                                    <option class="dropdown-item" value="">
                                                                        Select Employee
                                                                    </option>
                                                                    <option value="1" class="dropdown-item">
                                                                        George E. Pompa
                                                                    </option>
                                                                    <option value="2" class="dropdown-item">
                                                                        Laila R. McCants
                                                                    </option>
                                                                    <option value="3" class="dropdown-item">
                                                                        Justin N. Walker
                                                                    </option>
                                                                </select>
                                                                <input type="text" class="form-control" name="" placeholder="Amount*" required />
                                                                <input type="text" class="form-control" name="" placeholder="Paid Amount" />
                                                                <input type="text" class="form-control" name="" placeholder="Due Amount" />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-text px-4"
                                                                        data-bs-dismiss="modal">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="button" class="btn px-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </button>
                                                <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <button type="button" class="btn-close fs-5" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body p-5">
                                                                <img src="../assets/images/delete.png" alt="dustbin image" class="img-fluid">
                                                                <p>
                                                                    Are you sure?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer border-0">
                                                                <button type="button" class="btn btn-delete">Delete</button>
                                                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>January</td>
                                    <td>
                                        George E. Pompa
                                    </td>
                                    <td>10,000</td>
                                    <td>2,000</td>
                                    <td>8,000</td>
                                    <td>-</td>
                                    <td>Partial</td>
                                    <td>
                                        <div class="d-flex">
                                            <div>
                                                <button type="button" class="btn px-2">
                                                    <i class="bi bi-pencil-fill text-success me-2" data-bs-toggle="modal"
                                                       data-bs-target="#editContent"></i>
                                                </button>
                                                <div class="modal fade" id="editContent" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <select id="selected" placeholder="Payment Month">
                                                                    <option class="dropdown-item" value="">
                                                                        Select Payment Month
                                                                    </option>
                                                                    <option value="1" class="dropdown-item">
                                                                        January
                                                                    </option>
                                                                    <option value="2" class="dropdown-item">
                                                                        February
                                                                    </option>
                                                                    <option value="3" class="dropdown-item">
                                                                        March
                                                                    </option>
                                                                    <option value="4" class="dropdown-item">
                                                                        April
                                                                    </option>
                                                                    <option value="5" class="dropdown-item">
                                                                        May
                                                                    </option>
                                                                    <option value="6" class="dropdown-item">
                                                                        June
                                                                    </option>
                                                                    <option value="7" class="dropdown-item">
                                                                        July
                                                                    </option>
                                                                    <option value="8" class="dropdown-item">
                                                                        August
                                                                    </option>
                                                                    <option value="9" class="dropdown-item">
                                                                        September
                                                                    </option>
                                                                    <option value="10" class="dropdown-item">
                                                                        October
                                                                    </option>
                                                                    <option value="11" class="dropdown-item">
                                                                        November
                                                                    </option>
                                                                    <option value="12" class="dropdown-item">
                                                                        December
                                                                    </option>
                                                                </select>
                                                                <select id="selected" placeholder="Select employee">
                                                                    <option class="dropdown-item" value="">
                                                                        Select Employee
                                                                    </option>
                                                                    <option value="1" class="dropdown-item">
                                                                        George E. Pompa
                                                                    </option>
                                                                    <option value="2" class="dropdown-item">
                                                                        Laila R. McCants
                                                                    </option>
                                                                    <option value="3" class="dropdown-item">
                                                                        Justin N. Walker
                                                                    </option>
                                                                </select>
                                                                <input type="text" class="form-control" name="" placeholder="Amount*" required />
                                                                <input type="text" class="form-control" name="" placeholder="Paid Amount" />
                                                                <input type="text" class="form-control" name="" placeholder="Due Amount" />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-text px-4"
                                                                        data-bs-dismiss="modal">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="button" class="btn px-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </button>
                                                <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <button type="button" class="btn-close fs-5" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body p-5">
                                                                <img src="../assets/images/delete.png" alt="dustbin image" class="img-fluid">
                                                                <p>
                                                                    Are you sure?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer border-0">
                                                                <button type="button" class="btn btn-delete">Delete</button>
                                                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>January</td>
                                    <td>
                                        George E. Pompa
                                    </td>
                                    <td>10,000</td>
                                    <td>-</td>
                                    <td>10,000</td>
                                    <td>-</td>
                                    <td>Unpaid</td>
                                    <td>
                                        <div class="d-flex">
                                            <div>
                                                <button type="button" class="btn px-2">
                                                    <i class="bi bi-pencil-fill text-success me-2" data-bs-toggle="modal"
                                                       data-bs-target="#editContent"></i>
                                                </button>
                                                <div class="modal fade" id="editContent" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <select id="selected" placeholder="Payment Month">
                                                                    <option class="dropdown-item" value="">
                                                                        Select Payment Month
                                                                    </option>
                                                                    <option value="1" class="dropdown-item">
                                                                        January
                                                                    </option>
                                                                    <option value="2" class="dropdown-item">
                                                                        February
                                                                    </option>
                                                                    <option value="3" class="dropdown-item">
                                                                        March
                                                                    </option>
                                                                    <option value="4" class="dropdown-item">
                                                                        April
                                                                    </option>
                                                                    <option value="5" class="dropdown-item">
                                                                        May
                                                                    </option>
                                                                    <option value="6" class="dropdown-item">
                                                                        June
                                                                    </option>
                                                                    <option value="7" class="dropdown-item">
                                                                        July
                                                                    </option>
                                                                    <option value="8" class="dropdown-item">
                                                                        August
                                                                    </option>
                                                                    <option value="9" class="dropdown-item">
                                                                        September
                                                                    </option>
                                                                    <option value="10" class="dropdown-item">
                                                                        October
                                                                    </option>
                                                                    <option value="11" class="dropdown-item">
                                                                        November
                                                                    </option>
                                                                    <option value="12" class="dropdown-item">
                                                                        December
                                                                    </option>
                                                                </select>
                                                                <select id="selected" placeholder="Select employee">
                                                                    <option class="dropdown-item" value="">
                                                                        Select Employee
                                                                    </option>
                                                                    <option value="1" class="dropdown-item">
                                                                        George E. Pompa
                                                                    </option>
                                                                    <option value="2" class="dropdown-item">
                                                                        Laila R. McCants
                                                                    </option>
                                                                    <option value="3" class="dropdown-item">
                                                                        Justin N. Walker
                                                                    </option>
                                                                </select>
                                                                <input type="text" class="form-control" name="" placeholder="Amount*" required />
                                                                <input type="text" class="form-control" name="" placeholder="Paid Amount" />
                                                                <input type="text" class="form-control" name="" placeholder="Due Amount" />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-text px-4"
                                                                        data-bs-dismiss="modal">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="button" class="btn px-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </button>
                                                <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <button type="button" class="btn-close fs-5" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body p-5">
                                                                <img src="../assets/images/delete.png" alt="dustbin image" class="img-fluid">
                                                                <p>
                                                                    Are you sure?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer border-0">
                                                                <button type="button" class="btn btn-delete">Delete</button>
                                                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END EMPLOYEE SALARY LIST -->
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



        //Create Exam Type
        createForm.on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let feeType = $('#CreateForm #exam-type-input').val();

            let formData = new FormData();
            formData.append('name', feeType);
            axios.post('/accounts/fee-type/add', formData)
                .then(function (response) {
                    // PreloaderOFF();
                    if(response.status === 200 && response.data.status == true){
                        GetExamType();
                    }
                })
                .catch(function (error) {

                });
        });

        //Update Exam Type
        updateForm.on('submit', function (e) {
            e.preventDefault();
            PreloaderON();
            let examType = $('#updateExamType').val();
            let id = $('#exam-type-id').val();

            let formData = new FormData();
            formData.append('name', examType);
            axios.post('/accounts/fee-type/update/'+id, formData)
                .then(function (response) {
                    // PreloaderOFF();
                    if(response.status === 200 && response.data.status == true){
                        GetExamType();
                    }
                })
                .catch(function (error) {

                })
        });

        //Delete Exam Type
        table.on('click', '.delete', function () {
            PreloaderON();
            let id = $(this).attr('data-id');
            axios.get('/accounts/fee-type/delete/'+id)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        GetExamType();
                    }
                })
                .catch(function (error) {

                })
        });

        //Get Single Type
        table.on('click', '.edit', function () {
            ModalLoaderON();
            let id = $(this).attr('data-id');
            axios.get('/accounts/fee-type/get-single/'+id)
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
            axios.get('/accounts/fee-type/get-all')
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
                    <td>
                        <button
                            data-id="${item.id}"
                            type="button"
                            class="btn btn-text edit px-4 edit py-2 bg-green"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal"
                        >
                        edit
                        </button>
                        <button data-id="${item.id}" class="btn btn-text px-4 delete py-2 bg-red">
                            delete
                        </button>
                    </td>
                </tr>
            `)
        }
    </script>
@endsection
