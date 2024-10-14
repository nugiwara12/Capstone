<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Shirt</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo" >

    <style>
        .page_404 {
            padding: 40px 0;
            background: #fff;
            font-family: 'Arvo', serif;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {

            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 400px;
            background-position: center;
        }

        .four_zero_four_bg h1 {
            font-size: 80px;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 20px 0;
            display: inline-block;
        }

        .contant_box_404 {
            margin-top: -50px;
        }
    </style>
</head>

<body>
    <section class="page_404">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="col-sm-10 col-sm-offset-1  text-center">
                        <div class="four_zero_four_bg">
                            <h1 class="text-center ">404</h1>

                        </div>

                        <div class="contant_box_404">
                            <h3 class="h2">
                                Look like you're lost
                            </h3>

                            <p>the page you are looking for not avaible!</p>

                            <a href="{{route('dashboard')}}" class="link_404">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html> -->



 {{-- <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>Gawang Gamat</title>

   <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> --}}


 @extends('layouts.app2')
   <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
   <link href="{{ asset('admin_assets/css/register-logo.css') }}" rel="stylesheet">
{{--
 </head>
 <body class="bg-gradient-primary" > --}}

    @section('contents')
    <div class="container">
     <div class="row justify-content-center">
    {{--  Adjust the column width as needed --}}
       <div class="col-xl-8 col-lg-8 col-md-9">
         <div class="card o-hidden border-0 shadow-lg my-5">
           <div class="card-body p-0">
            <div class="row">
               <div class="col-lg-12">
                    <div class="p-5">
                    <div class="text-center">
                        {{-- <img class="title-logo" src="{{ asset('admin_assets/img/logo/imglogo.png') }}" alt="logo"> --}}
                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                    </div>
                    <form action="{{ route('register') }}" method="POST" class="user">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputName" class="form-label">Full Name</label>
                            <input name="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Full Name">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" type="hidden">
                            <fieldset class="form-group">
                                <label for="exampleInputRole" class="form-label">Role</label><br>
                                <div class="select-container">
                                    <select class="form-select @error('role') is-invalid @enderror" name="role" id="role" required autofocus autocomplete="role">
                                        {{-- <option selected disabled>User Types</option>
                                        <option value="Admin">Admin</option> --}}
                                        <option value="User">User</option>
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-exclude"></i>
                                    </div>
                                </div>
                            </fieldset>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPhone" class="form-label">Phone</label>
                            <input name="phone" type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" id="exampleInputPhone" placeholder="09XXXXXXXXX" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                        <label for="exampleInputEmail" class="form-label">Email Address</label>
                        <input name="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Email Address">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="exampleInputPassword" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                        <div id="passwordHelp" class="form-text">Must be 8-20 characters long, Input atleast 1 number and letters with Upper and Lower case.</div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="exampleInputPassword" class="form-label">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" id="exampleRepeatPassword" placeholder="Repeat Password">
                        @error('password_confirmation')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                    </form>
                    <div class="text-center">
                        <a class="small" href="login">Already registered to an existing account.</a>
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


   <!-- Bootstrap core JavaScript   -->
   <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

   <!-- Core plugin JavaScript   -->
   <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

   <!-- Custom scripts for all pages   -->
   <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

   @endsection
 {{-- </body>
 </html> --}}
