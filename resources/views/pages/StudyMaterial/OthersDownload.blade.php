@extends('layout.App')
@section('MainContent')

    <!-- START UPLOAD CONTENT HEADING -->
    <section class="section-uploadContent--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Other Downloads</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END UPLOAD CONTENT HEADING -->

    <div class="container">
        <div class="row u-padding-lg pt-0">
            <div class="col-md-4">
                <!-- START UPLOAD CONTENT -->
                <section class="section-uploadContent otherDownloads">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Upload Content</h3>
                        </div>
                        <div class="card-body">
                            <form id="CreateForm" action="/" method="post">
                                <input type="text" class="form-control" name="" id="title" placeholder="Content Title*" required />
                                <textarea type="text" class="form-control" name="" id="details" placeholder="Content Details"
                                          style="height: 10rem;"></textarea>
                                <div class="d-flex input-daterange">
                                    <input type="text" id="date" class="form-control" placeholder="Date" />
                                </div>
                                <input id="fileid" type="file" hidden />
                                <button type="button" id="buttonid" class="btn-addFile" role="button"><span class="text">Add
                        File*</span><span>Browse</span></button>
                                <p class="text-danger mt-2 text-end" id="file-upload-filename">
                                    (Only upload pdf files)
                                </p>
                                <h4 class="mt-3 mb-2 fs-3">Available for*</h4>
                                <div class="form-check">
                                    <input  class="form-check-input availableFor" type="checkbox" value="0" id="">
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
                                    <input class="form-check-input availableFor"  type="checkbox" value="1" id="">
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
                                    <th>Content Title</th>
                                    <th>Content Details</th>
                                    <th>Date</th>
                                    <th>Available For</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="contentTable">

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
                <form id="UpdateForm" action="/" method="post" class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="downloadID">

                        <input type="text" class="form-control" name="" id="uTitle" placeholder="Content Title*"
                               required />
                        <textarea type="text" class="form-control" id="uDetails" name="" placeholder="Content Details"
                                  style="height: 10rem;"></textarea>
                        <div class="d-flex input-daterange">
                            <input type="text" class="form-control" id="uDate" placeholder="Date" />
                        </div>
                        <input id="fileid2" type="file" hidden />
                        <button id="buttonid2" class="btn-addFile" type="button" role="button"><span class="text">Add
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
                        <button data-bs-dismiss="modal" aria-label="Close" type="submit" class="btn btn-text px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <!--End Modal -->

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
        PreloaderON()
        let role = ["admin", "student","parent","teacher","staff","accountant","librarian","driver"];
        AllContetns()
        function AllContetns() {
            axios.get('/study-material/get-contents')
            .then(function (response) {
                if(response.status === 200){
                    PreloaderOFF();
                    let data = response.data;
                    let table = $('#contentTable');
                    table.empty();
                    data.forEach(function (item, index) {
                        ContentItem(table,item,index);
                    })
                }
            })
            .catch(function (error) {

            })
        }

        CreateOther();
        function CreateOther(){
            $('#CreateForm').on('submit', function(e){
                PreloaderON();
                e.preventDefault();

                let availableFor = $('.availableFor');
                let title = $('#title').val();
                let details = $('#details').val();
                let date = $('#date').val();
                let imagefile = document.querySelector('#fileid');
                let file = imagefile.files[0];
                if(file == undefined || file == "undefined"){
                    PreloaderOFF();
                    return Toast("File is required");
                }
                let formData = new FormData();
                formData.append('date', date);
                formData.append('title', title);
                formData.append('details', details);
                formData.append('file', file);
                let userType = [];

                for(let i =0; i < availableFor.length; i++){
                    if(availableFor[i].checked){
                        userType.push(availableFor[i].value);
                    }

                }
                formData.append('user_type', userType);

                axios.post('/study-material/other/save', formData)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        $('#file-upload-filename').empty();
                        $('#fileid2').val("");
                        $('#date').val("")
                        $('#title').val("");
                        $('#details').val("");

                        AllContetns();
                    }
                    else{
                        PreloaderOFF();
                        Toast(response.data.message)
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                    Toast("Something went wrong")
                    console.log(error)
                })

            })
        }



        //Delete
        $('#contentTable').on('click','.delete', function(){
            PreloaderON();
            let id = $(this).attr('data-id');
            axios.get('/study-material/other/delete/'+id)
            .then(function (response) {
                if(response.status === 200){
                    AllContetns();
                }
            })
            .catch(function(error){
                console.log(error)
            })
        })

        //Get Single Data And Set Data To Modal
        $('#contentTable').on('click', '.edit', function () {
            // PreloaderON();
            let id = $(this).attr('data-id');

            var config = {
                method: 'get',
                url: '{{env('API_URL')}}/admin/other-download/'+id,
                headers: {
                    'Authorization': 'Bearer {{session('__token')}}'
                }
            };

            axios(config)
                .then(function (response) {
                    PreloaderOFF()
                    if(response.status === 200){
                        let data = response.data;
                        let title = $('#uTitle');
                        let details = $('#uDetails');
                        let date = $('#uDate');
                        let id = $('#downloadID');
                        let availableFor = $('.uAvailableFor');

                        //Set Value To Modal
                        title.val(data.title);
                        details.val(data.details);
                        date.val(data.date);
                        id.val(data.id);

                        //All checkbox unchecked
                        for(let i =0; i < availableFor.length; i++){
                            availableFor[i].removeAttribute('checked');
                        }

                        //Available User Set Checkbox
                        let availableUserType = JSON.parse(data.user_type);
                        availableUserType.forEach(function (item) {
                            $('#role-'+item).attr('checked','checked')
                        });

                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        })

        //Update Modal
        $('#UpdateForm').on('submit', function(e){
            e.preventDefault();
            PreloaderON();
            let title = $('#uTitle').val();
            let details = $('#uDetails').val();
            let date = $('#uDate').val();
            let file = document.querySelector('#fileid2').files[0];
            let availableFor = $('.uAvailableFor');
            let id = $('#downloadID').val();

            let formData = new FormData();
            formData.append('date', date);
            formData.append('title', title);
            formData.append('details', details);
            formData.append('file', file);
            let userType = [];

            for(let i =0; i < availableFor.length; i++){
                if(availableFor[i].checked){
                    userType.push(availableFor[i].value);
                }

            }
            formData.append('user_type', userType);

            axios.post('/study-material/other/update/'+id, formData)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        $('#file-upload-filename2').empty();
                        $('#fileid2').val("");
                        $('.btn-close').trigger('click');
                        AllContetns();
                    }
                    else{
                        PreloaderOFF();
                        Toast(response.data.message)
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                    Toast("Something went wrong")
                    console.log(error)
                })

        })


        function ContentItem(table, item, index) {
            var abilableFor = "";
            var arr =  JSON.parse(item.user_type);

            console.log(arr)
            arr.forEach(function (item) {
                abilableFor += role[parseInt(item)] + ", ";
            });

            let fileUrl = "{{env('API_FILE_URL')}}"+item.file;
            table.append(`
                <tr>
                    <td scope="row">${index+1}</td>
                    <td>
                        <a href="${fileUrl}" class="content-link">
                           ${item.title}
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

                            <button data-id="${item.id}" class="btn delete px-2">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `)
        }
    </script>
@endsection
