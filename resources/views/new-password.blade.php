<!DOCTYPE html>
<html lang="en">

<head>
    <title>T-Shirt</title>
    <link rel="shortcut icon" href="{{ URL::to('admin_assets/img/title-logo/tabun.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200 min-h-screen flex items-center justify-center">
  <div class="container mx-auto px-4">
    <div class="flex justify-center">
      <div class="w-full max-w-lg"> <!-- Adjusted the column width -->
        <!-- Logo for login -->
        <img class="mx-auto mb-4 w-32" src="{{ asset('admin_assets/img/logo/imglogo.png') }}" alt="logo">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden my-5">
          <div class="p-6">
            <div class="text-center">
              @if(Session::has('success'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ Session::get('success') }}
              </div>
              @endif
              <h1 class="text-2xl font-semibold text-gray-900 mb-4">New Password</h1>
            </div>

            <form class="user" method="post" action="reset_password">
            @if($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(isset($error))
                    <div class="mb-4 text-red-600">{{ $error }}</div>
                @endif

                @csrf

                <div class="mb-4">
                    <input type="text" class="form-control form-control-user border rounded-lg w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                        id="inputOTP" aria-describedby="otpcode" placeholder="OTP Code" name="otp" @error('otp') style="border: 2px solid #F19E9EFF;" @enderror required>
                </div>

                <div class="mb-4">
                    <input type="password" class="form-control form-control-user border rounded-lg w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                        id="exampleInputPassword" aria-describedby="emailHelp" placeholder="Password" name="password" @error('password') style="border: 2px solid #F19E9EFF;" @enderror required>
                </div>

                <div class="mb-4">
                    <input type="password" class="form-control form-control-user border rounded-lg w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                        id="exampleInputPasswordConfirmation" aria-describedby="emailHelp" placeholder="Retype Password" name="password_confirmation" @error('password') style="border: 2px solid #F19E9EFF;" @enderror required>
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block bg-blue-500 text-white rounded-lg p-2 hover:bg-blue-600 transition duration-200 w-full">Reset Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
