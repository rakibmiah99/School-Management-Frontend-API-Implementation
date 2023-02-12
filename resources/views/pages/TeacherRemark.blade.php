@extends('layout.App')
@section('MainContent')
    <!-- START ATTENDANCE REPORT HEADING -->
    <section class="section-attendanceReport--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Teacher's Remark</h2>
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
                                    <select id="selectMonth" class="w-100">
                                        <option class="dropdown-item" value="">Select Month</option>
                                        <option value="January" class="dropdown-item">January</option>
                                        <option value="February" class="dropdown-item">February</option>
                                        <option value="March" class="dropdown-item">March</option>
                                        <option value="April" class="dropdown-item">April</option>
                                        <option value="May" class="dropdown-item">May</option>
                                        <option value="June" class="dropdown-item">June</option>
                                        <option value="July" class="dropdown-item">July</option>
                                        <option value="August" class="dropdown-item">August</option>
                                        <option value="September" class="dropdown-item">September</option>
                                        <option value="October" class="dropdown-item">October</option>
                                        <option value="November" class="dropdown-item">November</option>
                                        <option value="December" class="dropdown-item">December</option>
                                    </select>
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
                                <div class="col-md-3">
                                    <div class="d-none"  id="FilterArea">
                                        <button class="btn btn-primary py-2 px-5" id="filterBtn">Filter</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 d-flex  justify-content-center" >
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
                            <h3 class="heading--sub">Exam Schedule Report for Quiz</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 45vh">
                            <table class="table table-responsive" id="ReportTable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Month</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Teacher</th>
                                    <th>Average Review</th>
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
    <!-- BOOTSTRAP JS -->
    {{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"--}}
    {{--integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">--}}
    {{--</script>--}}

    <!-- Selectize JS -->
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
        /*$(function () {

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

        });*/

    </script>

    <script>

        let table = $('#TableBody');
        Selectize($('#selectMonth'));


        $('#selectClass').selectize({
            onChange: function (value){
                GetHomework();
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
            // $('#homeworkPanel').addClass('d-none');
            GetHomework();
        });

        $('#selectMonth').on('change', function () {
            // alert('hello')
            GetHomework();
        });


        function GetHomework(){
            let selectMonth = $('#selectMonth').val();
            let section = $('#sectionList').val();
            let classID  = $('#selectClass').val();
            let filerArea = $('#FilterArea');
            let exportArea = $('#ExportArea');
            let listArea = $('#listArea');
            if(selectMonth != "" && section != "" && classID != ""){
                filerArea.removeClass('d-none');
            }
            else{
                filerArea.addClass('d-none');
                exportArea.addClass('d-none');
                listArea.addClass('d-none');
            }
        }



        //Export To CSV
        $('#csvBtn').on('click', function (e) {
            e.preventDefault();
            let selectMonth = $('#selectMonth').val();
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            window.location.href = `/reports/teacher-remarks/export-csv/${selectMonth}/${classID}/${sectionID}`;
        });

        //Export To PDF
        $('#pdfBtn').on('click', function (e) {
            e.preventDefault();
            let selectMonth = $('#selectMonth').val();
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            window.location.href = `/reports/teacher-remarks/export-pdf/${selectMonth}/${classID}/${sectionID}`;
        });


        //Read Data
        $('#filterBtn').on('click', function () {
            let selectMonth = $('#selectMonth').val();
            let exportArea = $('#ExportArea');
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            let listArea = $('#listArea');
            if(selectMonth != "" && classID != "" && sectionID != "" ){
                PreloaderON();
                axios.get(`/reports/teacher-remarks/get/${selectMonth}/${classID}/${sectionID}`)
                    .then(function (response) {
                        if(response.status === 200){
                            PreloaderOFF();
                            exportArea.removeClass('d-none');
                            listArea.removeClass('d-none')
                            let data = response.data;
                            if(data.length > 0){
                                table.empty();
                                data.forEach(function(item, index){
                                    Item(item)
                                });
                            }
                            else{
                                listArea.addClass('d-none');
                                exportArea.addClass('d-none');
                                Toast("No record found")
                            }

                            $('#ReportTable').DataTable().destroy();
                            $('#ReportTable').DataTable({
                                fixedHeader: true,
                            });
                        }
                    })
                    .catch(function (error) {
                        PreloaderOFF();
                        console.log(error)
                        Toast("Server Error.")
                    })
            }
            else{
                Toast("Please select all criteria.");
                exportArea.addClass('d-none')
                listArea.addClass('d-none')
            }
        });

        function Item(item) {
            console.log(item)
            table.append(`
                <tr>
                    <td>${item.sl}</td>
                    <td>${item.month}</td>
                    <td>${item.class}</td>
                    <td>${item.section}</td>
                    <td>${item.teacher_name}</td>
                    <td>${item.avg_review}</td>
                </tr>
            `)
        }

    </script>
@endsection
