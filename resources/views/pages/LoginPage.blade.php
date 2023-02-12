<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
            name="description"
            content="Admin dashboard for school management app"
    />
    <meta name="keywords" content="app, school" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard | School Management App</title>

    <!-- GOOGLE FONTS -->
    <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
            rel="stylesheet"
    />

    <!-- BOOTSTRAP ICONS -->
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css"
    />

    <!-- BOOTSTRAP CSS -->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
            crossorigin="anonymous"
    />
    <!-- Selectize CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
          integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    <!-- Include Bootstrap DateTimePicker CSS -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
            rel="stylesheet"
    />

    <!-- Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap5.min.css" />

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
    <!-- CALENDAR CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script> let fileUrl = "{{env("API_FILE_URL")}}";</script>
</head>

<body>
<section class="section-dashboard">
<!-- START MAIN DASHBOARD -->
    <section class="section-dashboard-main" style="width: 100vw;">


        <!-- START POPUP MESSAGE -->
        <div id="SectionArea">
            @if  (session('message'))
                <div class="p-5 position-absolute" style="right: 0;">
                    <div class="alert text-center alert-danger" role="alert">
                        🎉
                        <span>{{ session('message') }}</span>
                    </div>
                </div>
            @endif
        </div>
        <!-- END HEADER -->
        <section class="section-login p-5">
            <div class="section-login--left">
                <div class="logo">
                    <a href="login.html">
                        <img src="{{asset('assets/images/logo.png')}}" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="section-login--right">
                <form action="/login" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <h1>Admin Login</h1>
                    </div>
                    <div class="mb-5">
                        <input
                                name="phone"
                                type="text"
                                class="form-control u-box-shadow-1"
                                placeholder="Mobile"
                                required
                        />
                    </div>
                    <div class="mb-5">
                        <input
                                name="password"
                                type="password"
                                class="form-control u-box-shadow-1"
                                placeholder="Password"
                                required
                        />
                    </div>
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="" />
                            <label class="form-check-label" for=""> Remember me </label>
                        </div>
                        <button type="submit" class="btn btn-text">Login</button>
                    </div>
                </form>
            </div>
        </section>

        <!-- BOOTSTRAP JS -->
        <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
                crossorigin="anonymous"
        ></script>
    </section>
    <!-- END MAIN DASHBOARD -->
</section>
@include('layout.Footer')