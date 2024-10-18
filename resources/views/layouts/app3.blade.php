<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="{{asset('assets/images/favicon4.ico')}}" type="image/x-icon">
  <title>GawangGamat</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <!-- Products Css  -->
  <link href="{{ asset('admin_assets/css/product.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/css/dashboard.css') }}" rel="stylesheet" >
  <link rel="stylesheet" href="https://fontawesome.com/icons/folder?f=classic&s=light">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Link of Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
  <!-- title-logo -->

</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
          </div>

          <div class="flex flex-1">
            <main class="flex items-center justify-center flex-1 px-4 py-8">
                @yield('contents')
            </main>
          </div>

          <!-- Content Row -->


        </div>
        <!-- /.container-fluid -->

      </div>
    </div>
  </div>

  <!-- Sweet Alert Delete Js  -->
  <script src="{{asset('admin_assets/js/delete.js')}}"></script>
  <!-- Sweet alert  -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Custom fonts print template-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
</body>
</html>
