<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/14cef441fc.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/components.js') }}"></script>

        <!-- axios CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gray-100">
            
            <!-- Page Heading -->
            <header class="bg-indigo-500 shadow w-2/5 bb">
                <div class="flex mx-8 my-4 w-full items-center">

                    <a href="{{ route('admin.home') }}" class="pl-5">
                        <x-application-logo class="block h-10 w-auto fill-current" style="fill: white"/>
                    </a>
                    <div class="mx-auto text-center mt-2">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <div class="text-sm text-gray-500"><p>ログイン中</p></div>
                                <button class="flex items-center text-xl font-medium text-gray-100 hover:text-gray-400 hover:border-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-100 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>
                          
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                          
                            <x-slot name="content">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                          
                                    <x-dropdown-link :href="route('admin.logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                          </x-dropdown>
                    </div>
                </div>
                {{-- @include('layouts.navigation'); --}}
                <nav class="max-w-7xl mx-auto py-6 px-5 sm:px-6 lg:px-8">
                    <ul class="font-semibold text-3xl text-gray-100 leading-tight flex flex-col content-around">
                        <li class="mb-14 hover:text-gray-400">
                            <a href="#">
                                <i class="fas fa-tachometer-alt"></i>
                                <p class="inline-block ml-6">Home</p>
                            </a>
                        </li>
                        <li class="mb-14 hover:text-gray-400">
                            <a href="#">
                                <i class="far fa-comment-alt"></i>
                                <p class="inline-block ml-6">Activity</p>
                            </a>
                        </li>
                        <li class="mb-14 hover:text-gray-400">
                            <a href="#">
                                <i class="fas fa-users"></i>
                                <p class="inline-block ml-6"#>Employee</p>
                            </a>
                        </li>
                        <li class="mb-14 hover:text-gray-400">
                            <a href="#">
                                <i class="fas fa-cogs"></i>
                                <p class="inline-block ml-6">Settings</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>

            <!-- Page Content -->
            <main class="w-3/4 flex flex-wrap" x-data="app()" x-init="[initDate(), getNoOfDays(), readEvent()]" x-cloak>
                <div class="h-1/2 w-1/2 py-3">
                    {{ $slot }}
                </div>
                <div class=" h-1/2 w-1/2 py-3">
                    {{ $timeline }}
                </div>
                <div class="w-full h-1/2 py-3 bg-gray-600">
                    {{ $employee }}
                </div>
            </main>
        </div>
    </body>
</html>
{{-- TODO:switch route "user" or "admin" --}}
