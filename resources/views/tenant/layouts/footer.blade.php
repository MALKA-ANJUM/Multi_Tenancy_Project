    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer -->
    <footer class="footer position-static mt-3 pt-3 pb-1 mb-2" style="box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1); background: #2750A5">
    
            <div class="d-flex justify-content-between flex-wrap">
                <p class="mb-0 text-white fs-5">
                    COPYRIGHT &copy; {{ date('Y') }}
                    <a class="ms-25 fw-bold text-decoration-none text-white" href="">HybridScribe</a>,
                    All rights Reserved
                </p>
    
                <div class="mb-0">
                    <a href="#" class="text-white me-1"><i data-feather="facebook"></i></a>
                    <a href="#" class="text-white me-1"><i data-feather="twitter"></i></a>
                    <a href="#" class="text-white"><i data-feather="instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="fa-solid fa-arrow-up"></i></button>
    <!-- END: Footer-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('assets/vendors/js/ui/jquery.sticky.js')}}"></script>
    <script src="{{asset('assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/extensions/plyr.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/extensions/plyr.polyfilled.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <script src="{{asset('assets/js/scripts/pages/page-pricing.js')}}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Select2 JS-->
    <script src="{{asset('assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/scripts/forms/form-select2.js')}}"></script>
    <!-- END: Select2 JS-->
    <script src="{{asset('assets/js/scripts/extensions/ext-component-media-player.js')}}"></script>
    <script src="{{asset('assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/js/scripts/pages/app-ecommerce-checkout.js')}}"></script>

    <script>
        $(window).on('load', function() {
                      
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>