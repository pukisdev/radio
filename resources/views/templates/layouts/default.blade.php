<!doctype html>
<html ng-app="appRoot">
    <head>
        @include('templates.'.$var_template.'.head')
    </head>
    <body>
        <div class="container">

            <header class="row">
                @include('templates.'.$var_template.'.header')
            </header>

            <div id="main" class="row">

                    @yield('content')
                 {{ $var_template }}       
            </div>

            <footer class="row">
                @include('templates.'.$var_template.'.footer')
            </footer>

        </div>
    </body>
</html> 