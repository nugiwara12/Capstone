{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Gawang Gamat</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/css/login-logo.css') }}" rel="stylesheet">

</head>
<body class="bg-gradient-primary" style="background-image: url('admin_assets/img/wallpaper/baragayTabun.png'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;"> --}}


@extends('layouts.app2')
<link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin_assets/css/login-logo.css') }}" rel="stylesheet">

@section('contents')
@if(Session::has('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            customClass: {
                popup: 'colored-toast',
            },
            showCloseButton: true,
            showConfirmButton: false,
            timer: 2500,
        });

        Toast.fire({
            icon: 'error',
            title: "{{ Session::get('error') }}",
        });
    </script>
@endif
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-8 col-md-9"> <!-- Adjust the column width as needed -->
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <!-- add logo for login -->
                    {{-- <img class="title-logo" src="{{ asset('admin_assets/img/logo/imglogo.png') }}" alt="logo"> --}}
                    @if(Session::has('success'))
                     <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                     </div>
                  @endif
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form action="{{ route('login') }}" method="POST" class="user">
                    @csrf
                    @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                      </div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputEmail" class="form-label">Email Address</label>
                        <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                        <div id="passwordHelp" class="form-text">Never share your password with anyone else.</div>
                      </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input name="remember" type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-user">Login</button>
                  </form><br>
                  <div class="text-center">
                    <a class="small" href="forgot-password">Forgot Password?</a> <span class="small">or</span> <a class="small" href="register">Sign Up</a>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

@endsection
{{-- </body>
</html> --}}
