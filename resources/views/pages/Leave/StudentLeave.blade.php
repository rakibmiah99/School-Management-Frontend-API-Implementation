@extends('layout.App')
@section('MainContent')
    <!-- START DEFINE EMPLOYEE LEAVE HEADING -->
    <section class="section-defineEmployeeLeave--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Define Student Leave</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END DEFINE EMPLOYEE LEAVE HEADING -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- START DEFINE EMPLOYEE LEAVE -->
                <section
                    class="section-defineEmployeeLeave u-padding-lg pt-0 pe-0"
                >
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Define Leave</h3>
                        </div>
                        <div class="card-body">
                            <form id="createForm" action="">
                                <select id="selectClass">
                                    <option value="">Select Class*</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                                <select id="sectionList">
                                    <option value="">Select Section*</option>

                                </select>
                                <select id="students">
                                    <option value="">Select Students*</option>

                                </select>
                                <div class="d-flex input-daterange ms-2 ps-1">
                                    <input
                                        id="fromDate"
                                        type="text"
                                        class="form-control border-0"
                                        placeholder="FROM DATE"
                                    />
                                </div>
                                <div class="d-flex input-daterange ms-2 ps-1">
                                    <input
                                        id="toDate"
                                        type="text"
                                        class="form-control border-0"
                                        placeholder="TO DATE"
                                    />
                                </div>

                                <input
                                    id="reason"
                                    type="text"
                                    class="form-control mx-3"
                                    name=""
                                    placeholder="Reason for Leave*"
                                    required
                                />
                                <input id="fileid" type="file" hidden />
                                <button
                                    type="button"
                                    id="buttonid"
                                    class="btn-addFile position-relative start-0 ms-3"
                                    role="button"
                                >
                                    <span class="text">Add File</span><span>Browse</span>
                                </button>
                                <p class="text-danger mt-2" id="file-upload-filename">
                                    (Only upload pdf or image files)
                                </p>
                                <div class="text-center">
                                    <button id="submit" type="submit" class="btn btn-text mt-4">Define</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- END DEFINE EMPLOYEE LEAVE -->
            </div>
            <div class="col-md-9 u-padding-lg pt-0">
                <!-- START EMPLOYEE LEAVE REQUEST LIST -->
                <div class="card">
                    <div class="card-title">
                        <h3 class="heading--sub">Student Leave Request List</h3>
                    </div>
                    <div
                        class="card-body table-scrollable"
                        style="overflow: auto; max-height: 68vh"
                    >
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>REASON</th>
                                <th>CLASS (SECTION)</th>
                                <th>STUDENT NAME</th>
                                <th>DATE</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody id="tableList">

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EMPLOYEE LEAVE REQUEST LIST -->
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog" role="document">
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
                    <div  class="modal-body">
                        <form id="updateForm" action="">
                            <input type="hidden" id="data-id">
                            <select id="selectClass">
                                <option value="">Select Class*</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                            <select id="sectionList">
                                <option value="">Select Section*</option>

                            </select>
                            <select id="students">
                                <option value="">Select Students*</option>

                            </select>
                            <div class="d-flex input-daterange ms-2 ps-1">
                                <input
                                    id="fromDate"
                                    type="text"
                                    class="form-control border-0"
                                    placeholder="FROM DATE"
                                />
                            </div>
                            <div class="d-flex input-daterange ms-2 ps-1">
                                <input
                                    id="toDate"
                                    type="text"
                                    class="form-control border-0"
                                    placeholder="TO DATE"
                                />
                            </div>

                            <input
                                id="reason"
                                type="text"
                                class="form-control mx-3"
                                name=""
                                placeholder="Reason for Leave*"
                                required
                            />
                            <input
                                id="fileid2"
                                type="file"
                                hidden
                            />
                            <button
                                type="button"
                                id="buttonid2"
                                class="btn-addFile position-relative start-0 ms-3"
                                role="button"
                            >
                                  <span class="text">Add File</span
                                  ><span>Browse</span>
                            </button>
                            <p
                                class="text-danger mt-2"
                                id="file-upload-filename2"
                            >
                                (Only upload pdf or image files)
                            </p>

                            <div class="modal-footer">
                                <button
                                    type="submit"
                                    class="btn btn-text py-1 px-4"
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
        let selectedSection = 0;
        let defaultSectionID = null;
        let createForm = $("#createForm");
        let updateForm = $("#updateForm");
        table = $('#tableList');

        Selectize($('#createForm #sectionList'));
        Selectize($('#createForm #students'));
        Selectize($('#updateForm #sectionList'));
        Selectize($('#updateForm #students'));
        // Selectize($('#updateForm #selectClass'));


        $('#createForm #selectClass').selectize({
            onChange: function (value){
                $('#createForm #sectionList').each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });
                axios.get('/class-wise-section/'+value)
                    .then(function(response){
                        if(response.status == 200){
                            let data = response.data;
                            let sectionList = $('#createForm #sectionList');
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



        $('#createForm #sectionList').on('change', function () {

                let section = $(this).val();
                let class_id = $('#createForm #selectClass').val();

                axios.get(`/class-and-section-wise-section/${class_id}/${section}`)
                    .then(function (response) {
                        if(response.status === 200){
                            let data = response.data;
                            let students = $('#createForm #students');
                            students.each(function () {
                                if (this.selectize) {
                                    this.selectize.destroy();
                                }
                            });
                            students.empty();
                            students.append(`
                                <option class="dropdown-item" value="">Select Students</option>
                            `);
                            data.forEach(function (item){
                                students.append(`
                                <option value="${item.id}" class="dropdown-item">${item.name}</option>
                            `);
                            });
                            Selectize(students)
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    })

        });



        $('#updateForm').on('change', '#sectionList', function () {
            let section = $(this).val();
            let class_id = $('#updateForm #selectClass').val();
            selectedSection += 1 ;
            if(selectedSection != 1) {
                defaultSectionID = null;
                axios.get(`/class-and-section-wise-section/${class_id}/${section}`)
                    .then(function (response) {
                        if(response.status === 200){
                            let data = response.data;
                            let students = $('#updateForm #students');
                            students.each(function () {
                                if (this.selectize) {
                                    this.selectize.destroy();
                                }
                            });
                            students.empty();
                            students.append(`
                                <option class="dropdown-item" value="">Select Students</option>
                            `);
                            data.forEach(function (item){
                                students.append(`
                            <option value="${item.id}" class="dropdown-item">${item.name}</option>
                        `);
                            });
                            Selectize(students);
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            }
        });

        $('#updateForm #selectClass').selectize({
            onChange: function (value){
                $('#updateForm #sectionList').each(function() {
                    if (this.selectize) {
                        this.selectize.destroy();
                    }
                });
                axios.get('/class-wise-section/'+value)
                    .then(function(response){
                        if(response.status == 200){
                            let data = response.data;
                            let sectionList = $('#updateForm #sectionList');
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

        function convertDate(dte){
            let d = dte.split('/');
            return d[2] + "-"+ d[1] + "-" + d[0]
        }

        /** Create Employee Leave */
        createForm.on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let class_id = $('#createForm #selectClass');
            let section_id = $('#createForm #sectionList');
            let student_id = $('#createForm #students');
            let toDate = $('#createForm #toDate');
            let fromDate = $('#createForm #fromDate');
            let reason = $('#createForm #reason');
            let file = document.querySelector('#fileid').files[0];

            let formData = new FormData();
            formData.append('class_id', class_id.val());
            formData.append('section_id', section_id.val());
            formData.append('student_id', student_id.val());
            formData.append('from_date', convertDate(fromDate.val()));
            formData.append('to_date', convertDate(toDate.val()));
            formData.append('reason', reason.val());
            if(file != undefined){
                formData.append('file', file);
            }

            let url = "/leave/student/save";
            axios.post(url, formData)
            .then(function (response) {
                if(response.status === 200  && response.data.status == true){
                    Toast(response.data.message);
                    $('#file-upload-filename').empty();
                    $('#fileid').val("");
                    Get();
                }else{
                    Toast("Created Failed");
                    PreloaderOFF();
                }
            })
            .catch(function (error) {
                console.log(error)
                PreloaderOFF();
                Toast("Server Error")
            })
        });

        /** Update Employee Leave **/
        updateForm.on('submit', function (e) {
            PreloaderON();
            e.preventDefault();
            let class_id = $('#updateForm #selectClass');
            let section_id = $('#updateForm #sectionList');
            let student_id = $('#updateForm #students');
            let toDate = $('#updateForm #toDate');
            let fromDate = $('#updateForm #fromDate');
            let reason = $('#updateForm #reason');
            let file = document.querySelector('#fileid2').files[0];
            let id = $('#updateForm #data-id').val();
            let formData = new FormData();



            formData.append('class_id', class_id.val());

            if(defaultSectionID == null){
                formData.append('section_id', section_id.val());
            }else{
                formData.append('section_id', defaultSectionID);
            }

            formData.append('student_id', student_id.val());
            formData.append('from_date', convertDate(fromDate.val()));
            formData.append('to_date', convertDate(toDate.val()));
            formData.append('reason', reason.val());
            if(file != undefined){
                formData.append('file', file);
            }

            let url = `/leave/student/update/${id}`;
            axios.post(url, formData)
                .then(function (response) {
                    if(response.status === 200  && response.data.status == true){
                        Toast(response.data.message);
                        $('#file-upload-filename2').empty();
                        Get();
                    }else{
                        Toast("Updated Failed");
                        PreloaderOFF()
                    }
                })
                .catch(function (error) {
                    console.log(error)
                    PreloaderOFF();
                    Toast("Server Error")
                })
        });

        /** Set Data to Delete Modal */
        table.on('click', '.deleteBtn', function () {
            let id = $(this).attr('data-id');
            $('#deleteModal .btn-delete').attr('data-id', id);
        });

        /** Delete Data **/
        $('#deleteModal').on('click', '.btn-delete', function () {
            $('#deleteModal .btn-cancel').trigger('click');
            PreloaderON();
            let id = $(this).attr('data-id');
            let url = `/leave/student/delete/${id}`;
            axios.get(url)
                .then(function (response) {
                    if(response.status === 200){
                        Get();
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                    console.log(error)
                })
        });

        /** Set Data to Edit Modal */
        table.on('click', '.editBtn', function () {
            ModalLoaderON();
            let id = $(this).attr('data-id');
            let url = `/leave/student/get-single/`+id;
            axios.get(url)
                .then(function (response) {
                    if(response.status === 200){

                        let all_data = response.data;

                        function convertDate(dte){
                            let d = dte.split('-');
                            return d[2] + '/' + d[1] + "/" + d[0];
                        }

                        /**Get Class Wise Section and set Selected */
                        axios.get('/class-wise-section/'+all_data.class_data.id)
                        .then(function(response){
                        if(response.status == 200){
                            let section_data = response.data;
                            $('#updateForm #sectionList').each(function() {
                                if (this.selectize) {
                                    this.selectize.destroy();
                                }
                            });
                            let sectionList = $('#updateForm #sectionList');
                            sectionList.empty();
                            sectionList.append(`
                                <option class="dropdown-item" value="">Select Section</option>
                            `);
                            selectedSection = 0;
                            section_data.forEach(function (item){
                                sectionList.append(`
                                    <option value="${item.id}" class="dropdown-item">${item.name}</option>
                                `);
                            });
                            Selectize(sectionList);
                            sectionList.data('selectize').setValue(all_data.section_data.id);
                            defaultSectionID = all_data.section_data.id;
                        }
                    });

                        /** Get Class And Section Wise Student And Set Selected */
                        axios.get(`/class-and-section-wise-section/${all_data.class_data.id}/${all_data.section_data.id}`)
                            .then(function (response) {
                                ModalLoaderOFF();
                                if(response.status === 200){
                                    let data = response.data;
                                    let students = $('#updateForm #students');
                                    students.each(function () {
                                        if (this.selectize) {
                                            this.selectize.destroy();
                                        }
                                    });
                                    students.empty();
                                    students.append(`
                                        <option class="dropdown-item" value="">Select Students</option>
                                    `);
                                    data.forEach(function (item){
                                        students.append(`
                                            <option value="${item.id}" class="dropdown-item">${item.name}</option>
                                        `);
                                    });
                                    Selectize(students)
                                    students.data('selectize').setValue(all_data.student_data.id);
                                }
                            })
                            .catch(function (error) {
                                console.log(error)
                            });


                        $('#updateForm #selectClass').data('selectize').setValue(all_data.class_data.id);


                        $('#updateForm #data-id').val(all_data.id);

                        $('#updateForm #toDate').val(convertDate(all_data.to_date));
                        $('#updateForm #fromDate').val(convertDate(all_data.from_date))
                        $('#updateForm #reason').val(all_data.reason);

                    }
                })
                .catch(function (error) {
                    console.log(error)
                })
        });


        Get();
        function Get() {
            axios.get('/leave/student/get')
                .then(function (response) {
                    PreloaderOFF();
                    if(response.status === 200){
                        let data = response.data;
                        table.empty();
                        data.forEach(function (item, index) {
                            Item(item, index);
                        })
                    }
                })
                .catch(function (error) {
                    PreloaderOFF();
                })
        }

        function Item(item, index) {
            table.append(`
                  <tr>
                        <td scope="row">${index+1}</td>
                        <td>
                            <a  href="${(item.file == null ? "null" : fileUrl+item.file)}"  class="content-link download-link"> ${item.reason} </a>
                        </td>
                        <td>${(item.class_data != null && item.section_data != null) ? item.class_data.name + "("+ item.section_data.name + ")" : ""}</td>
                        <td>${(item.student_data != null ) ? item.student_data.name  : ""}</td>
                        <td>${item.from_date} to ${item.to_date}</td>
                        <td>
                            <div class="d-flex">
                                <div>

                                    <button
                                        data-id="${item.id}"
                                        class="btn px-2 editBtn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal"
                                        >
                                        <i
                                        class="bi bi-pencil-fill text-success me-2"
                                        ></i>
                                    </button>
                                    </div>
                                    <div>
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
                            </div>
                        </td>
                    </tr>
            `)
        }

        DownloadToast(table)
    </script>
@endsection
