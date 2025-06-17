@extends('layouts.app')

@section('content')
<!-- Tailwind CSS + Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<style>
    body {
        font-family: 'Inter', sans-serif;
    }
</style>

<div class="min-h-screen bg-cover bg-center flex items-center justify-end p-6" style="background-image: url('{{ asset('images/dog_pic.jpg') }}');">
    <div class="w-full max-w-md bg-white rounded-lg shadow-xl mr-20">

        <!-- Header -->
        <div class="bg-[#28A745] text-white text-center text-2xl font-bold py-4 rounded-t-lg">
            {{ __('Login') }}
        </div>

        <!-- Form Body -->
        <div class="p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">
                        {{ __('Email Address') }}
                    </label>
                    <input id="email" type="email"
                        class="form-input-focus block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-[#28A745] @error('email') border-red-500 @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="text-red-500 text-xs italic mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">
                        {{ __('Password') }}
                    </label>
                    <input id="password" type="password"
                        class="form-input-focus block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-[#28A745] @error('password') border-red-500 @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="text-red-500 text-xs italic mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember"
                            class="form-checkbox h-5 w-5 text-[#28A745] rounded focus:ring-[#28A745]"
                            {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">{{ __('Remember Me') }}</span>
                    </label>
                </div>

                <!-- Login Button -->
                <div class="mb-4">
                    <button type="submit"
                        class="w-full px-6 py-3 bg-[#28A745] text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:ring-2 focus:ring-[#28A745] transition">
                        {{ __('Login') }}
                    </button>
                </div>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="text-center mb-6">
                        <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif

                <!-- Divider -->
                <div class="relative flex items-center justify-center my-6">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="mx-4 text-gray-500 text-sm">OR</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Google Button -->
                <div class="text-center">
                    <a href="{{ route('google.login') }}"
                        class="inline-flex items-center justify-center w-full px-6 py-3 border border-gray-300 rounded-full shadow-sm bg-white text-gray-700 font-medium text-lg hover:bg-gray-100 focus:ring-2 focus:ring-gray-300 transition">
                        <img src="{{ asset('images/google_logo.webp') }}" alt="Google logo" class="w-6 h-6 mr-3">
                        Sign in with Google
                    </a>
                </div>

                <!-- Register Link -->
                <div class="mt-6 text-center text-sm text-gray-600">
                    {{ __("Don't have an account?") }}
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">
                        {{ __('Register') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
