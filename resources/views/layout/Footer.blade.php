    <!-- Axios -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"
        integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"
    ></script>

    <!-- Jquery -->
     <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
     </script>
        {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}

    <!-- BOOTSTRAP JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"
    ></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        $(document).ready(function () {
            let notificationBody = $('#notification-body');
            axios.get('/get-notifications')
                .then(function (response) {
                    console.log(response);
                    if(response.status === 200 && response.data != null){
                        let total = response.data.total;
                        let notifications = response.data.data;
                        notificationBody.empty();
                        if(total > 0){
                            notifications.forEach(function (item) {Notification(item);})
                            notificationBody.append(`
                                <div class="card">
                                    <a id="ReadAllBtn" class="card-footer" href="#">Mark as read!</a>
                                </div>
                            `);

                        }
                        else{
                            // console.log('heere')
                            notificationBody.append(`
                                <div class="card">
                                    <a class="card-footer" href="#">No notification found here!</a>
                                </div>
                            `);
                        }

                    }
                })
                .catch(function (error) {

                });


            notificationBody.on('click', '#ReadAllBtn', function (e) {
                e.preventDefault();
                axios.get('/read-notifications')
                .then(function (response) {
                    if(response.status == 200 && response.data.status == true){
                        notificationBody.empty();
                        notificationBody.append(`
                            <div class="card">
                                <a class="card-footer" href="#">No notification found here!</a>
                            </div>
                        `);
                    }
                })
                .catch(function (error) {

                })
            });



            function Notification(item) {
                notificationBody.append(`
                    <a class="card" href="#">
                        <div class="card-body">
                            <div class="notification-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="notification-box">
                                <div class="notification-text">
                                    ${item.title}
                                </div>
                                <div class="notification-time">
                                    <span> ${moment(item.created_at).format("Do MMM YYYY")} </span>
                                </div>
                            </div>
                        </div>
                    </a>
                `)
            }
        });
    </script>

    @yield('scripts-before')
    <script src="{{asset('/assets/js/script.js')}}"></script>
    <script>
        $('#logoutBtn').on('click',function (e){
            e.preventDefault();
            axios.get('/api/admin/logout')
            .then(function (response){
                if (response.status === 200 && response.data.status == true){
                    window.location.reload();
                }
            })
            .catch(function (error){
                console.log(error)
            });
        });
    </script>
    @yield('scripts-last')
</body>
</html>
