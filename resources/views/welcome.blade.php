<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    {{-- estilos que estan en la carpeta public y carpeta css --}}
    <link rel="stylesheet" href={{ asset('assets/css/styles.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/design.css') }}>

</head>

<body class="antialiased">



    <div >
        <header class="bg_animate">
            <div class="header_nav">
                <div class="container flex justify-between h-16 items-center">

                    <div
                    {{-- estilos de boostrap  --}}

                        class="flex justify-between h-16 items-center">
                        @if (Route::has('login'))
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 ">
                                @auth
                                    <a href="{{ url('/dash') }}"
                                    {{-- boostrap --}}
                                    class="btn active rounded-pill" role="button" style="background-color: #3e3131;  color: white;">Dashboard</a>
                                @else
                                    <a href="#"
                                        class="btn active rounded-pill" role="button" style="background-color: #3e3131;  color: white;">Login</a>

                                @endauth
                            </div>
                        @endif


                    </div>
                </div>
            </div>
            <section class="banner contenedor">
                <div class="banner_title rounded-end" style=" background-color: #3e3131; border-radius: 10px; padding: 20px;">



                    @if (Route::has('login'))
                        @auth
                            <h2>Hola Denuevo!</h2>
                            <h3>Estas en la mejor plataforma para gestionar tu equipo de futbol</h3>
                            <a href="{{ url('/dash') }}"
                                class="btn active rounded-pill" role="button" style="background-color: #a30d0d;  color: white;">
                                Ir al dashboard</a>
                        @else
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                
                            <div>
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                
                            <div class="mt-4">
                                <x-label for="password" value="{{ __('Password') }}" />
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                            </div>
                
                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                
                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                
                                <x-button class="ml-4">
                                    {{ __('Log in') }}
                                </x-button>
                            </div>
                        </form>
                        @endauth
                    @endif






                </div>
                <div class="banner_img">
                    <img src={{ asset('assets/futbolista.png') }} alt="">
                </div>
            </section>

            <div class="burbujas">
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
            </div>
        </header>
    </div>
</body>

</html>
