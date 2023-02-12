@extends('layout.App')
@section('MainContent')
    <!-- START UPLOAD CONTENT HEADING -->
    <section class="section-uploadContent--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Notice Board</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END UPLOAD CONTENT HEADING -->

    <div class="container">
        <div class="row u-padding-lg pt-0">
            <div class="col-md-4">
                <!-- START UPLOAD CONTENT -->
                <section class="section-uploadContent uploadNotice">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Upload Content</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="NoticeForm" class="position-relative">
                                <input type="text" class="form-control" id="subject" name="" placeholder="Notice Subject*" required />
                                <textarea class="form-control" id="details" placeholder="Notice Details"></textarea>
                                <div class="d-flex input-daterange">
                                    <input type="text" id="date" class="form-control" placeholder="Date" />
                                </div>
                                <input id="fileid" type="file" hidden />
                                <button type="button" id="buttonid" class="btn-addFile" role="button"><span class="text">Add
                        File*</span><span>Browse</span></button>
                                <p class="text-danger text-end mt-2" id="file-upload-filename">
                                    (Only upload pdf files)
                                </p>
                                <h4 class="mt-3 mb-2 fs-3">Available for*</h4>
                                <div class="form-check">
                                    <input class="form-check-input availableFor" type="checkbox" value="0" id="">
                                    <label class="form-check-label" for="">
                                        Admin
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input availableFor" type="checkbox" value="3" id="">
                                    <label class="form-check-label" for="">
                                        Teacher
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input availableFor" type="checkbox" value="1" id="">
                                    <label class="form-check-label" for="">
                                        Student
                                    </label>
                                </div>
                                <div class="form-check mb-5">
                                    <input class="form-check-input availableFor" type="checkbox" value="2" id="">
                                    <label class="form-check-label" for="">
                                        Parent
                                    </label>
                                </div>
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
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 68vh">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Notice Subject</th>
                                    <th>Notice Details</th>
                                    <th>Date</th>
                                    <th>Available For</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="ContentTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Model -->
    <div class="modal fade" id="editContent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('layout.ModalLoader')

                <div id="ModalBody" class="d-none">
                    <form id="UpdateNoticeForm">
                        <input type="hidden" id="data-id">

                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" name="" id="uSubject" placeholder="Notice Subject*"
                                   required />
                            <textarea type="text" class="form-control" name="" id="uDetails" placeholder="Notice Details"
                                      style="height: 10rem;"></textarea>
                            <div class="d-flex input-daterange">
                                <input type="text" class="form-control" id="uDate" placeholder="Date" />
                            </div>
                            <input id="fileid2" type="file" hidden />
                            <button type="button" id="buttonid2" class="btn-addFile" role="button"><span class="text">Add
                                        File*</span><span>Browse</span></button>
                            <p class="text-danger mt-2 text-end" id="file-upload-filename2">
                                (Only upload pdf files)
                            </p>
                            <h4 class="mt-3 mb-2 fs-3">Available for*</h4>
                            <div class="form-check">
                                <input class="form-check-input uAvailableFor" type="checkbox" value="0" id="role-0">
                                <label class="form-check-label" for="">
                                    Admin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input uAvailableFor" type="checkbox" value="3" id="role-3">
                                <label class="form-check-label" for="">
                                    Teacher
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input uAvailableFor" type="checkbox" value="1" id="role-1">
                                <label class="form-check-label" for="">
                                    Student
                                </label>
                            </div>
                            <div class="form-check mb-5">
                                <input class="form-check-input uAvailableFor" type="checkbox" value="2" id="role-2">
                                <label class="form-check-label" for="">
                                    Parent
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-text px-4"
                                    data-bs-dismiss="modal">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODEL -->

    <!-- END UPLOAD CONTENT LIST -->
    </div>
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
        let role = ["admin", "student","parent","teacher","staff","accountant","librarian","driver"];
        PreloaderON();
        GetNotice();
        function GetNotice() {
            axios.get('/get-notice')
            .then(function(response){
                PreloaderOFF()
                if(response.status === 200){
                    let data = response.data;
                    let table = $('#ContentTable');
                    table.empty();
                    data.forEach(function(item, index){
                        NoticeItem(table,item,index)
                    });
                    DownloadToast(table);
                }
            })
            .catch(function(error){
                console.log(error)
            })
        }

        CreateNotice();
        function CreateNotice(){
            $('#NoticeForm').on('submit', function(e){
                PreloaderON();
                e.preventDefault();
                let subject = $('#subject').val();
                let details = $('#details').val();
                let date = $('#date').val();
                let getFile = document.querySelector('#fileid');
                let file = getFile.files[0];
                let availableFor = $('.availableFor');
                let formData = new FormData();

                let d = date.split('/');
                formData.append('subject', subject);
                formData.append('details', details);
                formData.append('date', d[2]+"-"+d[1]+"-"+d[0]);
                formData.append('file', file);
                let userType = [];

                for(let i =0; i < availableFor.length; i++){
                    if(availableFor[i].checked){
                        userType.push(availableFor[i].value);
                    }
                }
                formData.append('user_type', userType);

                axios.post('/notice/save', formData)
                    .then(function (response) {
                        if(response.status === 200 && response.data.status == true){
                            GetNotice();
                        }
                        else{
                            PreloaderOFF();
                            Toast(response.data.message);

                        }
                    })
                    .catch(function (error) {
                        PreloaderOFF();
                        Toast("Something went wrong");
                        console.log(error)
                    })
            })
        }

        //Delete Notice
        $('#ContentTable').on('click','.delete', function(){
            PreloaderON();
            let id = $(this).attr('data-id');
            axios.get('/notice/delete/'+id)
                .then(function (response) {
                    // PreloaderOFF();
                    if(response.status === 200){
                        GetNotice();
                    }
                })
                .catch(function(error){
                    console.log(error)
                })
        });


        //Get Single Notice
        $('#ContentTable').on('click', '.edit', function () {
            ModalLoaderON()
            let id = $(this).attr('data-id');
            axios.get('/notice/get-single/' + id)
                .then(function (response) {
                    ModalLoaderOFF()
                    if (response.status === 200) {
                        let data = response.data;
                        let subject = $('#uSubject');
                        let details = $('#uDetails');
                        let date = $('#uDate');
                        let id = $('#data-id');
                        let availableFor = $('.uAvailableFor');

                        let d = data.date.split('-')
                        //Set Value To Modal
                        subject.val(data.subject);
                        details.val(data.details);
                        date.val(d[0]+"/"+d[1]+"/"+d[2]);
                        id.val(data.id);

                        //All checkbox unchecked
                        for (let i = 0; i < availableFor.length; i++) {
                            availableFor[i].removeAttribute('checked');
                        }

                        //Available User Set Checkbox
                        let availableUserType = JSON.parse(data.user_type);
                        availableUserType.forEach(function (item) {
                            $('#role-' + item).attr('checked', 'checked')
                        });

                    }
                })
        });

        //Update Notice
        UpdateNotice()
        function UpdateNotice(){
            $('#UpdateNoticeForm').on('submit', function(e){
                e.preventDefault();
                PreloaderON();
                let subject = $('#uSubject').val();
                let details = $('#uDetails').val();
                let date = $('#uDate').val();
                let id = $('#data-id').val();
                let getFile = document.querySelector('#fileid2');
                let file = getFile.files[0];
                let availableFor = $('.uAvailableFor');
                let formData = new FormData();

                let d = date.split('/');
                formData.append('subject', subject);
                formData.append('details', details);
                formData.append('date', d[2]+"-"+d[1]+"-"+d[0]);
                if(file != undefined){
                    formData.append('file', file);
                }

                let userType = [];

                for(let i =0; i < availableFor.length; i++){
                    if(availableFor[i].checked){
                        userType.push(availableFor[i].value);
                    }

                }
                formData.append('user_type', userType);

                axios.post('/notice/edit/'+id, formData)
                    .then(function (response) {
                        if(response.status === 200 && response.data.status == true){
                            GetNotice();
                        }
                        else{
                            PreloaderOFF();
                            Toast(response.data.message);

                        }
                    })
                    .catch(function (error) {
                        PreloaderOFF();
                        Toast("Something went wrong");
                        console.log(error)
                    })
            })
        }

        function NoticeItem(table, item, index){

            var abilableFor = "";
            var arr =  JSON.parse(item.user_type);

            arr.forEach(function (item) {
                abilableFor += role[parseInt(item)] + ", ";
            });



            let fileUrl = "{{env('API_FILE_URL')}}"+item.file;

            table.append(`
                <tr>
                    <td scope="row">${index+1}</td>
                    <td>
                        <a href="${(item.file != null ? fileUrl : "null")}" class="content-link download-link">
                            ${item.subject}
                        </a>
                    </td>
                    <td>${item.details}</td>
                    <td>${item.date}</td>
                    <td>${abilableFor.substr(0, abilableFor.length-2)}</td>
                    <td>
                        <div class="d-flex">
                            <button type="button" data-id="${item.id}" class="btn edit px-2">
                                <i class="bi bi-pencil-fill text-success me-2" data-bs-toggle="modal"
                                   data-bs-target="#editContent"></i>
                            </button>

                            <button data-id="${item.id}" type="button" class="btn delete  px-2">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `)
        }


    </script>
@endsection
