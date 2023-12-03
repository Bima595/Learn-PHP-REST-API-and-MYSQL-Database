<?php 
    header('Content-Type: application/json; charset=UTF-8');

    include "app/Config/DatabaseConfig.php";
    include 'app/Traits/ApiResponseFormatter.php';
    include 'app/Routes/ProductRoutes.php';
    include 'app/Routes/KasirRoutes.php';

    use app\Routes\KasirRoutes;
    use app\Routes\ProductRoutes;

    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $productRoute = new ProductRoutes();
    $productRoute->handle($method, $path);

    $kasirRoute = new KasirRoutes();
    $kasirRoute->handle($method, $path);
    
    // php -S localhost:8000 main.php
