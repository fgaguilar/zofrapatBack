var app = angular.module("app", []);
 
app.config(function($routeProvider)
{
 
    $routeProvider.when("/home", 
    {
 
        controller: "homeController",
        templateUrl: "../templates/home.html"
 
    })
 
})