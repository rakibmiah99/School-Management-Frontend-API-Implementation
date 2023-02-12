@extends('layout.App')
@section('MainContent')
    <!-- START COUNTS -->
    <section class="section-dashboard--counts">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-5 mx-5">
                        <div class="col-md-4 d-flex justify-content-around">
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                                <div class="card-body">
                                    <span> Students </span>
                                    <p>{{$count->student}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-around">
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="card-body">
                                    <span> Parents </span>
                                    <p>{{$count->parent}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-around">
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-person-rolodex"></i>
                                </div>
                                <div class="card-body">
                                    <span> Teachers </span>
                                    <p>{{$count->teacher}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END COUNTS -->

    <!-- START COUNTS -->
    <section class="section-dashboard--NAME">


        <div class="container">
            <div class="row">
                <div class="col-md-12 p-5">
                    <canvas id="myChart" height="80" width="130"></canvas>
                </div>
            </div>
        </div>
    </section>
    <!-- END COUNTS -->
@endsection


@section('scripts-before')
    <script src="{{asset('assets/js/filter.js')}}"></script>
    {{--<script src="{{asset('assets/js/chart.js')}}"></script>--}}
    <script>
        PreloaderON()
        axios.get('/charts')
        .then(function (response) {
            if(response.status === 200){
                let res = response.data;

                const data = {
                    labels: res.labels,
                    datasets: [
                        {
                            label: 'Income',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            data: res.incomes,
                        },
                        {
                            label: 'Expense',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 2,
                            data: res.expense,
                        },
                    ],
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {},
                };

                const myChart = new Chart(document.getElementById('myChart'), config);
                PreloaderOFF();

            }
        })

    </script>
@endsection

