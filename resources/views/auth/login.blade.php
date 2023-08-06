<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-[#1E293B]">
    <section class="relative w-full h-full py-40 min-h-screen">
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 px-4">
                    <div
                        class="relative bg-white flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0">

                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <div class="text-center mb-3 font-bold py-5">
                                <h4 class="text-xl font-bold text-blueGray-400">Sign in with redentials</h4>
                            </div>
                            <form>
                                <div class="relative w-full mb-3"><label
                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        for="grid-password">Email</label><input type="email"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        placeholder="Email"></div>
                                <div class="relative w-full mb-3"><label
                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        for="grid-password">Password</label><input type="password"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        placeholder="Password"></div>
                                <div>
                                    <label class="inline-flex items-center cursor-pointer"><input id="customCheckLogin"
                                            type="checkbox"
                                            class="form-checkbox border-0 rounded text-blueGray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150"><span
                                            class="ml-2 text-sm font-semibold text-blueGray-600">Remember
                                            me</span>
                                    </label>
                                </div>
                                <div class="text-center mt-6 bg-[#1E293B]"><button
                                        class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                                        type="button">Sign In</button></div>
                            </form>
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-6 relative">
                        <div class="w-1/2"><a href="#pablo" class="text-blueGray-200"><small>Forgot
                                    password?</small></a>
                        </div>
                        <div class="w-1/2 text-right"><a href="#pablo" class="text-blueGray-200"><small>Create new
                                    account</small></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
