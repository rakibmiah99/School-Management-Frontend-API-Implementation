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
    <title>{{$title}}</title>

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
    <script>
        let fileUrl = "{{env("API_FILE_URL")}}";
        const gender = ["", "Male", "Female", "Other\'s"];
        const no_data = "No data found";
    </script>
</head>

<body>

<!-- START PRELOADER -->
<div id="preloader" class="preloader d-none position-fixed" style="width: 100vw; height: 100vh;z-index: 999">
    <div class="book">
        <div class="inner">
            <div class="left"></div>
            <div class="middle"></div>
            <div class="right"></div>
        </div>
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>
<!-- END PRELOADER -->

<section class="section-dashboard">
    @include('layout.Sidebar')
    <!-- START MAIN DASHBOARD -->
        <section class="section-dashboard-main">


    <!-- END POPUP MESSAGE -->

            <!-- START HEADER -->
            <section class="section-dashboard--header">
                <div class="user-details">
                    <h1 class="user-name">Mizanur Rahman</h1>
                    <span class="user-role"> Admin </span>
                </div>
                <div class="notification">
                    <button type="button" class="btn notification-btn">
                        <div class="notification--icon">
                            <i class="bi bi-bell"></i>
                        </div>
                        <div class="notification--badge"></div>
                    </button>
                </div>

                <!-- START SHOW WHEN CLICKED ON NOTIFICATION -->
                <div
                    class="u-box-shadow-1 notification__sidebar d-none animate__animated animate__fadeInRightBig"
                >
                    <div class="notification--header">
                        <div class="notification--header-title">
                            <h5>Notification</h5>
                        </div>
                        <div class="notification--header-icons">
                            <div class="btn close-btn">
                                <i class="bi bi-x-lg"></i>
                            </div>
                        </div>
                    </div>
                    <div class="notification--body" id="notification-body"  style="max-height: 70vh; overflow: auto">

                        <div class="card">
                            <a class="card-footer" href="#">Mark all as read</a>
                        </div>
                    </div>
                </div>
                <!-- END SHOW WHEN CLICKED ON NOTIFICATION -->
            </section>
            <!-- START POPUP MESSAGE -->
            <div id="SectionArea">
                @if  (session('message'))
                    <div id="ToastPop" class="container">
                        <div class="row">
                            <div class="col-md-4 offset-8 pop-up-message--box me-0">
                                <div class="card">
                                    <div class="card-body">
                                        🎉
                                        <span>{{ session('message') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- END HEADER -->
            @yield('MainContent')
        </section>
    <!-- END MAIN DASHBOARD -->
</section>
@include('layout.Footer')
