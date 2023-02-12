@extends('layout.App')
@section('MainContent')
    <!-- START ASSIGN SUBJECT HEADING -->
    <section class="section-assignSubject--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Assign Subject</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END ASSIGN SUBJECT HEADING -->

    <div class="container">
        <div class="row u-padding-lg pt-0">
            <div class="col-md-4">
                <!-- START ASSIGN SUBJECT CONTENT -->
                <section class="section-assignSubject">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Assign Subject</h3>
                        </div>
                        <div class="card-body">
                            <form id="CreateForm" action="">
                                <select id="selectClass" required>
                                    <option value="">Select Class*</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>

                                <select id="selectSubject" multiple>
                                    <option value="">Select Subject*</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-center">
                                    <button class="btn btn-text mt-4">Assign</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- END ASSIGN SUBJECT CONTENT -->
            </div>

            <div class="col-md-8">
                <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
                <!-- START ASSIGN SUBJECT LIST-->
                <section class="section-assignSubject--list">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Assigned Subject List</h3>
                        </div>
                        <div
                            class="card-body table-scrollable"
                            style="overflow: auto; max-height: 68vh"
                        >
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class</th>
                                    <th>Subjects</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="TableBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- END ASSIGN SUBJECT LIST-->
            </div>
        </div>
    </div>

    <div
        class="modal fade"
        id="editContent"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <form id="UpdateForm" class="modal-content">
                <input type="hidden" id="update-data-id">
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
                    <div class="modal-body">
                        <select
                            id="uSelectClass"
                            required
                            placeholder="Select Class"
                        >
                            @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                        <select
                            id="uSelectSubject"
                            multiple
                            placeholder="Select Subjects"
                        >
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="submit"
                            class="btn btn-text px-4"
                            data-bs-dismiss="modal"
                        >
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
            <div class="modal-content" id="DeleteModal">
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
        let selectClass = $('#selectClass');
        let selectSection= $('#selectSection');
        let selectSubject= $('#selectSubject');
        let uSelectClass = $('#uSelectClass');
        let uSelectSection= $('#uSelectSection');
        let uSelectSubject= $('#uSelectSubject');
        let createForm = $('#CreateForm');
        let updateForm = $('#UpdateForm');
        let tableBody = $('#TableBody');




        Selectize(selectSection)
        Selectize(selectSubject)

        // Selectize(uSelectClass)
        Selectize(uSelectSubject)
        Selectize(uSelectSection)

        selectClass.selectize({
            onChange: function (value){
                selectSection.each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });

            }
        });

        uSelectClass.selectize({
            onChange: function (value){
                uSelectSection.each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });

            }
        });


        //Create Assign Subjects
        createForm.on('submit', function (e) {
            e.preventDefault();
            PreloaderON();
            let url = "/academics/assign-subject/save";
            let data = {
                class_id: selectClass.val(),
                section_id: selectSection.val(),
                subject_id : selectSubject.val()
            };
            axios.post(url, data)
            .then(function (response) {
                if(response.status === 200){
                    Get();
                }
            })
            .catch(function (error) {
                PreloaderOFF();
                let err = {...error};

                if(err.response.status === 403){
                    let response = err.response.data;
                    let subjects = "";
                    response.data.forEach(function (item) {
                        subjects += item.sub_name + " ";
                    });
                    alert(subjects + " " +response.message);
                }
            })
        })



        //Update Assign Subjects
        updateForm.on('submit', function (e) {
            e.preventDefault();
            PreloaderON();
            let id = $('#UpdateForm #update-data-id').val();
            let url = "/academics/assign-subject/update/"+id;
            let data = {
                class_id: uSelectClass.val(),
                section_id: uSelectSection.val(),
                subject_id : uSelectSubject.val()
            };
            axios.post(url, data)
                .then(function (response) {
                    if(response.status === 200){
                        Get();
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
        });

        Delete();
        function Delete() {
            $('#DeleteModal .btn-delete').on('click', function () {
                PreloaderON();
                let id = $(this).attr('data-id');
                let url = `/academics/assign-subject/delete/${id}`;
                $('#DeleteModal .btn-cancel').trigger('click');
                axios.get(url)
                .then(function (response) {
                    if(response.status === 200){
                        Get();
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
            })
        }

        SetDataToDeleteModal();
        function SetDataToDeleteModal() {
            tableBody.on('click', '.delete', function () {
                let id = $(this).attr('data-id');
                $('#DeleteModal .btn-delete').attr('data-id', id);
            })
        }


        SetDataToUpdateModal();
        function SetDataToUpdateModal(){
            tableBody.on('click', '.edit', function () {
                ModalLoaderON();
                let id = $(this).attr('data-id');
                $('#UpdateForm #update-data-id').val(id);
                let url = `/academics/assign-subject/get-single/${id}`;
                axios.get(url)
                .then(function (response_details) {
                    if(response_details.status === 200){
                        let class_id = response_details.data.class_id;
                        let subjects = response_details.data.subject_id;

                        let subjectIDArr = subjects.map(function (item) {
                            return item.subject_id;
                        });
                        console.log(subjectIDArr);
                        uSelectClass.data('selectize').setValue(class_id);
                        uSelectSubject.data('selectize').setValue(subjectIDArr);

                        axios.get(`/class-wise-section/${class_id}`)
                        .then(function (response) {
                            if(response.status === 200){
                                ModalLoaderOFF();
                                if(response.status == 200){
                                    uSelectSection.each(function() {
                                        if (this.selectize) {
                                            this.selectize.destroy();
                                        }
                                    });

                                    let data = response.data;
                                    uSelectSection.empty();
                                    uSelectSection.append(`
                                        <option class="dropdown-item" value="">Select Section</option>
                                    `);
                                    data.forEach(function (item){
                                        uSelectSection.append(`
                                            <option  value="${item.id}" class="dropdown-item">${item.name}</option>
                                        `);
                                    });
                                    Selectize(uSelectSection);
                                    uSelectSection.data('selectize').setValue(response_details.data.section_id);
                                }

                            }
                        })
                    }


                })
                .catch(function (error) {
                    console.log(error)
                })
            })
        }


        Get();
        function Get(){
            axios.get('/academics/assign-subject/get')
            .then(function (response) {
                PreloaderOFF();
                if(response.status === 200){
                    let data = response.data;
                    tableBody.empty();
                    data.forEach(function (item, index) {
                        let subjects = "";
                        item.subject_id.forEach(function (subjectItem) {
                            subjects += subjectItem.subject_name + ", ";
                        });

                        tableBody.append(`
                             <tr>
                                <td scope="row">${++index}</td>
                                <td>${(item.class_data != null) ? item.class_data.name : ""}</td>
                                <td>${subjects.substr(0, subjects.length-2)}</td>
                                <td>
                                    <div class="d-flex">
                                        <div>
                                            <button data-id="${item.id}" type="button" class="btn edit px-2">
                                                <i
                                                    class="bi bi-pencil-fill text-success me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editContent"
                                                ></i>
                                            </button>
                                        </div>
                                        <div>
                                            <button
                                                data-id="${item.id}"
                                                type="button"
                                                class="btn px-2 delete"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                            >
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        `);
                    })
                }
            })
            .catch(function (error) {
                console.log(error)
            })
        }

    </script>
@endsection
