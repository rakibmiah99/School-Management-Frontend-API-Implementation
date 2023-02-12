@extends('layout.App')
@section('MainContent')
    <!-- START SCHOOL SETTINGS HEADING -->
    <section class="section-addStudent--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">School Settings</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END SCHOOL SETTINGS HEADING -->

    <!-- START SCHOOL SETTINGS DETAILS -->
    <section class="section-addStudent--details u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title d-flex align-items-center">
                            <h3 class="heading--sub">School Settings</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/settings/create">
                                @csrf
                                <div class="row align-items-start ms-5 mb-3">
                                    <div class="offset-1 col-md-2">
                                        <label for="schoolName" class="col-form-label">School Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input name="name" type="text" value="{{$about->name}}" id="schoolName" class="form-control w-100" required="">
                                    </div>
                                </div>
                                <div class="row align-items-start ms-5 mb-3">
                                    <div class="offset-1 col-md-2">
                                        <label for="email" class="col-form-label">Email Address</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input name="email_1" type="email" id="email" value="{{$about->email_1}}" class="form-control w-100" required="">
                                    </div>
                                </div>
                                <div class="row align-items-start ms-5">
                                    <div class="offset-1 col-md-2">
                                        <label for="phoneNumber" class="col-form-label">Phone Number</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input name="phone_1" type="text" id="phoneNumber" value="{{$about->phone_1}}" class="form-control w-100" required="">
                                    </div>
                                </div>
                                <div class="row align-items-start ms-5 mt-5">
                                    <div class="offset-1 col-md-2">
                                        <label class="col-form-label">Address</label>
                                    </div>
                                    <div class="col-md-3 ms-3">
                                        <textarea name="address" id="address" cols="30" rows="5" required="">{{$about->address}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-text mt-4">Update Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- END SCHOOL SETTINGS DETAILS -->

@endsection
@section('scripts-before')

@endsection
@section('scripts-last')
    <!-- CUSTOM JS -->
    <script src="{{asset('assets/js/script.js')}}"></script>
@endsection
