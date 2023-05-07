<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PolluxUI Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{asset('assets/vendors/typicons/typicons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('assets/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

</head>
<body>
<div class="row" id="proBanner">
    <div class="col-12">
        <i class="typcn typcn-delete-outline" id="bannerClose"></i>
    </div>
  </div>
    <div class="container-scroller">
        @include('admin.common.header')
        <div class="container-fluid page-body-wrapper">
            @include('admin.common.right_sidebar')
            @include('admin.common.left_sidebar')
             <!-- partial -->
            <div class="main-panel">
            @yield('content')
            </div>
    <!-- main-panel ends -->
    </div>
    @include('admin.common.footer')
    <!-- page-body-wrapper ends -->
  </div>
    
 <!-- container-scroller -->

  <!-- base:js -->
  <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('assets/js/template.js')}}"></script>
  <script src="{{asset('assets/js/settings.js')}}"></script>
  <script src="{{asset('assets/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('assets/js/dashboard.js')}}"></script>
  <!-- End custom js for this page-->
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>

<script>
    @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
    @endif
    @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
    @endif
</script>
</body>

</html>

