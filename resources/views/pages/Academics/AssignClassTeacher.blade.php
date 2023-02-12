@extends('layout.App')
@section('MainContent')
    <!-- START ASSIGN SECTION HEADING -->
    <section class="section-assignSection--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Assign Class Teacher</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END ASSIGN SECTION HEADING -->

    <div class="container">
        <div class="row u-padding-lg pt-0">
            <div class="col-md-4">
                <!-- START ASSIGN SECTION CONTENT -->
                <section class="section-assignSection">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Assign Class Teacher</h3>
                        </div>
                        <div class="card-body">
                            <form id="CreateForm" action="">
                                <select id="selectClass" required>
                                    <option value="">Select Class*</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                                <select required id="selectSection" style="visibility: hidden;" >
                                    <option value="">Select Section*</option>
                                </select>
                                <select required id="selectTeacher" style="visibility: hidden;" >
                                    <option value="">Select Teacher*</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-text mt-4">Assign</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- END ASSIGN SECTION CONTENT -->
            </div>

            <div class="col-md-8">
                <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
                <!-- START ASSIGN SECTION LIST-->
                <section class="section-assignSection--list">
                    <div class="card">
                        <div class="card-title d-flex justify-content-between me-5">
                            <h3 class="heading--sub">Assigned Class Teacher List</h3>
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
                                    <th>Sections</th>
                                    <th>Class Teacher</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="TableList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- END ASSIGN SECTION LIST-->
            </div>
        </div>
    </div>


    {{--    EDIT MODAL--}}
    <div
        class="modal fade"
        id="editContent"
        aria-hidden="true"
    >
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
                <div id="ModalBody" class="modal-body">
                    <form id="UpdateForm" action="">
                        <input type="hidden" id="data-id" >
                        <select id="selectClass" required>
                            <option value="">Select Class*</option>
                            @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                        <select required id="selectSection" style="visibility: hidden;">
                            <option value="">Select Section*</option>
                        </select>
                        <select required id="selectTeacher" style="visibility: hidden;" >
                            <option value="">Select Teacher*</option>
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                            @endforeach
                        </select>
                        <div class="modal-footer">
                            <button
                                type="submit"
                                class="btn btn-text px-4"
                                data-bs-dismiss="modal"
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    DELETE MODAL--}}
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
@section('scripts-last')
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <!-- Selectize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    <!--Calendar JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- CUSTOM JS -->
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
        let table = $('#TableList');
        let createForm = $('#CreateForm');
        let updateForm = $('#UpdateForm');

        sectionListElem = $('#CreateForm #selectSection');
        selectClassElem = $('#CreateForm #selectClass');
        uSectionListElem = $('#UpdateForm #selectSection');
        uSelectClassElem = $('#UpdateForm #selectClass');
        Selectize(sectionListElem);
        Selectize($('#CreateForm #selectTeacher'));
        Selectize($('#UpdateForm #selectTeacher'));
        Selectize(uSectionListElem);

        selectClassElem.selectize({
            onChange: function (value){
                sectionListElem.each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });
                axios.get('/class-wise-section/'+value)
                    .then(function(response){
                        if(response.status == 200){
                            let data = response.data;
                            sectionListElem.empty();
                            sectionListElem.append(`
                                <option class="dropdown-item" value="">Select Section</option>
                            `);
                            data.forEach(function (item){
                                sectionListElem.append(`
                                    <option value="${item.id}" class="dropdown-item">${item.name}</option>
                                `);
                            });
                            Selectize(sectionListElem)
                        }
                    })
                    .catch(function (error){
                        console.log(error)
                    });
            }
        });
        uSelectClassElem.selectize({
            onChange: function (value){
                uSectionListElem.each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });
                axios.get('/class-wise-section/'+value)
                    .then(function(response){
                        if(response.status == 200){
                            let data = response.data;
                            uSectionListElem.empty();
                            uSectionListElem.append(`
                                <option class="dropdown-item" value="">Select Section</option>
                            `);
                            data.forEach(function (item){
                                uSectionListElem.append(`
                                    <option value="${item.id}" class="dropdown-item">${item.name}</option>
                                `);
                            });
                            Selectize(uSectionListElem)
                        }
                    })
                    .catch(function (error){
                        console.log(error)
                    });
            }
        });

        //Create
        createForm.on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let selectClass = $('#CreateForm #selectClass');
            let selectSection = $('#CreateForm #selectSection');
            let selectTeacher = $('#CreateForm #selectTeacher');
            let url = "/academics/assign-teacher/add";
            let data = {
                class_id: selectClass.val(),
                section_id: selectSection.val(),
                teacher_id: selectTeacher.val(),
            };
            axios.post(url, data)
                .then(function (response) {
                    // PreloaderOFF();
                    if(response.status === 200 && response.data.status == true){
                        GetAll();
                        Toast(response.data.message);
                        PreloaderOFF();

                    }else{
                        PreloaderOFF();
                        Toast(response.data.message)
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                    Toast("Error: Server!!");
                })
        });

        //Update
        updateForm.on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let id = $('#UpdateForm #data-id').val();
            let selectClass = $('#UpdateForm #selectClass');
            let selectSection = $('#UpdateForm #selectSection');
            let selectTeacher = $('#UpdateForm #selectTeacher');
            let url = `/academics/assign-teacher/update/${id}`;
            let data = {
                class_id: selectClass.val(),
                section_id: selectSection.val(),
                teacher_id: selectTeacher.val(),
            };
            axios.post(url, data)
                .then(function (response) {
                    if(response.status === 200 && response.data.status == true){
                        GetAll();
                        Toast(response.data.message);
                        PreloaderOFF();
                    }else{
                        PreloaderOFF();
                        Toast(response.data.message)
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                    Toast("Error: Server!!");
                })
        });


        //Set Data To Delete Modal
        table.on('click', '.delete', function () {
            let id = $(this).attr('data-id');
            $('#deleteModal .btn-delete').attr('data-id', id);
        });

        //Finally Delete
        $('#deleteModal').on('click','.btn-delete', function () {
            PreloaderON();
            $('#deleteModal .btn-cancel').trigger('click');
            let id = $(this).attr('data-id');
            let url = `/academics/assign-teacher/delete/${id}`;
            axios.get(url)
            .then(function (response) {
                if(response.status === 200 && response.data.status == true){
                    GetAll();
                    Toast(response.data.message);
                    PreloaderOFF();
                }else{

                    Toast(response.data.message);
                }
            })
            .catch(function (error) {
                PreloaderOFF();
                console.log(error);
                Toast("Error: Server!!");
            });
        });

        //Get To Edit Modal
        table.on('click', '.edit', function () {
            ModalLoaderON();
            let id = $(this).attr('data-id');
            $('#UpdateForm #data-id').val(id);
            axios.get(`/academics/assign-teacher/get-single/${id}`)
                .then(function (assign_section_response) {
                    if(assign_section_response.status === 200){
                        $('#UpdateForm #selectClass').data('selectize').setValue(assign_section_response.data.class_data.id);
                        $('#UpdateForm #selectTeacher').data('selectize').setValue(assign_section_response.data.teacher.id);
                        let classID = assign_section_response.data.class_data.id;

                        axios.get('/class-wise-section/'+classID)
                            .then(function(response){
                                if(response.status == 200){

                                    uSectionListElem.each(function() {
                                        if (this.selectize) {
                                            this.selectize.destroy();
                                        }
                                    });

                                    let data = response.data;
                                    uSectionListElem.empty();
                                    uSectionListElem.append(`
                                        <option class="dropdown-item" value="">Select Section</option>
                                    `);
                                    data.forEach(function (item){
                                        uSectionListElem.append(`
                                            <option value="${item.id}" class="dropdown-item">${item.name}</option>
                                        `);
                                    });
                                    Selectize(uSectionListElem);

                                    uSectionListElem.data('selectize').setValue(assign_section_response.data.section_data.id);
                                    ModalLoaderOFF();
                                }
                            })
                            .catch(function (error){
                                console.log(error)
                            });
                    }
                })
                .catch(function (error) {

                })
        });

        GetAll();
        function GetAll() {
            axios.get('/academics/assign-teacher/get-all')
                .then(function (response) {
                    PreloaderOFF();
                    if(response.status === 200){
                        table.empty();
                        let data = response.data;
                        data.forEach(function (item,index) {
                            Item(table, item, index);
                        })
                    }
                })
                .catch(function (error) {
                    console.log(error)
                })
        }

        function Item(table,item, index){
            table.append(`
                   <tr>
                        <td scope="row">${++index}</td>
                        <td>${(item.class_data != null) ? item.class_data.name : "" }</td>
                        <td>${(item.section_data != null) ? item.section_data.name : ""}</td>
                        <td>${(item.teacher != null) ? item.teacher.name : ""}</td>
                        <td>
                            <div class="d-flex">
                                <div>
                                    <button data-id="${item.id}"  type="button" class="btn edit px-2">
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
                                        class="btn delete px-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                    >
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
            `)
        }
    </script>
@endsection
