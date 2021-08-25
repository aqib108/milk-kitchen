<!-- jQuery -->
<script src="{{asset('admin-panel/plugins/jquery/jquery.min.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin-panel/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="{{ asset('js1/app.js') }}"></script>
<script src="{{ asset('js1/custom.js') }}"></script>
<script src="{{ asset('js1/sweetalert.min.js') }}"></script>
<script src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.min.js"></script>
<script>
    $(window).on("load",function(){
        $(".loader-wrapper").fadeOut("slow");
        // Delete alert Response
        setTimeout(function(){
                $('.redirect_back').remove();
            },2000)
    });
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin-panel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

       <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
{{-- Popper --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('admin-panel/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin-panel/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('admin-panel/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin-panel/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin-panel/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin-panel/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin-panel/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin-panel/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}">
</script>
<!-- Select2 -->
<script src="{{asset('admin-panel/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin-panel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-panel/dist/js/adminlte.js')}}"></script>
{{--<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('admin-panel/dist/js/pages/dashboard.js')}}"></script>--}}
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin-panel/dist/js/demo.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('admin-panel/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script src="{{asset('js/main.js')}}"></script>
<!-- Toggel button !-->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

