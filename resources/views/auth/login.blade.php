<!DOCTYPE html>
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
  <!-- Tailwind CSS CDN -->
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
              <h1 class="text-2xl font-semibold text-gray-900 mb-4">Login</h1>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
              @csrf
              @if ($errors->any())
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif

              <div class="form-group">
                <label for="exampleInputEmail" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input name="email" type="email" id="exampleInputEmail" placeholder="Enter Email Address..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword" class="block text-sm font-medium text-gray-700">Password</label>
                <input name="password" type="password" id="exampleInputPassword" placeholder="Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <div class="text-sm text-gray-500">Never share your password with anyone else.</div>
              </div>

              <div class="form-group flex items-center">
                <input name="remember" type="checkbox" id="customCheck" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="customCheck" class="ml-2 block text-sm text-gray-900">Remember Me</label>
              </div>

              <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
            </form><br>

            <div class="text-center">
              <a href="forgot-password" class="text-sm text-indigo-600 hover:text-indigo-700">Forgot Password?</a>
              <span class="mx-2 text-sm">or</span>
              <a href="register" class="text-sm text-indigo-600 hover:text-indigo-700">Sign Up</a>
            </div>
            <hr class="my-4">
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
