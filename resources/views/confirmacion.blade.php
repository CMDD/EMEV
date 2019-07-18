<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>El Man está vivo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="css/app.css">

        
    </head>
    <body>
        <div id="app">
            <confirmacion></confirmacion>
        </div>
        <script type="text/javascript" src="https://checkout.epayco.co/checkout.js">   </script>
        <script src="js/app.js" ></script>
    </body>
</html>
