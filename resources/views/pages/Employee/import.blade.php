@extends('layout.App')
@section('MainContent')


    <!-- START IMPORT STUDENT HEADING -->
<section class="section-importStudent--heading u-padding-lg">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="heading--main">Import Employee</h2>
            </div>
        </div>
    </div>
</section>
<!-- END IMPORT STUDENT HEADING -->

<!-- START IMPORT STUDENT BUTTON -->
<section class="section-importStudent--import u-padding-lg pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-4 ms-auto text-end">
                <a class="btn btn-text px-4 py-3" href="../assets/files/import_employee.csv">
                    <i class="bi bi-download text-white fs-4 me-2"></i>
                    Download sample file
                </a>
            </div>
        </div>
    </div>
</section>
<!-- END IMPORT STUDENT BUTTON -->

<!-- START IMPORT STUDENT CRITERIA -->
<section class="section-importStudent--details u-padding-lg pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-title">
                        <h3 class="heading--sub">Select Criteria</h3>
                    </div>
                    <div class="card-body">
                        <form  method="post" action="/employee/import/save" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <input required name="file" id="fileid" type="file" hidden />
                                    <button type="button" id="buttonid" class="btn-addFile" role="button">
                                        <span class="text">Add File*</span>
                                        <span>Browse</span>
                                    </button>
                                    <p class="text-danger mt-2 text-end" id="file-upload-filename">
                                        (Only upload csv files)
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-text mt-4">Bulk Import Employee</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END IMPORT STUDENT CRITERIA -->

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


    </script>

@endsection
