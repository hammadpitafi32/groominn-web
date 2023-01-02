<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- <link rel="icon" type="image/x-icon" href="../images/new-fav.svg"> -->

        <link rel="icon" type="image/x-icon" href="../images/favicon-new.svg">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <title>Groominn</title>
    </head>
    <body class="antialiased">
        <div id="app">
            <my-app></my-app>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript">
        
        $(".togle").click(function(){
            $(".custom-nav").toggle();
            
        });
        var but = document.querySelector(".carousel-control-prev");
        
        setInterval(function () {
            // console.log(window.location.pathname)
            if(window.location.pathname == '/'){
                but.click();
            }
            
        },10000);
    </script>
</html>
