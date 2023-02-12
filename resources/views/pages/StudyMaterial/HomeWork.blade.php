@extends('layout.App')
@section('MainContent')

    <!-- START UPLOAD CONTENT HEADING -->
    <section class="section-uploadContent--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Upload Homework</h2>
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
                            <div class="col-md-4">
                                <select id="selectClass" >
                                    <option class="dropdown-item" value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}" class="dropdown-item">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="sectionList" style="visibility: hidden">
                                    <option class="dropdown-item" value="">Select Section</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="selectSubject">
                                    <option class="dropdown-item" value="">Select Subject</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}" class="dropdown-item">{{$subject->name}}</option>
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

    <div id="homeworkPanel" class="container d-none">
        <div class="row u-padding-lg pt-0">
            <div class="col-md-4">
                <!-- START UPLOAD CONTENT -->
                <section class="section-uploadContent uploadHomework">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Upload Content</h3>
                        </div>
                        <div  class="card-body">
                            <form id="homeworkForm"  action="/study-material/save" method="post" enctype="multipart/form-data">
                                 @csrf
                                <input id="title" type="text" class="form-control" name="" placeholder="Content Title*" required />
                                <textarea id="details" type="text" class="form-control" name="" placeholder="Content Details" style="height: 10rem;"></textarea>
                                <div class="d-flex input-daterange">
                                    <input id="submissionDate" type="text" class="form-control" placeholder="Date of Submission" />
                                </div>
                                <input id="fileid" name="file" type="file" hidden />
                                <button type="button" id="buttonid" class="btn-addFile" role="button"><span class="text">Add File*</span><span>Browse</span></button>
                                <p class="text-danger mt-2 text-end" id="file-upload-filename">
                                    (Only upload pdf files)
                                </p>
                                <div class="text-center">
                                    <button type="submit"  class="btn btn-text mt-4">Upload</button>
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
                            <h3 class="heading--sub">Uploaded Content List</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 51vh">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Content Title</th>
                                    <th>Content Details</th>
                                    <th>Submit By</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="homeworkTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END UPLOAD CONTENT LIST -->

    <!-- Update Modal -->
    <div class="modal fade" id="editContent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('layout.ModalLoader')
                <div id="ModalBody">
                    <form action="" id="HomeWorkUpdateForm">
                        <input type="hidden" id="data-id">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="uTitle" class="form-control" name="" placeholder="Content Title*" required />
                            <textarea type="text" class="form-control" id="uDetails" name="" placeholder="Content Details" style="height: 10rem;"></textarea>
                            <div class="d-flex input-daterange">
                                <input type="text" id="uDate" class="form-control" placeholder="Date of Submission" />
                            </div>
                            <input id="fileid2" type="file" hidden />
                            <button id="buttonid2"  type="button" class="btn-addFile" role="button"><span class="text">Add File*</span><span>Browse</span></button>
                            <p class="text-danger mt-2 text-end" id="file-upload-filename2">
                                (Only upload pdf files)
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button  type="submit" class="btn btn-text px-4" data-bs-dismiss="modal">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Upload Modal -->
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
        //Selectize
        Selectize($('#sectionList'));
        Selectize($('#selectSubject'));
        //End Selectize
        PreloaderOFF();


        $('#selectClass').selectize({
            onChange: function (value){
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

                GetHomework();
            }
        });


        $('#sectionList').on('change', function () {
            GetHomework();
        });

        $('#selectSubject').on('change', function () {
            GetHomework();
        });


        function GetHomework(){
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            let subjectID = $('#selectSubject').val();

            if(classID != "" && sectionID != "" && subjectID != ""){
                PreloaderON();
                $('#homeworkPanel').removeClass('d-none');
                /*var config = {
                    method: 'get',
                    url: `https://school.wsfilter.com/public/api/homeworks?class=${classID}&section=${sectionID}&subject=${subjectID}`,
                    headers: {
                        'Authorization': 'Bearer {{session("__token")}} ',
                        'Cookie': 'laravel_session=SsU3U7bbgS4tSZrHjmilfOF3wnASlGEpw5gjC4gM'
                    }
                };

                axios(config)*/
                axios.get(`/study-material/homework/get-all/${classID}/${sectionID}/${subjectID}`)
                    .then(function (response) {
                        PreloaderOFF()
                        if(response.status === 200){
                            let data = response.data;
                            $('#homeworkTable').empty();
                            data.forEach(function (item, index) {
                                HomeWorkList(item,index)
                            })

                            DownloadToast($('#homeworkTable'))
                        }
                    })
                    .catch(function (error) {
                        PreloaderOFF()
                        console.log(error);
                    });
            }else{
                $('#homeworkPanel').addClass('d-none')
            }
        }

        CreateHomeWork();
        function CreateHomeWork(){
            $('#homeworkForm').on('submit', function(e){
                PreloaderON();
                e.preventDefault();

                let classID = $('#selectClass').val();
                let sectionID = $('#sectionList').val();
                let subjectID = $('#selectSubject').val();

                let title = $('#title').val();
                let details = $('#details').val();
                let submissionDate = $('#submissionDate').val();
                let imagefile = document.querySelector('#fileid');
                let file = imagefile.files[0];

               /* if(file == undefined || file == "undefined"){
                    PreloaderOFF();
                    return Toast("File is required");
                }*/


                let newDate = submissionDate.split('/');

                let formData = new FormData();
                formData.append('submission_date', newDate[0] + "-" + newDate[1] + "-" + newDate[2]);
                formData.append('title', title);
                formData.append('details', details);
                (file != undefined || file != "undefined") ? formData.append('file', file) : "";
                formData.append('created_by', '1');
                formData.append('class', classID);
                formData.append('subject', subjectID);
                formData.append('section', sectionID);


                axios.post('/study-material/homework/save', formData)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        $('#title').val("");
                        $('#submissionDate').val("");
                        $('#details').val("");
                        $('#fileid').val("");
                        $('#file-upload-filename').empty();
                        GetHomework();
                    }
                })
                .catch(function (error) {
                    console.log(error)
                })

            })
        }

        //Get Details Homework And Set Data To Modal
        $('#homeworkTable').on('click','.edit', function () {
            ModalLoaderON()
            let id = $(this).attr('data-id');
            console.log(id)
            axios.get('/study-material/homework/get/'+id)
            .then(function (response) {
                if(response.status === 200){
                    ModalLoaderOFF()
                    let data = response.data;
                    $('#data-id').val(data.id)
                    $('#uTitle').val(data.title)
                    $('#uDetails').val(data.details)
                    let newDate = data.submission_date.split('-');
                    console.log(newDate)
                    $('#uDate').val(newDate[0] + "/" + newDate[1] + "/" + newDate[2])
                }
            })
            .catch(function (error) {

            });
        })


        //Update HomeWork
        $('#HomeWorkUpdateForm').on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            let subjectID = $('#selectSubject').val();

            let id = $('#data-id').val();
            let title = $('#uTitle').val()
            let details = $('#uDetails').val()
            let date = $('#uDate').val();
            let file = document.querySelector('#fileid2').files[0];
            let newDate = date.split('/');

            let formData = new FormData();
            formData.append('submission_date', newDate[0] + "-" + newDate[1] + "-" + newDate[2]);
            formData.append('title', title);
            formData.append('details', details);
            (file != undefined || file != "undefined") ? formData.append('file', file) : "";
            formData.append('created_by', '1');
            formData.append('class', classID);
            formData.append('subject', subjectID);
            formData.append('section', sectionID);

            let url = "/study-material/homework/update/"+id;
            axios.post(url, formData)
            .then(function (response) {
                PreloaderOFF();
                if(response.status === 200){
                    $('#fileid2').val("");
                    $('#file-upload-filename2').empty();
                    GetHomework();
                }
            })
            .catch(function (error) {
                console.log(error)
            });
        });


        //Delete Home Work
        $('#homeworkTable').on('click','.delete', function () {
            PreloaderON();
            let id = $(this).attr('data-id');

            axios.get('/study-material/homework/delete/'+id)
            .then(function (response) {
                if(response.status === 200 && response.data.status == true){
                    GetHomework();
                }
            })
            .catch(function (error) {

            })
        });


{{--        {{env('API_FILE_URL')}}${item.file}--}}
        function HomeWorkList(item, index) {
            let list = $('#homeworkTable');
            let fileUrl = "{{env('API_FILE_URL')}}"+item.file;
            list.append(`
                <tr>
                    <td scope="row">${index+1}</td>
                    <td>
                        <a href="${(item.file != null ? fileUrl : "null")}" class="content-link download-link">
                            ${item.title}
                        </a>
                    </td>
                    <td>${item.details}</td>
                    <td>${item.submission_date}</td>
                    <td>
                        <div class="d-flex">
                            <button data-id="${item.id}" type="button" class="btn edit px-2">
                                <i class="bi bi-pencil-fill text-success  me-2" data-bs-toggle="modal" data-bs-target="#editContent"></i>
                            </button>

                            <button data-id="${item.id}" class="btn delete px-2">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `);
        }



    </script>
@endsection
