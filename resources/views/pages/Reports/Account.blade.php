@extends('layout.App')
@section('MainContent')
    <!-- START ACCOUNTS REPORT HEADING -->
    <section class="section-accountReport--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Accounts Report</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END ACCOUNTS REPORT HEADING -->

    <!-- START STUDENT ACCOUNTS REPORT CRITERIA -->
    <section class="section-accountReport--criteria section-criteria u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Select Criteria</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-5">
                                <div id="accountsReportRange" class="py-2">
                                    <i class="bi bi-calendar-week-fill"></i>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary py-2 px-5" id="filterBtn">Filter</button>
                            </div>
                            <div class="col-md-5">
                                <div class="dropdown d-none" id="ExportArea">
                                    <button class="btn btn-primary py-2 px-5 dropdown-toggle" type="button" id="triggerId"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Export Report
                                    </button>
                                    <div class="dropdown-menu w-50" aria-labelledby="triggerId">
                                        <button class="dropdown-item" id="csvBtn" href="#">CSV</button>
                                        <button class="dropdown-item" id="pdfBtn" href="#">PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STUDENT ACCOUNTS REPORT CRITERIA -->

    <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
    <!-- START ACCOUNTS REPORT -->
    <section class="section-accountReport--list d-none" id="listArea">
        <div class="container">
            <div class="row u-padding-lg pt-0">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Accounts Reports</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 68vh">
                            <table class="table table-responsive" id="accountsReportTable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Type of Entry</th>
                                    <th>Income Amount</th>
                                    <th>Expense Amount</th>
                                </tr>
                                </thead>
                                <tbody id="TableBody">
                                    <!-- Table Body -->
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td id="totalIncome"></td>
                                    <td id="totalExpense"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END ACCOUNTS REPORT -->
@endsection

@section('scripts-before')
    <!-- BOOTSTRAP JS -->
    {{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"--}}
            {{--integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">--}}
    {{--</script>--}}


    <!-- Datatable JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js">
    </script>

    <!-- Selectize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    <!-- CALENDAR JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endsection
@section('scripts-last')
    <script src="{{asset('assets/js/filter.js')}}"></script>
    <script src="{{asset("assets/js/script.js")}}"></script>
    <script>
        $(function () {

            let start = moment().subtract(29, 'days');
            let end = moment();

            function cb(start, end) {
                $('#accountsReportRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#accountsReportRange').daterangepicker({
                startDate: start,
                endDate: end,
                opens: 'left',
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                        'month')]
                }
            }, cb);

            cb(start, end);

        });
    </script>

    <script>

        let table = $('#TableBody');


        //Export To CSV
        $('#csvBtn').on('click', function (e) {
            e.preventDefault();
            let startDate =$('#accountsReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#accountsReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            window.location.href = `/reports/account/export-csv/${startDate}/${endDate}`
        });

        //Export To PDF
        $('#pdfBtn').on('click', function (e) {
            e.preventDefault();
            let startDate =$('#accountsReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#accountsReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            window.location.href = `/reports/account/export-pdf/${startDate}/${endDate}`
        });


        //Read Data
        $('#filterBtn').on('click', function () {
            let startDate =$('#accountsReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#accountsReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            PreloaderON();
            axios.get(`/reports/account/get/${startDate}/${endDate}`)
            .then(async function (response) {
                if(response.status === 200){
                    PreloaderOFF();
                    let data = response.data;
                    if(data.length > 0){
                        $('#ExportArea').removeClass('d-none');
                        $('#listArea').removeClass('d-none');
                        let  totalIncome = 0;
                        let totalExpense = 0;
                        table.empty();
                        data.forEach(async function(item, index){
                            totalIncome += await Number(item.inc_amount);
                            totalExpense += await Number(item.exp_amount);
                            Item(item, index)
                        });


                        $('#totalIncome').html(await  totalIncome);
                        $('#totalExpense').html(await totalExpense);
                        /*Data Table */
                        $('#accountsReportTable').DataTable().destroy();
                        $('#accountsReportTable').DataTable({
                            fixedHeader: true,
                        });
                    }
                    else{
                        $('#ExportArea').addClass('d-none');
                        $('#listArea').addClass('d-none');
                        Toast("No record found")
                    }
                    /*End Data Table */
                }
            })
            .catch(function (error) {
                PreloaderOFF();
                Toast("Server Error")
            })
        });

        function Item(item, index) {
            table.append(`
                <tr>
                    <td scope="row">${++index}</td>
                    <td>${item.date}</td>
                    <td>
                        ${item.title}
                    </td>
                    <td>${item.transaction_type}</td>
                    <td>${(item.inc_amount == null ? 0 : item.inc_amount)}</td>
                    <td>${(item.exp_amount == null ? 0 : item.exp_amount)}</td>
                </tr>
            `)
        }

    </script>
@endsection
