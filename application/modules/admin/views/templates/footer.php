</section>

</div>

</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>assets/admin/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?= base_url(); ?>assets/admin/bower_components/raphael/raphael.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>assets/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>


<!-- jvectormap -->
<script src="<?= base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>assets/admin/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>assets/admin/bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url(); ?>assets/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url(); ?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?= base_url(); ?>assets/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url(); ?>assets/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url(); ?>assets/admin/dist/js/pages/dashboard.js"></script> -->
<script>
(function(w, d){
  var b = d.getElementsByTagName('body')[0];
  var s = d.createElement("script");
  var v = !("IntersectionObserver" in w) ? "8.17.0" : "10.20.0";
  s.async = true; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
  s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
  w.lazyLoadOptions = {
      elements_selector: ".lazy",
      immediateLoad: true
  };
  b.appendChild(s);
}(window, document));
</script>

<?php
    //Add extra js files
    if(isset($js_files)) :
      foreach($js_files as $file): ?>
      <?php if(strpos($file, 'jquery-1.11.1.min.js ') !== false)
              //continue;
        ?>

        <?php echo '  <script src="'.$file.'  " charset="utf-8"></script>'; ?>
      <?php endforeach;
    endif;
 ?>
</body>
</html>
