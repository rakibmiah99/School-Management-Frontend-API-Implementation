@extends('layout.App')
@section('MainContent')

    <!-- START UPLOAD CONTENT HEADING -->
    <section class="section-uploadContent--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">All Homeworks</h2>
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
                            <div class="col-md-3">
                                <select id="selectClass" >
                                    <option class="dropdown-item" value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}" class="dropdown-item">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="sectionList" style="visibility: hidden">
                                    <option class="dropdown-item" value="">Select Section</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="selectSubject">
                                    <option class="dropdown-item" value="">Select Subject</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}" class="dropdown-item">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="selectHomeWork" style="visibility: hidden">
                                    <option class="dropdown-item" value="">Select Homework</option>
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
            <div class="col-md-12">
                <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
                <!-- START UPLOAD CONTENT LIST-->
                <section class="section-uploadContent--list">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">All Homeworks</h3>
                        </div>
                        <div class="card-body table-scrollable" style="overflow: auto; max-height: 51vh">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Roll</th>
                                    <th>Student Name</th>
                                    <th>Content Title</th>
                                    <th>Note</th>
                                    <th>Submission Date</th>
                                    <th>Submitted On</th>
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

    <!--Delete Modal -->
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
                            src="{{asset("/assets/images/delete.png")}}"
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
        Selectize($('#selectSubject'));
        Selectize($('#selectHomeWork'));
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

        $('#selectHomeWork').on('change', function () {
            GetSubmitHomeWork();
        });


        function GetHomework(){
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            let subjectID = $('#selectSubject').val();

            if(classID != "" && sectionID != "" && subjectID != ""){
                axios.get(`/study-material/homework/get-all/${classID}/${sectionID}/${subjectID}`)
                    .then(function (response) {
                        if(response.status === 200){
                            let data = response.data;

                            let selectHomeWork = $('#selectHomeWork');
                            selectHomeWork.each(function() {
                                if (this.selectize) {
                                    this.selectize.destroy();
                                }
                            });
                            selectHomeWork.empty();
                            selectHomeWork.append(`
                                <option class="dropdown-item" value="">Select Homework</option>
                            `);

                            data.forEach(function (item) {
                                selectHomeWork.append(`
                                    <option value="${item.id}" class="dropdown-item">${item.title}</option>
                                `);
                            })
                            Selectize(selectHomeWork)
                        }
                    })
                    .catch(function (error) {
                        // PreloaderOFF()
                        console.log(error);
                    });
            }else{
                // $('#homeworkPanel').addClass('d-none')
            }
        }


        function GetSubmitHomeWork(){
            let classID = $('#selectClass').val();
            let sectionID = $('#sectionList').val();
            let subjectID = $('#selectSubject').val();
            let selectHomework = $('#selectHomeWork').val()
            if(classID != "" && sectionID != "" && subjectID != "" && selectHomework != ""){
                PreloaderON();
                axios.get(`/study-material/all-homework/${selectHomework}`)
                    .then(function (response) {
                        PreloaderOFF();
                        if(response.status === 200){
                            let data = response.data;

                            if(data.length > 0){
                                $('#homeworkPanel').removeClass('d-none');
                                $('#homeworkTable').empty();
                                data.forEach(function (item) {
                                    HomeWorkList(item);
                                })
                            }else{
                                $('#homeworkPanel').addClass('d-none');
                                Toast("Not found");
                            }
                        }
                        else{
                            alert("something went wrong");
                        }
                    })
                    .catch(function (error) {
                        PreloaderOFF();
                        console.log(error)
                    })
            }
        }


        //Delete Home Work
        $('#homeworkTable').on('click','.delete', function () {
            let id = $(this).attr('data-id');
            $('#deleteModal .btn-delete').attr('data-id', id);
        });

        //Delete Home Work
        $('#deleteModal').on('click', '.btn-delete', function () {
            PreloaderON();
            $('.btn-close').trigger('click');
            let id = $(this).attr('data-id');
            axios.get(`/study-material/all-homework/delete/${id}`)
            .then(function (response) {
                PreloaderOFF();
                // console.log(response);
                if(response.status === 200){
                    GetSubmitHomeWork();
                    Toast(response.data.message)
                }else{
                    Toast(response.data.message)
                }
            })
            .catch(function (error) {
                PreloaderOFF();
                Toast("Server Error")
                console.log(error);
            })
        });

        function CheckNull(e,value) {
            e.preventDefault();
            if(value != null){
                return value;
            }
            else{
                Toast(value + " Value.")
            }
        }

        $('#homeworkTable').on('click', '.content-link', function (e) {
            let isNull = $(this).attr('is-null');
            if(isNull == "null"){
                e.preventDefault();
                Toast("File is empty.");
            }
        })

        function HomeWorkList(item, index) {
            let dt = moment(item.created_at).format("YYYY-MM-DD");
            let list = $('#homeworkTable');
            let fileUrl = "{{env('API_FILE_URL')}}"+item.file;
            list.append(`
                 <tr>
                      <td scope="row">${(item.student_data != null) ? item.student_data.roll : "-"}</td>
                      <td>${(item.student_data != null) ? item.student_data.name : "-"}</td>
                      <td>
                        <a
                          is-null = "${item.file}"
                          href="${fileUrl}"
                          class="content-link"
                        >
                          ${item.homework_data.title}
                        </a>
                      </td>
                      <td>
                         ${item.note}
                      </td>
                      <td> ${item.homework_data.submission_date}</td>
                      <td>${dt}</td>
                      <td>
                        <div class="d-flex">
                          <div>
                            <button
                              type="button"
                              class="btn delete px-2"
                              data-bs-toggle="modal"
                              data-id="${item.id}"
                              data-bs-target="#deleteModal"
                            >
                              <i class="bi bi-trash text-danger"></i>
                            </button>
                          </div>
                        </div>
                      </td>
                   </tr>
            `);
        }
    </script>
@endsection
