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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Agrega estilos personalizados aquí */
        @media (max-width: 767px) {
            /* Estilos específicos para pantallas pequeñas */
            .banner {
                flex-direction: column-reverse;

            }
            /* oculatr img */
            .banner_img {
                display: none;
            }
        }
       
        
    </style>

</head>

<body class="antialiased">



    <div >
        <header class="bg_animate">
            <section class="banner contenedor">
                <div class="banner_title rounded-end" style=" background-color: #532f2f; border-radius: 10px; padding: 20px;">



                    @if (Route::has('login'))
                        @auth
                            <h2>Hola Denuevo!</h2>
                            <h3>Estas en la mejor plataforma para gestionar tu equipo de futbol</h3>
                            <a href="{{ url('/dash') }}"
                                class="btn active rounded-pill" role="button" style="background-color: #a30d0d;  color: white;">
                                Ir al dashboard</a>
                        @else
                        <h2>Bienvenido!</h2>

                        <div class="container">
                            <div class="row">
                                <div class="col-sm text-white">
                                
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        
            
                                    
                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __('Email') }} <i class="fa-solid fa-user"></i></label>
                                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" >
                                        </div>
                                    
                                        <div class="mb-3">
                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                                        </div>
                                    
                                        <div class="mb-3 form-check">
                                            <input id="remember_me" class="form-check-input" type="checkbox" name="remember">
                                            <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                                        </div>
                                    
                                        <div class="d-flex justify-content-end">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-sm text-gray-600"> {{ __('Forgot your password?') }} </a>
                                            @endif
                                    
                                            
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        
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
