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
      <div class="w-full max-w-lg">
        <a href="/">
          <img class="mx-auto mb-4 w-32" src="{{ asset('admin_assets/img/logo/imglogo.png') }}" alt="logo">
        </a>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden my-5">
          <div class="p-6">
            <div class="text-center">
              @if(Session::has('success'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ Session::get('success') }}
              </div>
              @endif

              @if ($errors->any())
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                      <strong class="font-bold">Whoops!</strong>
                      <span class="block sm:inline">{{ $errors->first() }}</span>
                  </div>
              @endif

              <h1 class="text-2xl font-semibold text-gray-900 mb-4">Login</h1>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4" onsubmit="showLoadingSpinner()">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input name="email" type="email" id="exampleInputEmail" placeholder="Enter Email Address..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                  <input name="password" type="password" id="exampleInputPassword" placeholder="Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                  <button type="button" id="togglePassword" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
                <div class="text-xs text-gray-500 italic">Never share your password with anyone else.</div>
              </div>

              <div class="flex justify-between items-center">
                <div class="text-left">
                  <a href="forgot-password" class="text-sm text-indigo-600 hover:text-indigo-700">Forgot Password</a>
                  <div class="text-start ">
                    <a href="register" class="text-sm text-indigo-600 hover:text-indigo-700">Sign Up</a>
                  </div>
                </div>
                <div class="text-right">
                  <button type="submit" class="w-20 bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
                </div>
              </div>
              <hr class="my-4">
            </form>

            <!-- Loading Spinner -->
            <div id="loadingSpinner" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
              <div class="loader">
                <svg class="animate-spin h-10 w-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0112.354-5.657l-1.414 1.414A6 6 0 106 12h-2z"></path>
                </svg>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('exampleInputPassword');
      const toggleButton = document.getElementById('togglePassword');

      // Toggle password visibility
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Change icon
      } else {
        passwordInput.type = 'password';
        toggleButton.innerHTML = '<i class="fas fa-eye"></i>'; // Change icon
      }
    }

    function showLoadingSpinner() {
      document.getElementById('loadingSpinner').classList.remove('hidden');
    }
  </script>
</body>
</html>
