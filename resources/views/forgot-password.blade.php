<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gawang Gamat</title>
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/forgot-password.css') }}" rel="stylesheet">
</head>

<body>



<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-4 col-md-4"> <!-- Adjust the column width as needed -->
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                  <img src="admin_assets/img/title-logo/tabun.png" alt="logo" width="100" height="50%">
                    <h1 class="h4 text-gray-900 mb-4">Forgot-password</h1>
                    <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                  </div>
                  <form class="user" method="POST" action="/new-password">
                                @if($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </div>
                                @endif
                                @if(isset($error))
                                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <input value="{{old('email')}}" type="email" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address..." name="email" @error('email') style="border: 3px solid #F19E9EFF;" @enderror>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Send OTP">
                            </form>




                            <!-- <div class="container">
                                <div class="card o-hidden border-0 shadow-lg">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-lg-2 d-none d-lg-block"></div>
                                            <div class="col-lg-6">
                                                <div class="card-content p-5">
                                                    <div class="text-center">
                                                        <h1 class="title">Forgot Your Password?</h1>
                                                    </div>
                                                    <form class="user" method="POST" action="/new-password">
                                                        @if($errors->any())
                                                            <div class="alert alert-danger" role="alert">
                                                                @foreach($errors->all() as $err)
                                                                    <li>{{ $err }}</li>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        @if(isset($error))
                                                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                                                        @endif
                                                        @csrf
                                                        <div class="form-group">
                                                            <input value="{{old('email')}}" type="email" class="form-control form-control-user"
                                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                                placeholder="Enter Email Address..." name="email" @error('email')style="border: 3px solid #F19E9EFF;" @enderror>
                                                        </div>
                                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Send OTP">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

</body>

</html>
