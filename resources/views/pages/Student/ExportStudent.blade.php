@extends('layout.App')
@section('MainContent')
    <!-- START ALL STUDENT EXPORT HEADING -->
    <section class="section-allStudentExport--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">All Student Export</h2>
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
                            <a href="/student/export/csv" {{--id="exportCSVBtn"--}} type="button" class="btn btn-text px-4 me-4">
                                Export to CSV
                            </a>
                            <a href="/student/export/pdf" {{--id="exportPDFBtn"--}} type="button" class="btn btn-text px-4 d-none">
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
        $('#exportCSVBtn').on('click', function () {
            axios.get('/student/export/get')
            .then(function (response) {
                console.log(response)
                if(response.status === 200){
                    let data = response.data;
                    var headers = {
                        name: "Name",
                        roll: "Roll",
                        class: "Class",
                        section: "Section",
                    };



                    var itemsNotFormatted = data;

                    var itemsFormatted = [];

                    // format the data
                    itemsNotFormatted.forEach((item) => {
                        itemsFormatted.push({
                            name: item.name,
                            roll: item.roll,
                            class: item.class,
                            section: item.section,
                        });

                    });

                    var fileTitle = 'students'; // or 'my-unique-title'

                    exportCSVFile(headers, itemsFormatted,  fileTitle); // call the exportCSVFile() function to process the JSON and trigger the download

                }
            })
            .catch(function (error) {
                console.log(error)
            })
        })


    </script>
@endsection
