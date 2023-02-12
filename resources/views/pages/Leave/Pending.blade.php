@extends('layout.App')
@section('MainContent')

<!-- START PENDING LEAVE HEADING -->
<section class="section-uploadContent--heading u-padding-lg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading--main">Pending Leave Request</h2>
            </div>
        </div>
    </div>
</section>
<!-- END PENDING LEAVE HEADING -->

<!-- START PENDING LEAVE CRITERIA -->
<section class="section-pendingLeave--criteria section-criteria u-padding-lg pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-title">
                        <h3 class="heading--sub">Select Criteria</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            <select id="selectCriteria" class="select-criteria">
                                <option class="dropdown-item" value="">Select Role</option>
                                <option value="1" class="dropdown-item">Student</option>
                                <option value="2" class="dropdown-item">Employee</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END PENDING LEAVE CRITERIA -->

<div class="container">
    <div class="row u-padding-lg pt-0">
        <div class="col-md-12">
            <!-- SHOW THIS SECTION AFTER ABOVE DROPDOWNS HAS BEEN SELECTED -->
            <!-- START PENDING LEAVE LIST-->
            <section class="section-pendingLeave--list">
                <div class="card">
                    <div class="card-title d-flex justify-content-between me-5">
                        <h3 class="heading--sub">Pending Leave Request List</h3>
                    </div>
                    <div class="card-body table-scrollable" style="overflow: auto; max-height: 51vh">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Leave type</th>
                                <th>Reason</th>
                                <th>Name</th>
                                <th id="ClassSection">Class(Section)</th>
                                <th>Date</th>
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
        Selectize($('.select-criteria'));
        let table = $('#contentTable');
        $('#selectCriteria').on('change', function () {
            PreloaderON();
            let criteria = $(this).val();
            if(criteria != ""){
                let url = `/leave/get/${criteria}`;
                axios.get(url)
                .then(function (response) {
                    console.log(response);
                    if(response.status === 200){
                        PreloaderOFF();
                        table.empty();
                        let data = response.data;

                        if(criteria == "1"){
                            $('#ClassSection').removeClass('d-none');
                            data.forEach(function (item, index) {
                                StudentItem(item, index);
                            });
                        }
                        else if(criteria == "2"){
                            $('#ClassSection').addClass('d-none');
                            data.forEach(function (item, index) {
                                EmployeeItem(item, index);
                            })
                        }

                    }
                })
                .catch(function () {

                })
            }
        });

        function StudentItem(item, index) {
            table.append(`
                <tr>
                    <td scope="row">${index+1}</td>
                    <td>${item.leave_type.name}</td>
                    <td>
                        <a href="${(item.file == null ? "null" : fileUrl+item.file)}"  class="content-link download-link">
                            ${item.reason}
                        </a>
                    </td>
                    <td>${item.student_data.name}</td>
                    <td>${(item.class_data != null ? item.class_data.name : "") + "("+(item.section_data != null ? item.section_data.name : "")+")"}</td>
                    <td>${item.apply_date} to ${item.to_date}</td>
                    <td>
                        <button data-id="${item.id}"  class="btn-approve" role="button">Approve</button>
                        <button class="btn btn-sm d-none btn-success p-1" type="button" disabled>
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr>
            `)
        }

        function EmployeeItem(item, index) {
            table.append(`
                <tr>
                    <td scope="row">${index+1}</td>
                    <td>${(item.leave_type != null) ? item.leave_type.name : ""}</td>
                    <td>
                        <a  href="${(item.file == null ? "null" : fileUrl+item.file)}"  class="content-link download-link">
                            ${item.reason}
                        </a>
                    </td>
                    <td>${(item.employee != null) ? item.employee.name : "" }</td>
                    <td>${item.apply_date} to ${item.to_date}</td>
                    <td>
                        <button data-id="${item.id}" class="btn-approve" role="button">Approve</button>
                        <button class="btn d-none btn-sm btn-success p-1" type="button" disabled>
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr>
            `);
        }


        table.on('click', '.btn-approve', function () {
            let id  = $(this).attr('data-id');
            let criteria = $('#selectCriteria').val();
            let t = $(this)
            let n = $(this).next();
            t.addClass('d-none');
            n.removeClass('d-none');

            axios.get(`/leave/approve/${criteria}/${id}`)
            .then(function (response) {
                t.removeClass('d-none');
                n.addClass('d-none');
                if(response.status === 200 && response.data.status == true){
                    Toast("Approved")
                    t.parent().parent().remove();
                }
            })
            .catch(function (error) {
                Toast("Error: Server! Something Went Gone.")
                PreloaderOFF();
            })
        })

        DownloadToast(table);

    </script>
@endsection
