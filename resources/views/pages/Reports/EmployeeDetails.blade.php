@extends('layout.App')
@section('MainContent')
    <!-- START EMPLOYEE DETAILS REPORT HEADING -->
    <section class="section-employeeDetailsReport--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Employee Details Report</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END EMPLOYEE DETAILS REPORT HEADING -->

    <!-- START EMPLOYEE REPORT CRITERIA -->
    <section class="section-accountReport--criteria section-criteria u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Select Criteria</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-4">
                                <div id="accountsReportRange" class="py-2">
                                    <i class="bi bi-calendar-week-fill"></i>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select id="selectEmployee" placeholder="Employee Type">
                                    <option value="" >Employee Type</option>
                                    @foreach($employeeType as $item)
                                        <option value="{{$item->index}}">{{$item->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary py-2 px-5" id="filterBtn">Filter</button>
                            </div>
                            <div class="col-md-3">
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
    <!-- END EMPLOYEE REPORT CRITERIA -->

    <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
    <!-- START ACCOUNTS REPORT -->
    <section class="section-accountReport--list d-none" id="listArea">
        <div class="container">
            <div class="row u-padding-lg pt-0">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Employee Details Report</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 68vh">
                            <table class="table table-responsive" id="accountsReportTable">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th></th>
                                    <th></th>
                                    <th>Permanent Address</th>
                                </tr>
                                </thead>
                                <tbody id="TableBody">
                                <!-- Table Body -->
                                </tbody>
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

        Selectize($('#selectEmployee'));

        //Export To CSV
        $('#csvBtn').on('click', function (e) {
            e.preventDefault();
            let startDate =$('#accountsReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#accountsReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            let employeeType = $('#selectEmployee').val();
            window.location.href = `/reports/employee-details/export-csv/${employeeType}/${startDate}/${endDate}`
        });

        //Export To PDF
        $('#pdfBtn').on('click', function (e) {
            e.preventDefault();
            let startDate =$('#accountsReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#accountsReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            let employeeType = $('#selectEmployee').val();
            window.location.href = `/reports/employee-details/export-pdf/${employeeType}/${startDate}/${endDate}`
        });


        //Read Data
        $('#filterBtn').on('click', function () {
            PreloaderON();
            let startDate =$('#accountsReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#accountsReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            let employeeType = $('#selectEmployee').val();
            axios.get(`/reports/employee-details/get/${employeeType}/${startDate}/${endDate}`)
                .then(async function (response) {
                    PreloaderOFF();
                    if(response.status === 200){
                        let data = response.data;
                        if(data.length > 0){
                            $('#ExportArea').removeClass('d-none');
                            $('#listArea').removeClass('d-none');
                            table.empty();
                            data.forEach(function(item, index){
                                Item(item, index)
                            });

                            /*Data Table*/
                            $('#accountsReportTable').DataTable().destroy();
                            $('#accountsReportTable').DataTable({
                                fixedHeader: true,
                            });
                        }
                        else{
                            Toast("No record found");
                            $('#ExportArea').addClass('d-none');
                            $('#listArea').addClass('d-none');
                            table.empty();
                        }
                        /*End Data Table */
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                })
        });

        function Item(item, index) {
            table.append(`
                <tr>
                    <td scope="row">${item.employee_id}</td>
                    <td>${item.name}</td>
                    <td>
                      ${item.mobile}
                    </td>
                    <td>Jamuna</td>
                    <td>55</td>
                    <td>${item.permanent_address}</td>
                 </tr>
            `)
        }

    </script>
@endsection
