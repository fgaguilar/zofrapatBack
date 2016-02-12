<!DOCTYPE  html>
<!--cargamos nuestro modulo en la etiqueta html con ng-app-->
<html lang="es" ng-app="app">
<head>
    <meta charset="UTF-8" />
    <title>Combinando Laravel 4 y AngularJS</title>
    {{ HTML::style('css/normalize.css') }}
    {{ HTML::style('css/foundation.min.css') }}
</head>
<body>
    <!--creamos el div con la directiva ng-view, aquí será donde
    carguen todas las vistas-->
    HOLA
    <div class="row" ng-view></div>
    {{ HTML::script('js/angular.js') }}
    {{ HTML::script('js/app.js') }}
    {{ HTML::script('js/controllers.js') }}
</body>
</html>