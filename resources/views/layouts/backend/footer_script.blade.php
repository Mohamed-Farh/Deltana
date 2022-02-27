    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>

    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>

    <script src="{{ asset('backend/vendor/summernote/summernote-bs4.min.js') }}"></script>

{{-- <script>
    $(document).ready(function () {
        new getContactMessagesNotifications();
        setInterval(getContactMessagesNotifications, 15000);

    });

    function getContactMessagesNotifications(){
        $.ajax({
            type: "GET",
            url: "/admin/get-contact-messages-notifications",
            success: function (response) {
                let p = document.getElementById('contactMessages');
                p.innerHTML=response;
                if( response > 0 ){
                    p.removeAttribute("hidden");
                }else{
                    p.setAttribute("hidden");
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        new getCareersNotifications();
        setInterval(getCareersNotifications, 15000);

    });

    function getCareersNotifications(){
        $.ajax({
            type: "GET",
            url: "/admin/get-careers-notifications",
            success: function (response) {
                let p = document.getElementById('careers');
                p.innerHTML=response;
                if( response > 0 ){
                    p.removeAttribute("hidden");
                }else{
                    p.setAttribute("hidden");
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        new getHomeNotifications();
        setInterval(getHomeNotifications, 15000);

    });

    function getHomeNotifications(){
        $.ajax({
            type: "GET",
            url: "/admin/get-home-messages-notifications",
            success: function (response) {
                let p = document.getElementById('home');
                p.innerHTML=response;
                if( response > 0 ){
                    p.removeAttribute("hidden");
                }else{
                    p.setAttribute("hidden");
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        new getKayanNotifications();
        setInterval(getKayanNotifications, 15000);

    });

    function getKayanNotifications(){
        $.ajax({
            type: "GET",
            url: "/admin/kayan/get-kayan-messages-notifications",
            success: function (response) {
                let p = document.getElementById('kayan');
                p.innerHTML=response;
                if( response > 0 ){
                    p.removeAttribute("hidden");
                }else{
                    p.setAttribute("hidden");
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        new getInfinityNotifications();
        setInterval(getInfinityNotifications, 15000);

    });

    function getInfinityNotifications(){
        $.ajax({
            type: "GET",
            url: "/admin/infinity/get-infinity-messages-notifications",
            success: function (response) {
                let p = document.getElementById('infinity');
                p.innerHTML=response;
                if( response > 0 ){
                    p.removeAttribute("hidden");
                }else{
                    p.setAttribute("hidden");
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        new getOurWorkNotifications();
        setInterval(getOurWorkNotifications, 15000);

    });

    function getOurWorkNotifications(){
        $.ajax({
            type: "GET",
            url: "/admin/our-work/get-our-work-messages-notifications",
            success: function (response) {
                let p = document.getElementById('our-work');
                p.innerHTML=response;
                if( response > 0 ){
                    p.removeAttribute("hidden");
                }else{
                    p.setAttribute("hidden");
                }
            }
        });
    }
</script> --}}
