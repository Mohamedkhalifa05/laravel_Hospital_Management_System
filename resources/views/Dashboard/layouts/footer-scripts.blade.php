<!-- Back-to-top -->
<a href="#top" id="back-to-top">
    <i class="las la-angle-double-up"></i>
</a>

<!-- ========================================================= -->
<!-- 1. jQuery - يجب أن يكون أول ملف JavaScript -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/jquery/jquery.min.js') }}"></script>


<!-- ========================================================= -->
<!-- 2. Bootstrap - بعد jQuery مباشرة -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<!-- ========================================================= -->
<!-- 3. Ionicons -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/ionicons/ionicons.js') }}"></script>


<!-- ========================================================= -->
<!-- 4. Moment -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/moment/moment.js') }}"></script>


<!-- ========================================================= -->
<!-- 5. DataTables - قبل table-data.js -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('Dashboard/assets/plugins/datatable/js/dataTables.bootstrap4.min.js') }}"></script>


<!-- ========================================================= -->
<!-- 6. Rating Plugins -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/rating/jquery.rating-stars.js') }}"></script>
<script src="{{ URL::asset('Dashboard/assets/plugins/rating/jquery.barrating.js') }}"></script>


<!-- ========================================================= -->
<!-- 7. Perfect Scrollbar -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ URL::asset('Dashboard/assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>


<!-- ========================================================= -->
<!-- 8. Sparkline -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>


<!-- ========================================================= -->
<!-- 9. Custom Scrollbar -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>


<!-- ========================================================= -->
<!-- 10. Sidebar -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/sidebar/sidebar-rtl.js') }}"></script>
<script src="{{ URL::asset('Dashboard/assets/plugins/sidebar/sidebar-custom.js') }}"></script>


<!-- ========================================================= -->
<!-- 11. Eva Icons -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/js/eva-icons.min.js') }}"></script>


<!-- ========================================================= -->
<!-- 12. Sticky -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/js/sticky.js') }}"></script>


<!-- ========================================================= -->
<!-- 13. Toastr -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/js/toastr.min.js') }}"></script>


<!-- ========================================================= -->
<!-- 14. ملفات JavaScript الخاصة بالصفحة -->
<!-- يجب أن تكون بعد كل الـ Plugins المطلوبة -->
<!-- ========================================================= -->
@yield('js')


<!-- ========================================================= -->
<!-- 15. Custom JS -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/js/custom.js') }}"></script>


<!-- ========================================================= -->
<!-- 16. Side Menu -->
<!-- يجب أن يكون Bootstrap وjQuery محملين قبله -->
<!-- ========================================================= -->
<script src="{{ URL::asset('Dashboard/assets/plugins/side-menu/sidemenu.js') }}"></script>


<!-- ========================================================= -->
<!-- 17. رسائل Toastr -->
<!-- ========================================================= -->
<script>
    @if(Session::has('message'))

        var type = "{{ Session::get('alert-type', 'info') }}";

        switch(type) {

            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }

    @endif
</script>
