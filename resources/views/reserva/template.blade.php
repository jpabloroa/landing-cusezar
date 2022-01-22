<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        html, body {
            height: 100vh;
            width: 100vw;
        }

        #main-container {
            overflow: hidden;
            background-color: rgba(255, 255, 255, 1);
            width: 50vw;
            /*height: 50vh;*/
            height: auto;
            border-radius: 20px;
            /*padding: 7.5vh 5vw;*/
        }

        .card{
            height: auto;
        }

        /*
        #main-container::before{
            content: '';
            position: absolute;
            background-color: rgba(255,255,255,0.5);
            width: 45vw;
            height: 42.5vh;
            border-radius: 20px;
        }
         */
        input.currency {
            padding: 10px;
            font: 20px Arial;
            width: 70%;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
    <script>
        window.onload = function () {
            const currencyInput = document.querySelector('input[type="currency"]');
            const currency = 'COP'; // https://www.currency-iso.org/dam/downloads/lists/list_one.xml


            if (currencyInput !== null) {
                // format inital value
                onBlur({target: currencyInput});


                // bind event listeners
                currencyInput.addEventListener('focus', onFocus);
                currencyInput.addEventListener('blur', onBlur);
            }


            function localStringToNumber(s) {
                return Number(String(s).replace(/[^0-9.-]+/g, ""));
            }

            function onFocus(e) {
                const value = e.target.value;
                e.target.value = value ? localStringToNumber(value) : '';
            }

            function onBlur(e) {
                const value = e.target.value;

                const options = {
                    maximumFractionDigits: 2,
                    currency: currency,
                    style: "currency",
                    currencyDisplay: "symbol"
                };

                e.target.value = (value || value === 0)
                    ? localStringToNumber(value).toLocaleString(undefined, options)
                    : '';
            }
        };
    </script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100"
     style="background-image: url('https://cusezar.com/wp-content/uploads/2021/08/Cusezar-La-Marlene-Aerea-union-Especifica-V4.jpg');background-repeat: no-repeat;background-size:cover;">

    <!-- Page Content -->
    <main>

        <div class="container-fluid d-flex justify-content-center align-items-center"
             style="height:100vh; overflow:hidden;">

            <!-- Inner row, half the width and height, centered, blue border -->
            <div id="main-container" class="row text-center d-flex align-items-center">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{$title}}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" role="form" enctype="multipart/form-data">

                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    {!! $content !!}

                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="w-full btn mt-3 btn-primary">{{__('Enviar')}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div> <!-- Inner row -->
        </div>
    </main>
</div>
</body>
</html>
