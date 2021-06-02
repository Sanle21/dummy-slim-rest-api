<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;
    
    require __DIR__ . '/../vendor/autoload.php';
    /**
     * Decommenter le ligne ci-dessous pour avoir acces à votre base de donnée sql ou nosql
     */
    // require __DIR__ . '/../config/db.php';

    $app = AppFactory::create();

    $app->get('/hello/{name}', function (Request $resquest, Response $response, $args) {
        $name = $args['name'];
        $response->getBody()->write("Hello $name");

        return $response;
    });

    /**
     * Inlusion de l'API REST
     */
    // Friends routes
    require __DIR__ . '/../routes/friends.php';

    $app->run();