<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Left Side - Image/Branding Section -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            
            <!-- Decorative circles -->
            <div class="absolute top-0 left-0 w-72 h-72 bg-white/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>
            
            <div class="relative z-10 flex flex-col justify-center items-start px-16 text-white animate-fade-in-up">
                <div class="mb-8">
                    <a href="/">
                        <x-application-logo class="w-16 h-16 fill-current text-white" />
                    </a>
                </div>
                
                <h1 class="text-5xl font-bold mb-6 leading-tight">
                    Start Your Journey<br/>
                    <span class="text-indigo-200">With Us Today</span>
                </h1>
                
                <p class="text-xl text-indigo-100 mb-8 max-w-md">
                    Join thousands of satisfied customers and discover amazing products tailored just for you.
                </p>
                
                <div class="flex items-center space-x-8 text-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Free Shipping</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Easy Returns</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>24/7 Support</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Form Section -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white dark:bg-gray-900">
            <div class="w-full max-w-md animate-slide-in-right">
                <!-- Mobile Logo -->
                <div class="lg:hidden flex justify-center mb-8">
                    <a href="/">
                        <x-application-logo class="w-12 h-12 fill-current text-indigo-600 dark:text-indigo-400" />
                    </a>
                </div>
                
                <!-- Content Slot -->
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>