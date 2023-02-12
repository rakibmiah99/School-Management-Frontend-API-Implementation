@extends('layout.App')
@section('MainContent')
    <!-- START ALL STUDENT EXPORT HEADING -->
    <section class="section-allStudentExport--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">All Employee Export</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END ALL STUDENT EXPORT HEADING -->

    <!-- START ALL STUDENT EXPORT -->
    <section class="section-allStudentExport u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body mx-auto">
                            <a href="/employee/export/csv" {{--id="exportCSVBtn"--}} type="button" class="btn btn-text px-4 me-4">
                                Export to CSV
                            </a>
                            <a href="/employee/export/pdf" {{--id="exportPDFBtn"--}} type="button" class="btn btn-text px-4 d-none">
                                Export to PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END ALL STUDENT EXPORT -->
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

    </script>
@endsection
