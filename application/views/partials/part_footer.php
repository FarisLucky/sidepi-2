<footer class="footer">
    <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019
            <a href="http://www.bootstrapdash.com/" target="_blank">Sidepi</a>. All rights reserved.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Sidepi Team 8:
            <i class="mdi mdi-heart text-danger"></i>
        </span>



        <!-- Batas Footer -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
</footer>
<!-- End Jquery -->
<script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
<!-- <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.addons.js"></script> -->
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
<script src="<?= base_url() ?>assets/js/misc.js"></script>
<!-- Sweet ALert -->
<script src="<?= base_url() ?>assets/custom/sweetalert/sweetalert2.all.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/custom/toastr/toastr.min.js"></script>
<!-- CKEditor -->
<script src="<?= base_url() ?>assets/library/ckeditor/ckeditor.js"></script>
<script src="<?= base_url() ?>assets/custom/select2/js/select2.full.min.js"></script>
<script src="<?= base_url() ?>assets/custom/lightbox2-11/js/lightbox.min.js"></script>
<!-- endinject -->
<script>
    $(document).ready(function() {
        $(".overlay").hide();
        $(".select-opt").select2({
            placeholder: '-- Pilih Options --',
            width: 'element'
        });
    });
    $('.active').parents('.collapse').addClass('show');
    $('.active').parents('.nav-item').addClass('active');
</script>
<!-- End custom js for this page-->
<script src="<?= base_url() . 'assets/custom/js/indexing.js' ?>"></script>
<!-- End custom js for this page-->

</body>

</html>