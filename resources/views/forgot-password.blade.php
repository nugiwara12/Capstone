<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gawang Gamat</title>
    <!-- Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/forgot-password.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-200 min-h-screen flex items-center justify-center">
  <div class="container mx-auto px-4">
    <div class="flex justify-center">
      <div class="w-full max-w-md"> <!-- Adjusted the column width -->
        <!-- Logo for login -->
        <img class="mx-auto mb-2 w-40" src="{{ asset('admin_assets/img/logo/imglogo.png') }}" alt="logo">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden my-2">
          <div class="p-6 bg-white rounded-lg shadow-lg">
            <div class="text-center">
              @if(Session::has('success'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ Session::get('success') }}
              </div>
              @endif
              <h1 class="text-2xl font-semibold text-gray-900 mb-3">Forgot Password</h1>
              <p class="text-gray-700">Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link.</p>
            </div>
            <form class="user" method="POST" action="/new-password">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(isset($error))
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endif
                
                <div class="mb-4">
                    <input 
                    value="{{ old('email') }}" 
                    type="email" 
                    class="form-control form-control-user block w-full px-4 py-2 border border-gray-300 rounded-lg @error('email') border-red-500 @enderror" 
                    id="exampleInputEmail" 
                    aria-describedby="emailHelp" 
                    placeholder="Enter Email Address..." 
                    name="email">
                </div>
                
                <div>
                    <input 
                    type="submit" 
                    class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" 
                    value="Send OTP">
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


