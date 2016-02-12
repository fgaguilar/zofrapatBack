//solicitamos los datos de la ruta getData para obtener todos los posts
//de la bd en formato json
app.controller("homeController", function($scope,$http)
{
    $http.get('http://localhost/laravel_angularjs/public/getData').success(function(data) 
    {
        $scope.datos = data.posts;//así enviamos los posts a la vista
    });
})