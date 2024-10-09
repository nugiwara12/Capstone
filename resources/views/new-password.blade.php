<!DOCTYPE html>
<html lang="en">

<head>
    <title>T-Shirt</title>
    <link rel="shortcut icon" href="{{ URL::to('admin_assets/img/title-logo/tabun.png') }}">
    <link rel="shortcut icon" href="{{ URL::to('admin_assets/img/title-logo/tabun.png') }}" type="image/x-icon">
</head>


<body>
<div class="container">
    <div class="text-center">
    <img src="admin_assets/img/title-logo/tabun.png" alt="logo" width="100" height="50%">
    <h2 class="text-center">New password</h2>
    <div class="text-center">
        <p class="mb-4">Requirements</p>
            </div>
            <form class="user" method="post" action="reset_password">

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
    {{--        <div class="form-group">--}}
    {{--           <input type="email" class="form-control form-control-user"--}}
    {{--           id="exampleInputEmail" aria-describedby="emailHelp"--}}
    {{--           placeholder="Retype password" name="email" value="{{ $email }}" readonly>--}}
    {{--        </div>--}}
                <div class="form-group">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user"
                            id="inputOTP" aria-describedby="otpcode"
                            placeholder="OTP Code" name="otp" @error('otp') style="border: 3px solid #F19E9EFF;" @enderror required>
                        </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user"
                            id="exampleInputPassword" aria-describedby="emailHelp"
                            placeholder="Password" name="password" @error('password') style="border: 3px solid #F19E9EFF;" @enderror required>
                        </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-user"
                            id="exampleInputPassword" aria-describedby="emailHelp"
                            placeholder="Retype password" name="password_confirmation" @error('password') style="border: 3px solid #F19E9EFF;" @enderror required>
                </div>

                <input type= "submit" class="btn btn-primary btn-user btn-block" value="Reset password">
                </div>
            </form>
        </div>
    </div>
</body>
</html>




