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
<!-- Auto Format Currency (Money) With jQuery -->
<script src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/js/easy-number-separator.js"></script>

<!-- Ckeditor-->
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor1');
</script>

<!--load thumbail before load image-->
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

<!--load mutilple image before load image-->
<script>
  $(document).ready(function(){
    $('#image').change(function(){
        $("#frames").html('');
        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#frames").append('<div class="col-sm-4"><img src="'+window.URL.createObjectURL(this.files[i])+'"style="max-height:88px;width:140px;margin-bottom:5px;border: 1px solid #858796;"/></div>');
        }
    });
  });
</script>

<!-- Convert slug-->
<script>
function ChangeToSlug(){
    var slug;
    
    //Lấy text từ thẻ input title 
    slug = document.getElementById("slug").value;
    slug = slug.toLowerCase();
    //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
    document.getElementById('convert_slug').value = slug;
}
</script>
<script>
    $('input.CurrencyInput').on('blur', function() {
  const value = this.value.replace(/,/g, '');
  this.value = parseFloat(value).toLocaleString('vi-VN', {
    style: 'decimal'
  });
});
</script>
</body>
</html>