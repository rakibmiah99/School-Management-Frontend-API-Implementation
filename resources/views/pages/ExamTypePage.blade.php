@extends('layout.App')
@section('MainContent')

    <!-- START EXAM TYPE HEADING -->
    <section class="section-examType--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Exam Type</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END EXAM TYPE HEADING -->

    <!-- START EXAM TYPE CONTENT -->
    <section class="section-examType--content u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Add Exam Type</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <input
                                    id="type"
                                    type="text"
                                    class="form-control"
                                    placeholder="EXAM NAME*"
                                    required
                                />
                                <button id="saveTypeBtn" class="btn btn-text">✔ SAVE EXAM TYPE</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-title">
                            <h3 class="heading--sub">Exam Type List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>EXAM NAME</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody id="listOfExamType">
                                <!--Exam Type List -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
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
                <div class="modal-body">
                    <input
                        id="examTypeInput"
                        type="text"
                        class="form-control"
                        placeholder="EXAM NAME*"
                        value="First Term"
                        required
                    />
                </div>
                <div class="modal-footer">
                    <button
                        id="updateBtn"
                        type="button"
                        class="btn btn-text py-1 px-4"
                    >
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END EXAM TYPE CONTENT -->
@endsection

@section('scripts-before')
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"
    ></script>

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CUSTOM JS -->
    <script src="{{asset("assets/js/chart.js")}}"></script>
@endsection
@section('scripts-last')
    <script>
        
        //Get All Exam Types
        ExamTypeList();

        //Add Exam Type
        $('#saveTypeBtn').on('click', function (){
            let type = $('#type');
            axios.post('/api/exam-type/Create', {
                type: type.val()
            })
                .then(function(response){
                    if(response.status === 200 && response.data.status == true){
                        // alert('success')
                        type.val("");
                        ExamTypeList();
                    }
                })
                .catch(function(error){
                    console.log(error)
                });

        })


        //Set Data To Modal
        $('#listOfExamType').on('click', '.openModalBtn', function () {
            let examTypeID = $(this).attr('exam-id');
            axios.get('/api/exam-type/GetSingExamType/' + examTypeID)
                .then(function (response){
                    if(response.status === 200){
                        $('#examTypeInput').val(response.data.type)
                        $('#updateBtn').attr('type-id', examTypeID);
                    }
                })
                .catch(function (error){
                    console.log(error);
                })
        });



        //Update Exam Type
        $('#editModal').on('click', '#updateBtn', function (){
            let id = $(this).attr('type-id');
            let data = $('#examTypeInput').val();

            axios.post('/api/exam-type/Update', {
                id: id,
                type: data
            })
                .then(function (response){
                    if(response.status === 200 && response.data.status == true){
                        // alert(response.data.message)
                        ExamTypeList();
                        $('.btn-close').trigger('click');
                    }else{
                        alert(response.data.message)
                    }
                })
                .catch(function(error){
                    console.log(error)
                })
        })

        //Delete Exam Type
        $('#listOfExamType').on('click', '.deleteBtn', function (){
            let examTypeID = $(this).attr('exam-id');
            axios.get('/api/exam-type/Delete/'+examTypeID)
                .then(function (response){
                    if(response.status === 200 && response.data.status == true){
                        // alert(response.data.message)
                        ExamTypeList();
                    }else{
                        alert(response.data.message)
                    }
                })
                .catch(function (error){
                    console.log(error)
                })
        })
        function ExamTypeList(){
            axios.get('/api/exam-type/List')
                .then(function (response){
                    if(response.status === 200){
                        let data = response.data;
                        let list = $('#listOfExamType');
                        list.empty();
                        data.forEach(function (item,index){
                            List(list, item, index)
                        })
                    }
                })
                .catch(function(error){
                    console.log(error)
                });
            function List(selector, item, index){
                /*template*/
                selector.append(`
                <tr>
                    <td scope="row">${index+1}</td>
                    <td>${item.type}</td>
                    <td>

                        <button
                            class="btn openModalBtn btn-text px-4 py-2 bg-green"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal"
                            exam-id = ${item.id}
                        >
                            edit
                        </button>
                        <button exam-id="${item.id}" class="btn deleteBtn btn-text px-4 py-2 bg-red">
                            delete
                        </button>
                    </td>
                </tr>
            `)
            }
        }
    </script>
@endsection


