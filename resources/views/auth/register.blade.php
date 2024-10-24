<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gawang Gamat</title>

    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


    <link href="{{ asset('admin_assets/css/register-logo.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="w-full max-w-lg">
                <!-- Logo for login -->
                <a href="/">
                    <img class="mx-auto mb-4 w-32" src="{{ asset('admin_assets/img/logo/imglogo.png') }}" alt="logo">
                </a>
                <div class="bg-white shadow-md rounded-lg overflow-hidden mt-5">
                    <div class="p-6">
                        <div class="text-center">
                            <h1 class="text-2xl font-semibold text-gray-900 mb-4">Register</h1>
                        </div>
                        <form action="{{ route('register.save') }}" method="POST" class="space-y-4">
                        @csrf
                            <div class="flex flex-wrap gap-4">
                                <div class="w-full">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input name="name" type="text" id="name" required placeholder="Full Name" 
                                        value="{{ old('name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                        focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                                    @error('name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input name="phone" type="text" id="phone" placeholder="09XXXXXXXXX" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)" 
                                        maxlength="11" required value="{{ old('phone') }}" 
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('phone') border-red-500 @enderror">
                                    @error('phone')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <input name="email" type="email" id="email" required placeholder="Email Address" 
                                        value="{{ old('email') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                        focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input name="password" type="password" id="password" required placeholder="Password" 
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                        focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('password') border-red-500 @enderror">
                                    <div class="text-xs text-gray-500 italic">Must be 8-20 characters long, include at least 1 number and both upper and lower case letters.</div>
                                    @error('password')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                    <input name="password_confirmation" type="password" id="password_confirmation" placeholder="Confirm Password" 
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                        focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('password_confirmation') border-red-500 @enderror">
                                    @error('password_confirmation')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-center">
                                    <input type="checkbox" id="show-password" class="h-4 w-4">
                                    <label for="show-password" class="ml-2 text-sm text-gray-700">Show Password</label>
                                </div>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Tell About Yourself</label>
                                <textarea name="description" id="description" required placeholder="Description" 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <input type="hidden" name="role" value="users" style="display:none;">
                            </div>

                            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Register Account
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <a class="text-sm text-indigo-600 hover:text-indigo-700" href="login">Already registered to an existing account?</a>
                        </div>
                        <hr class="my-4">
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Show Password -->
<script>
    const showPasswordCheckbox = document.getElementById('show-password');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');

    showPasswordCheckbox.addEventListener('change', function () {
        const passwordType = this.checked ? 'text' : 'password';
        passwordInput.type = passwordType;
        confirmPasswordInput.type = passwordType;
    });
</script>
</body>
</html>


