<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FM</title>

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <!--Replace with your tailwind.css once created-->
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet" />



    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="antialiased leading-normal tracking-normal text-white m-6 bg-cover bg-fixed"
    style="background-image: linear-gradient(to left bottom, #132feb, #0051eb, #0065e1, #0074d0, #0080bb, #2684b4, #3d88ac, #508ba5, #6d8da5, #838fa2, #91939d, #999999);"
    {{-- style="background-image: url('img/header.png');" --}}>
    <div class="h-full">
        <!--Nav-->
        <div class="w-full container mx-auto">
            <div class="w-full flex items-center justify-between">
                <a class="flex items-center text-blue-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                    href="#">
                    Comunidad<span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 via-yellow-500 to-gray-400">FM</span>
                </a>

                <div class="flex w-1/2 justify-end content-center">
                    @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-lg underline">Inicio de Sesion</a>

                                {{-- @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                    @endif --}}
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!--Main-->
        <div class="container pt-24 md:pt-36 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <!--Left Col-->
            <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
                <h1
                    class="my-4 text-3xl md:text-5xl text-white opacity-75 font-bold leading-tight text-center md:text-left">
                    Bienvenido al sistema de Verificacion de
                    <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-500 via-yellow-300 to-yellow-500">
                        DOCUMENTOS
                    </span>
                </h1>
                <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left">
                    Por favor inicie sesion para gestionar su documento.
                </p>
            </div>

            <!--Right Col-->
            {{-- <div class="w-full xl:w-3/5 p-12 overflow-hidden">
                <img class="mx-auto w-full md:w-4/5 transform -rotate-6 transition hover:scale-105 duration-700 ease-in-out hover:rotate-6"
                    src="macbook.svg" />
            </div> --}}

            {{-- <div class="mx-auto md:pt-16">
                <p class="text-blue-400 font-bold pb-8 lg:pb-6 text-center">
                    Download our app:
                </p>
                <div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in">
                    <img src="App Store.svg" class="h-12 pr-12 transform hover:scale-125 duration-300 ease-in-out" />
                    <img src="{{asset('img\Play Store.svg')}}" class="h-12 transform hover:scale-125 duration-300 ease-in-out" />
                </div>
            </div> --}}

            <!--Footer-->
            <div class="w-full pt-16 pb-6 text-md text-center md:text-left fade-in inline-block align-bottom ">
                <a class="text-white no-underline hover:no-underline" href="#">&copy; Comunidad FM 2022</a>

                {{-- <a class="text-gray-500 no-underline hover:no-underline"
                    href="https://www.tailwindtoolbox.com">TailwindToolbox.com</a> --}}
            </div>
        </div>
    </div>
    @livewireScripts
</body>

</html>
