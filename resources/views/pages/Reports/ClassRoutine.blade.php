@extends('layout.App')
@section('MainContent')
    <!-- START ATTENDANCE REPORT HEADING -->
    <section class="section-attendanceReport--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Class Routine Report</h2>
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

@endsection

@section('scripts-before')

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
        let exportArea = $('#ExportArea')
        $('#selectClass').selectize({
            onChange: function (value){
                exportArea.addClass('d-none');
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
            GetHomework();
        });


        function GetHomework(){
            exportArea.addClass('d-none');
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            if(classID != "" && sectionID != ""){
                let startDate =$('#ReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                let endDate = $('#ReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
                axios.get(`/reports/class-routine/get/${startDate}/${endDate}/${classID}/${sectionID}`)
                    .then(function (response) {
                        if(response.status === 200){
                            let data = response.data;
                            (data.length > 0) ? exportArea.removeClass('d-none') : Toast("No record found");
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                        Toast("Server Error.")
                    })

            }
            else{
                exportArea.addClass('d-none')
            }
        }



        //Export To CSV
        $('#csvBtn').on('click', function (e) {
            e.preventDefault();
            let startDate =$('#ReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#ReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            window.location.href = `/reports/class-routine/export-csv/${startDate}/${endDate}/${classID}/${sectionID}`;
        });

        //Export To PDF
        $('#pdfBtn').on('click', function (e) {
            e.preventDefault();
            let startDate =$('#ReportRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let endDate = $('#ReportRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            window.location.href = `/reports/class-routine/export-pdf/${startDate}/${endDate}/${classID}/${sectionID}`;
        });

    </script>
@endsection
