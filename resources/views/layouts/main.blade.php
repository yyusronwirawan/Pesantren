<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Al Muntadhor Application</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{!! asset('assets/vendors/mdi/css/materialdesignicons.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/vendors/css/vendor.bundle.base.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/fontawesome/css/all.min.css') !!}">

  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{!! asset('assets/images/favicon.ico') !!}" />
</head>

<body>
  <div class="container-scroller">
    @yield('container')
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{!! asset('assets/vendors/js/vendor.bundle.base.js') !!}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{!! asset('assets/js/off-canvas.js') !!}"></script>
  <script src="{!! asset('assets/js/hoverable-collapse.js') !!}"></script>
  <script src="{!! asset('assets/js/misc.js') !!}"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
</body>

</html>