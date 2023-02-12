@extends('layout.App')
@section('MainContent')
    <!-- START UPLOAD CONTENT HEADING -->
    <section class="section-uploadContent--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Upload Syllabus</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END UPLOAD CONTENT HEADING -->

    <!-- START UPLOAD CONTENT CRITERIA -->
    <section class="section-uploadContent--criteria section-criteria u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Select Criteria</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6">
                                <select id="selectClass">
                                    <option class="dropdown-item" value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}" class="dropdown-item">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select id="selectExam">
                                    <option class="dropdown-item" value="">Select Exam Type</option>
                                    @foreach($exam_types as $types)
                                        <option value="{{$types->id}}" class="dropdown-item">{{$types->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END UPLOAD CONTENT CRITERIA -->

    <div id="SyllabusArea" class="container d-none">
        <div class="row u-padding-lg pt-0">
            <div class="col-md-4">
                <!-- START UPLOAD CONTENT -->
                <section class="section-uploadContent uploadSyllabus">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Upload Content</h3>
                        </div>
                        <div class="card-body">
                            <form action="" id="UploadSyllabusForm">
                                <input type="text" class="form-control" name="" id="title" placeholder="Content Title*" required />
                                <textarea type="text" class="form-control" id="details" name="" placeholder="Content Details"
                                          style="height: 10rem;"></textarea>
                                <div class="d-flex input-daterange">
                                    <input type="text" class="form-control" id="date" required placeholder="Date"/>
                                </div>
                                <input id="fileid" type="file" hidden />
                                <button type="button" id="buttonid" class="btn-addFile" role="button"><span class="text">Add File*</span><span>Browse</span></button>
                                <p class="text-danger mt-2 text-end" id="file-upload-filename">
                                    (Only upload pdf files)
                                </p>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-text mt-4">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- END UPLOAD CONTENT -->
            </div>

            <div class="col-md-8">
                <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
                <!-- START UPLOAD CONTENT LIST-->

                <section class="section-uploadContent--list">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Upload Content List</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 51vh">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Content Title</th>
                                    <th>Date</th>
                                    <th>File</th>
                                </tr>
                                </thead>
                                <tbody id="SyllabusListTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="editContent" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="EditUploadForm">

                @include('layout.ModalLoader')

                <div id="ModalBody" class="d-none">
                    <input id="data-id" type="hidden">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" name="" id="title" placeholder="Content Title*" required />
                        <textarea type="text" class="form-control" name="" id="details" placeholder="Content Details"
                                  style="height: 10rem;"></textarea>
                        <div class="d-flex input-daterange">
                            <input type="text" id="date" class="form-control" required placeholder="Date" />
                        </div>
                        <input id="fileid2" type="file" hidden />
                        <button id="buttonid2" type="button" class="btn-addFile" role="button"><span class="text">Add File*</span><span>Browse</span></button>
                        <p class="text-danger mt-2 text-end" id="file-upload-filename2">
                            (Only upload pdf files)
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-text px-4" data-bs-dismiss="modal">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal -->
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
        // PreloaderON()
        let selectClass = $('#selectClass');
        let selectExamType = $('#selectExam');
        let table = $('#SyllabusListTable');
        let syllabusArea = $('#SyllabusArea');
        let uploadForm = $('#UploadSyllabusForm');
        let editUploadForm = $('#EditUploadForm');

        //When Change Class
        selectClass.selectize({
            onChange: function (value) {
                GetSyllabus();
            }
        });

        //When Change Exam Type
        selectExamType.selectize({
            onChange: function (value) {
                GetSyllabus();
            }
        });

        //Create Syllabus
        uploadForm.on('submit', function(e){
            e.preventDefault();
            PreloaderON()
            let title = $('#UploadSyllabusForm #title');
            let date = $('#UploadSyllabusForm #date');
            let details = $('#UploadSyllabusForm #details');
            let file = document.querySelector('#fileid').files[0];
            if(file == undefined || file == "undefined"){
                PreloaderOFF();
                return Toast("File is required");
            }

            let formData = new FormData();
            formData.append('submission_date', date.val());
            formData.append('title', title.val());
            formData.append('details', details.val());
            formData.append('class', selectClass.val());
            formData.append('exam', selectExamType.val());
            formData.append('file', file);

            axios.post('/study-material/syllabus/save', formData)
            .then(function (response) {
                if(response.status === 200 && response.data.status == true){
                    title.val("");
                    date.val("");
                    details.val("");
                    $('#fileid').val("");
                    $('#file-upload-filename').empty();
                    GetSyllabus();
                }
                else{
                    PreloaderOFF();
                    console.log(response.data)
                    Toast(response.data.message);
                }
            })
            .catch(function (error) {
                PreloaderOFF();
                Toast("Something Went Wrong");
                console.log(error)
            })
        });


        //Delete Syllabus
        table.on('click', '.delete', function () {
            PreloaderON();
            let id = $(this).attr('data-id');
            axios.get('/study-material/syllabus/delete/'+id)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        GetSyllabus();
                    }else{
                        console.log(response.data.message)
                    }
                })
                .catch(function (error) {
                    console.log(error)
                })
        });

        //Get All Syllabus
        function GetSyllabus() {
            PreloaderON()
            if(selectClass.val() != "" && selectExamType.val() != ""){
                syllabusArea.removeClass('d-none');
                axios.get(`/study-material/syllabus/get/${selectClass.val()}/${selectExamType.val()}`)
                .then(function (response) {
                    PreloaderOFF();
                    if(response.status === 200){
                        let data = response.data;
                        table.empty();
                        data.forEach(function (item, index) {
                            SyllabusItem(table, item, index);
                        })
                    }
                })
                .catch(function (error) {

                })
            }else{
                syllabusArea.addClass('d-none')
                PreloaderOFF()
            }
        }

        //Get Single Data
        table.on('click', '.edit', function () {
            ModalLoaderON();
            let id = $(this).attr('data-id');
            axios.get('/study-material/syllabus/get-single/'+id)
            .then(function (response) {
                if(response.status === 200){
                    let data = response.data;
                    $('#data-id').val(data.id)
                    $('#EditUploadForm #title').val(data.title);
                    $('#EditUploadForm #details').val(data.details);

                    let d = data.create_date.split('-');

                    $('#EditUploadForm #date').val(d[2]+"/"+d[1]+"/"+d[0]);


                    ModalLoaderOFF();
                }
            })
            .catch(function (error) {
                console.log(error)
            })
        })


        //Update Syllabus
        editUploadForm.on('submit', function (e) {
            e.preventDefault();
            PreloaderON();
            let title = $('#EditUploadForm #title');
            let date = $('#EditUploadForm #date');
            let details = $('#EditUploadForm #details');
            let file = document.querySelector('#fileid2').files[0];
            let id = $('#data-id').val()

            let formData = new FormData();
            formData.append('submission_date', date.val());
            formData.append('title', title.val());
            formData.append('details', details.val());
            formData.append('class', selectClass.val());
            formData.append('exam', selectExamType.val());
            formData.append('file', file);

            axios.post('/study-material/syllabus/edit/'+id, formData)
            .then(function (response) {
                PreloaderOFF()
                if(response.status === 200 && response.data.status == true){
                    title.val("");
                    date.val("");
                    details.val("");
                    $('#fileid2').val("");
                    $('#file-upload-filename2').empty();
                    GetSyllabus();
                }
                else{
                    PreloaderOFF();
                    console.log(response.data)
                    Toast(response.data.message);
                }
            })
            .catch(function (error) {
                PreloaderOFF();
                Toast("Something went wrong. please wait!");
                console.log(error)
            })
        });



        function SyllabusItem(table, item, index) {
            let fileUrl = "{{env('API_FILE_URL')}}"+item.file;
            table.append(`
                <tr>
                    <td scope="row">${index+1}</td>
                    <td>
                        <a href="${fileUrl}" class="content-link">
                            ${item.title}
                        </a>
                    </td>
                    <td>${(item.create_date != null) ? item.create_date : "-"}</td>
                    <td>
                        <div class="d-flex">
                            <button data-id="${item.id}" type="button" class="btn edit px-2">
                                <i class="bi bi-pencil-fill text-success me-2"
                                   data-bs-toggle="modal" data-bs-target="#editContent"></i>
                            </button>
                            <button data-id="${item.id}" class="btn delete  px-2">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `);
        }
    </script>
@endsection
