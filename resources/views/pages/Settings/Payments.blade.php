@extends('layout.App')
@section('MainContent')
    <!-- START PAYMENT SETTINGS HEADING -->
    <section class="section-paymentSettings--heading u-padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading--main">Payment Settings</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END PAYMENT SETTINGS HEADING -->

    <!-- START PAYMENT SETTINGS DETAILS -->
    <section class="section-paymentSettings--details u-padding-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-title d-flex align-items-center">
                            <h3 class="heading--sub">Bkash Settings</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row align-items-start ms-5">
                                    <div class="offset-1 col-md-2">
                                        <label for="phoneNumber" class="col-form-label">Active</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="selectDropdown">
                                            <option value="1" class="dropdown-item">Yes</option>
                                            <option value="2" class="dropdown-item">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row align-items-start ms-5">
                                    <div class="offset-1 col-md-2">
                                        <label for="phoneNumber" class="col-form-label">Phone Number</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="phoneNumber" class="form-control w-100">
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12 mt-5">
                                <div class="text-center">
                                    <button class="btn btn-text mt-4">Update Bkash Settings</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- END PAYMENT SETTINGS DETAILS -->

@endsection
@section('scripts-before')

@endsection
@section('scripts-last')
    <!-- CUSTOM JS -->
    <script src="{{asset('assets/js/filter.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script>
        Selectize($('#selectDropdown'))
    </script>
@endsection
