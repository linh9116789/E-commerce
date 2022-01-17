</div>
<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y')?> Xây dựng bởi Dev.Web</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/js/pages/dashboard.js"></script>
<!-- Admin Ckeditor-->
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor1');
</script>
<!-- Admin load thumbail before load image-->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }
    $("#imgInp").change(function(){
    readURL(this);
    });
</script>
</body>
</html>