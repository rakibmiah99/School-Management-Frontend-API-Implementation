@extends('layout.App')
@section('MainContent')

    <!-- START UPLOAD CONTENT HEADING -->
    <section class="section-uploadContent--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Student Diary</h2>
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
                                <select id="selectStudent">
                                    <option class="dropdown-item" value="">Select Student</option>

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
                            <h3 class="heading--sub">Write Comment</h3>
                        </div>
                        <div  class="card-body">
                            <form id="homeworkForm"  action="/study-material/save" method="post" enctype="multipart/form-data">
                                @csrf
                                <textarea id="details" type="text"  required class="form-control" name="" placeholder="Comment for parent*" style="height: 10rem;"></textarea>
                                <div class="text-center">
                                    <button type="submit"  class="btn btn-text mt-4">Comment</button>
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
                            <h3 class="heading--sub">Written Comment List</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 51vh">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Comment</th>
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
                <div class="modal-header">
                    <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                    ></button>
                </div>
                @include('layout.ModalLoader')
                <div id="ModalBody">
                    <form action="" id="UpdateForm">
                        <input type="hidden" id="data-id">
                        @csrf
                        <textarea id="uDetails" type="text"  required class="form-control" name="" placeholder="Comment for parent*" style="height: 10rem;"></textarea>
                        <div class="modal-footer">
                            <button  type="submit" class="btn btn-text px-4" data-bs-dismiss="modal">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Upload Modal -->


    <div
            class="modal fade"
            id="deleteModal"
            tabindex="-1"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            role="dialog"
            aria-labelledby="modalTitleId"
            aria-hidden="true"
    >
        <div
                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                role="document"
        >
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button
                            type="button"
                            class="btn-close fs-5"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body p-5">
                    <img
                            src="../assets/images/delete.png"
                            alt="dustbin image"
                            class="img-fluid"
                    />
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer border-0">
                    <button
                            type="button"
                            class="btn btn-delete"
                    >
                        Delete
                    </button>
                    <button
                            type="button"
                            class="btn btn-cancel"
                            data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
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
        //Selectize
        Selectize($('#sectionList'));
        Selectize($('#selectStudent'));
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
            }
        });


        $('#sectionList').on('change', function () {
            $('#homeworkPanel').addClass('d-none');
            let section_id = $(this).val();
            let class_id = $('#selectClass').val();
            axios.get(`/study-material/student-diary/get-students/${class_id}/${section_id}`)
            .then(function (response) {
                if(response.status === 200){
                    let data = response.data;
                    $('#selectStudent').each(function() {
                        if (this.selectize) {
                            this.selectize.destroy();
                        }
                    });
                    let selectSubject = $('#selectStudent');
                    selectSubject.empty();
                    selectSubject.append(`
                        <option class="dropdown-item" value="">Select Student</option>
                    `);
                    data.forEach(function (item){
                        selectSubject.append(`
                            <option value="${item.id}" class="dropdown-item">${item.name}</option>
                        `);
                    });
                    Selectize(selectSubject)
                }
            })
            .catch(function (error) {

            })
        });

        $('#selectStudent').on('change', function () {
            GetHomework();
        });


        function GetHomework(){
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            let studentID = $('#selectStudent').val();

            if(classID != "" && sectionID != "" && studentID != ""){
                PreloaderON();
                $('#homeworkPanel').removeClass('d-none');
                    axios.get(`/study-material/student-diary/get/${classID}/${sectionID}/${studentID}`)
                    .then(function (response) {
                        PreloaderOFF()
                        if(response.status === 200){
                            let data = response.data;
                            $('#homeworkTable').empty();
                            data.forEach(function (item, index) {
                                HomeWorkList(item,index)
                            })
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
                let student_id = $('#selectStudent').val();

                let details = $('#details').val();

                let formData = new FormData();
                formData.append('comment', details);
                formData.append('class_id', classID);
                formData.append('student_id', student_id);
                formData.append('section_id', sectionID);


                axios.post('/study-material/student-diary/save', formData)
                .then(function (response) {
                    if(response.status === 200){
                        $('#details').val("");
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
            // console.log(id)
            axios.get(`/study-material/student-diary/get/${id}`)
                .then(function (response) {
                    if(response.status === 200){
                        ModalLoaderOFF()
                        let data = response.data;
                        $('#uDetails').val(data.comment)
                        $('#data-id').val(data.id);
                    }
                })
                .catch(function (error) {

                });
        })


        /** Set Data to Delete Modal */
        $('#homeworkTable').on('click', '.deleteBtn', function () {
            let id = $(this).attr('data-id');
            $('#deleteModal .btn-delete').attr('data-id', id);
        });

        /** Delete Data **/
        $('#deleteModal').on('click', '.btn-delete', function () {
            $('#deleteModal .btn-cancel').trigger('click');
            PreloaderON();
            let id = $(this).attr('data-id');
            axios.get('/study-material/student-diary/delete/'+id)
            .then(function (response) {
                if(response.status === 200 && response.data.status == true){
                    GetHomework();
                }
            })
            .catch(function (error) {

            })
        });



        //Update HomeWork
        $('#UpdateForm').on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            let student_id = $('#selectStudent').val();

            let id = $('#data-id').val();
            let details = $('#uDetails').val()
            let formData = new FormData();
            formData.append('comment', details);
            formData.append('class_id', classID);
            formData.append('student_id', student_id);
            formData.append('section_id', sectionID);

            let url = "/study-material/student-diary/update/"+id;
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


        /*//Delete Home Work
        $('#homeworkTable').on('click','.delete', function () {
            PreloaderON();
            let id = $(this).attr('data-id');

            axios.get('/study-material/student-diary/delete/'+id)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        GetHomework();
                    }
                })
                .catch(function (error) {

                })


        });*/


        {{--        {{env('API_FILE_URL')}}${item.file}--}}
        function HomeWorkList(item, index) {
            let list = $('#homeworkTable');
            let fileUrl = "{{env('API_FILE_URL')}}"+item.file;
            list.append(`
                <tr>
                    <td scope="row">${index+1}</td>
                    <td>
                        <div href="${fileUrl}" >
                            ${item.date}
                        </div>
                    </td>
                    <td>${item.comment}</td>
                    <td>
                        <div class="d-flex">
                            <button data-id="${item.id}" type="button" class="btn edit px-2">
                                <i class="bi bi-pencil-fill text-success  me-2" data-bs-toggle="modal" data-bs-target="#editContent"></i>
                            </button>

                            <button
                                type="button"
                                data-id="${item.id}"
                                class="btn px-2 deleteBtn"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                >
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `);
        }



    </script>
@endsection
