@extends('layout.App')
@section('MainContent')
    <!-- START ATTENDANCE REPORT HEADING -->
    <section class="section-attendanceReport--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Student Details Report</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END ATTENDANCE REPORT HEADING -->

    <!-- START STUDENT ATTENDANCE REPORT CRITERIA -->
    <section class="section-attendanceReport--criteria section-criteria u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Select Criteria</h3>
                        </div>
                        <div class="card-body d-block">
                            <div class="row">
                                <div class="col-md-3">
                                    <div id="ReportRange" class="py-2">
                                        <i class="bi bi-calendar-week-fill"></i>&nbsp;&nbsp;&nbsp;
                                        <span></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select id="selectClass" class="w-100">
                                        <option class="dropdown-item" value="">Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}" class="dropdown-item">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select style="visibility: hidden;" id="sectionList">
                                        <option class="dropdown-item" value="">Select Section</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 d-flex  justify-content-center" >
                                <div class="d-none" style="margin-right: 25px" id="FilterArea">
                                    <button class="btn btn-primary py-2 px-5" id="filterBtn">Filter</button>
                                </div>
                                <div class="dropdown d-none" id="ExportArea">
                                    <button class="btn btn-primary py-2  px-5 dropdown-toggle" type="button" id="triggerId"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Export Report
                                    </button>
                                    <div class="dropdown-menu w-50" aria-labelledby="triggerId">
                                        <button class="dropdown-item"  id="csvBtn" href="#">CSV</button>
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
    <!-- END STUDENT ATTENDANCE REPORT CRITERIA -->

    <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
    <!-- START ATTENDANCE REPORT -->
    <section class="section-attendanceReport--list d-none" id="listArea">
        <div class="container">
            <div class="row u-padding-lg pt-0">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Student Details Reports</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 45vh">
                            <table class="table table-responsive" id="ReportsDataTable">
                                <thead>
                                <tr>
                                    <th>Registration Number</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Roll</th>
                                    <th>Permanent Address</th>
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
    <!-- END ATTENDANCE REPORT -->
@endsection

@section('scripts-before')
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
                $('#ReportRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#ReportRange').daterangepicker({
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
        let filerArea = $('#FilterArea');
        let exportArea = $('#ExportArea');
        let listArea = $('#listArea');


        $('#selectClass').selectize({
            onChange: function (value){
                filerArea.addClass('d-none');
                exportArea.addClass('d-none');
                listArea.addClass('d-none');
                $('#sectionList').each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });
                axios.get('/class-wise-section/'+value)
                    .then(function(response){
                        if(response.status == 200){
                            let data = response.data;
                            $('#homeworkPanel').addClass('d-none');
                            let sectionList = $('#sectionList');
                            sectionList.empty();
                            sectionList.append(`
                                <option class="dropdown-item" value="">Select Section</option>
                            `);
                            data.forEach(function (item){
                                sectionList.append(`
                                    <option value="${item.id}" class="dropdown-item">${item.name}</option>
                                `);
                            });
                            Selectize(sectionList)
                        }
                    })
                    .catch(function (error){
                        console.log(error)
                    });
            }
        });


        $('#sectionList').on('change', function () {
            // filerArea.addClass('d-none');
            // exportArea.addClass('d-none');
            // listArea.addClass('d-none');
            $('#homeworkPanel').addClass('d-none');
            // let section_id = $(this).val();
            // let class_id = $('#selectClass').val();
            GetHomework();

        });


        function GetHomework(){
            exportArea.addClass('d-none');
            listArea.addClass('d-none');
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            if(classID != "" && sectionID != ""){
                filerArea.removeClass('d-none');
            }
            else{
                filerArea.addClass('d-none');
            }
        }



        //Export To CSV
        $('#csvBtn').on('click', function (e) {
            e.preventDefault();
            let startDate =$('#ReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#ReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            let class_id = $('#selectClass').val();
            let section_id = $('#sectionList').val();
            window.location.href = `/reports/student-details/export-csv/${startDate}/${endDate}/${class_id}/${section_id}`;
        });

        //Export To PDF
        $('#pdfBtn').on('click', function (e) {
            e.preventDefault();
            let startDate =$('#ReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#ReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            let class_id = $('#selectClass').val();
            let section_id = $('#sectionList').val();
            window.location.href = `/reports/student-details/export-pdf/${startDate}/${endDate}/${class_id}/${section_id}`;
        });

        //Read Data
        $('#filterBtn').on('click', function () {
            PreloaderON();
            let startDate =$('#ReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#ReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            let class_id = $('#selectClass').val();
            let section_id = $('#sectionList').val();
            let exportArea = $('#ExportArea');
            let listArea = $('#listArea');
            if(section_id != ""){
                axios.get(`/reports/student-details/get/${startDate}/${endDate}/${class_id}/${section_id}`)
                    .then(function (response) {
                        PreloaderOFF();
                        if(response.status === 200){
                            let data = response.data;
                            if(data.length > 0){
                                exportArea.removeClass('d-none');
                                listArea.removeClass('d-none')
                                let data = response.data;
                                $('#ReportsDataTable').DataTable().destroy();
                                table.empty();
                                data.forEach(function(item, index){
                                    Item(item, index)
                                });

                                $('#ReportsDataTable').DataTable({
                                    fixedHeader: true,
                                });
                            }
                            else{
                                Toast("No record found.")
                                exportArea.addClass('d-none');
                                listArea.addClass('d-none')
                            }
                        }
                    })
                    .catch(function (error) {
                        PreloaderOFF();
                        console.log(error)
                        Toast("Server Error.")
                    })
            }
            else{
                PreloaderOFF();
                Toast("Please select a Section.");
                exportArea.addClass('d-none')
                listArea.addClass('d-none')
            }
        });

        function Item(item, index) {
            table.append(`
                <tr>
                    <td scope="row">${item.registration_number}</td>
                    <td>${item.name}</td>
                    <td>
                      ${(item.class_data != null ? item.class_data.name : "No data found")}
                    </td>
                    <td>${(item.section_data != null ? item.section_data.name : "No data found")}</td>
                    <td>${item.roll}</td>
                    <td>${item.permanent_address}</td>
                 </tr>
            `)
        }

    </script>
@endsection
