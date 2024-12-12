<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-r from-blue-50 to-blue-100 flex items-center justify-center">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-blue-900 mb-2">Welcome Back</h1>
            <p class="text-gray-600">Log in to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-100">
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-100">
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center mb-6">
                <input type="checkbox" id="remember" name="remember"
                    class="w-4 h-4 text-blue-900 border-gray-300 rounded focus:ring-blue-500">
                <label for="remember" class="ml-2 text-gray-700">Remember me</label>
            </div>

            <button type="submit"
                class="w-full py-3 bg-blue-900 text-white rounded-lg font-semibold hover:bg-blue-800 transition duration-200">
                Sign In
            </button>
        </form>

        @if(Route::has('auth.provider.redirect'))
        <div class="relative my-8 text-center">
            <span class="absolute inset-x-0 top-1/2 transform -translate-y-1/2 bg-white px-4 text-gray-500">or</span>
            <div class="border-t border-gray-300"></div>
        </div>

        <div class="space-y-4">
            @if(Config::get('services.google'))
            <a href="{{ route('auth.provider.redirect', 'google') }}"
                class="w-full flex items-center justify-center py-3 border border-blue-900 rounded-lg text-blue-900 font-medium hover:bg-blue-900 hover:text-white transition duration-200">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12.037 21.998a10.313 10.313 0 0 1-7.168-3.049 9.888 9.888 0 0 1-2.868-7.118 9.947 9.947 0 0 1 3.064-6.949A10.37 10.37 0 0 1 12.212 2h.176a9.935 9.935 0 0 1 6.614 2.564L16.457 6.88a6.187 6.187 0 0 0-4.131-1.566 6.9 6.9 0 0 0-4.794 1.913 6.618 6.618 0 0 0-2.045 4.657 6.608 6.608 0 0 0 1.882 4.723 6.891 6.891 0 0 0 4.725 2.07h.143c1.41.072 2.8-.354 3.917-1.2a5.77 5.77 0 0 0 2.172-3.41l.043-.117H12.22v-3.41h9.678c.075.617.109 1.238.1 1.859-.099 5.741-4.017 9.6-9.746 9.6l-.215-.002Z" />
                </svg>
                Continue with Google
            </a>
            @endif

            @if(Config::get('services.github'))
            <a href="{{ route('auth.provider.redirect', 'github') }}"
                class="w-full flex items-center justify-center py-3 border border-blue-900 rounded-lg text-blue-900 font-medium hover:bg-blue-900 hover:text-white transition duration-200">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z" />
                </svg>
                Continue with Github
            </a>
            @endif
        </div>
        @endif

        <p class="text-center text-gray-600 mt-8">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-900 underline font-medium">Sign up</a>
        </p>
    </div>
</body>

</html>