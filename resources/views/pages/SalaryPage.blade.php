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
            <!--Roll-->
            {{--<div class="col-md-3">
                <!-- START ASSIGN SALARY -->
                <section class="section-assignSalary">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Assign Employee Salary</h3>
                        </div>
                        <div class="card-body">
                            <form id="CreateForm" action="">
                                <select id="CreateFormPaymentForMonth" placeholder="Payment Month">
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
                                <select id="CreateFormEmployee" placeholder="Select employee">
                                    <option class="dropdown-item" value="">
                                        Select Employee
                                    </option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}" class="dropdown-item">
                                            {{$employee->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <input id="CreateFormAmount" type="text" class="form-control" name="" placeholder="Amount*" required />
                                <input id="CreateFormPaidAmount" type="text" class="form-control" name="" placeholder="Paid Amount" />
                                <input type="text" id="CreateFormDueAmount" class="form-control" name="" placeholder="Due Amount" />
                                <div class="text-center">
                                    <button type="submit" class="btn submit btn-text mt-4">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- END ASSIGN SALARY -->
            </div>--}}

            <div class="col-md-12">
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
                                <tbody id="SalaryListTable">
                                    <!-- Salary List Table -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


<!--Old-->
{{--    <!-- END EMPLOYEE SALARY LIST -->
    <div class="modal fade" id="editContent" aria-hidden="true">
        <div class="modal-dialog">
            <form id="UpdateForm" action="/" class="modal-content">
                <input type="hidden" id="data-id">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                @include('layout.ModalLoader')
                <div id="ModalBody" class="modal-body">
                    <select id="UpdateFormPaymentForMonth" placeholder="Payment Month">
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
                    <select id="UpdateFormEmployee" placeholder="Select employee">
                        <option class="dropdown-item" value="">
                            Select Employee
                        </option>
                        @foreach($employees as $employee)
                            <option value="{{$employee->id}}" class="dropdown-item">
                                {{$employee->name}}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" id="UpdateFormAmount" class="form-control" name="" placeholder="Amount*" required />
                    <input type="text" id="UpdateFormPaidAmount" class="form-control" name="" placeholder="Paid Amount" />
                    <input type="text" id="UpdateFormDueAmount" class="form-control" name="" placeholder="Due Amount" />
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-text px-4"
                                data-bs-dismiss="modal">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>--}}
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
        let monthArr = ['january', 'February', 'March', 'April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December'];
        /*
        let createForm = $('#CreateForm');
        let createFormPayment = $('#CreateFormPaymentForMonth');
        let createFormEmployee = $('#CreateFormEmployee');
        let createFormAmount = $('#CreateFormAmount');
        let createFormPaidAmount = $('#CreateFormPaidAmount');
        let createFormDueAmount = $('#CreateFormDueAmount');

        let updateForm = $('#UpdateForm')
        let updateFormPayment = $('#UpdateFormPaymentForMonth')
        let updateFormEmployee = $('#UpdateFormEmployee')
        let updateFormAmount = $('#UpdateFormAmount');
        let updateFormPaidAmount = $('#UpdateFormPaidAmount');
        let updateFormDueAmount = $('#UpdateFormDueAmount');

        Selectize(createFormEmployee);
        Selectize(createFormPayment);
        Selectize(updateFormEmployee);
        Selectize(updateFormPayment);

        AssignSalary();
        function AssignSalary() {
            $(createForm).on('submit', function (e) {
                PreloaderON();
                e.preventDefault();
                let formData = new FormData();
                formData.append('emp_id', createFormEmployee.val());
                formData.append('payment_month', createFormPayment.val());
                formData.append('due_amount', createFormDueAmount.val());
                formData.append('amount', createFormAmount.val());
                formData.append('paid_amount', createFormPaidAmount.val());

                axios.post('/salary/assign', formData)
                .then(function (response) {
                    if(response.status === 200){
                        SalaryList();
                    }
                })
                .catch(function (error) {
                    console.log(error)
                })
            })
        }

        //Update
        $(updateForm).on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let id = $('#data-id').val();
            let formData = new FormData();
            formData.append('emp_id', updateFormEmployee.val());
            formData.append('payment_month', updateFormPayment.val());
            formData.append('due_amount', updateFormDueAmount.val());
            formData.append('amount', updateFormAmount.val());
            formData.append('paid_amount', updateFormPaidAmount.val());

            axios.post(`/salary/update/${id}`, formData)
            .then(function (response) {
                if(response.status === 200){
                    SalaryList();
                }
            })
            .catch(function (error) {
                console.log(error)
            })
        })


        SetDataToModal();
        function SetDataToModal(){
            $('#SalaryListTable').on('click', '.edit', function () {
                ModalLoaderON();
                let id = $(this).attr('data-id');
                let url = `/salary/get/${id}`;
                axios.get(url)
                .then(function (response) {
                    console.log(response)
                    if(response.status == 200){
                        let data = response.data;
                        $('#data-id').val(data.id);
                        $('#UpdateFormPaymentForMonth').data('selectize').setValue(data.payment_month);
                        $('#UpdateFormEmployee').data('selectize').setValue(data.emp_id);
                        $('#UpdateFormAmount').val(data.amount);
                        $('#UpdateFormDueAmount').val(data.due_amount);
                        $('#UpdateFormPaidAmount').val(data.paid_amount);
                        ModalLoaderOFF();
                    }
                })
                .catch(function (error) {
                    console.log(error)
                })
            });
        }





        //DeleteSalary
        $('#SalaryListTable').on('click', '.delete', function () {
            PreloaderON();
            let id = $(this).attr('data-id');
            let url = `/salary/delete/${id}`;
            axios.get(url)
            .then(function (response) {
                PreloaderOFF();
               if(response.status === 200){
                   SalaryList();
               }
            })
            .catch(function (error) {
                console.log(error)
                alert(error)
            })
        });
*/

        PreloaderON();
        SalaryList();
        function SalaryList() {
            axios.get('/salary/list')
            .then(function (response) {
                PreloaderOFF();
                if(response.status === 200){
                    let data = response.data;
                    let table = $('#SalaryListTable');
                    table.empty();
                    data.forEach(function (item,index) {
                        SalaryItem(table,item,index);
                    })
                }
            })
            .catch(function (error) {

            });


            function SalaryItem(table, item,index) {
                table.append(`
                    <tr>
                        <td scope="row">${index+1}</td>
                        <td>${monthArr[parseInt(item.payment_month -1 )]}</td>
                        <td>
                            ${(item.employee != null) ? item.employee.name : ""}
                        </td>
                        <td>${item.amount}</td>
                        <td>${item.paid_amount}</td>
                        <td>${item.due_amount}</td>
                        <td>${item.payment_date}</td>
                        <td>Paid</td>
                        <td>
                            <div class="d-flex">
                                <div>
                                  <button type="button" class="btn btn-submit bg-primary mt-1 me-4">
                                    Pay Now
                                  </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                `)
            }
        }


      /* let old_action_td =  `<div class="d-flex">
            <button type="button" data-id="${item.id}" class="btn edit px-2">
                <i class="bi bi-pencil-fill text-success me-2" data-bs-toggle="modal"
                   data-bs-target="#editContent"></i>
            </button>
            <button type="button" data-id="${item.id}" class="btn delete  px-2">
                <i class="bi bi-trash text-danger"></i>
            </button>
        </div>`*/
    </script>
@endsection
