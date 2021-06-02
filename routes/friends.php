<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;

    $app = AppFactory::create();

    // VERSION API REST JSON PLACEHOLDER

    // Get All Friends data
    $app->get('/friends/all', function (Request $request, Response $response) {
        // URL DE LA REQUETE
        /**
         * Mais peut également etre une requête sql
         * Par exeample | $sql = "SELECT * FROM friends";
         * J'ai fait le choix d'utiliser "https://jsonplaceholder.typicode.com/users"
         */
        $url = "https://jsonplaceholder.typicode.com/users";

        try {
            
            //
            $resources = curl_init($url);

            curl_setopt($resources, CURLOPT_RETURNTRANSFER, true);

            $users = curl_exec($resources);

            $response->getBody()->write($users);

           return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(200);

       } catch (PDOException $e) {
           $error = [
               "message" => $e->getMessage()
           ];

           $response->getBody()->write(json_encode($error));

           return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(500);
       }
    });

    // Get SPECIFIC Data by id
    $app->get('/friends/{id}', function (Request $request, Response $response, array $args) {
        $id = $args['id'];

        $url = "https://jsonplaceholder.typicode.com/users/$id";

        try {
            $resources = curl_init($url);

            curl_setopt($resources, CURLOPT_RETURNTRANSFER, true);

            $users = curl_exec($resources);

           $response->getBody()->write(json_encode($users));

            return $response
                ->withHeader('content-type', 'application/json')
                ->withStatus(200);
        } catch(PDOException $e) {
            $error = array(
                "message" => $e->getMessage()
            );

            return $response
                ->withHeader("content-type", "application/json")
                ->withStatus(500);
        }
    });

    /**
     * 
     * VERSION REQUETE SQL 
     * 
     * NB: Vous pouvez decommenter la section ci-dessous et confgurer selon l'emplacement de votre serveur sql ou nosql
     * 
    **/ 

    // Get All Friends data from 'sql request'
    // $app->get('/friends/all', function (Request $request, Response $response) {
    //     $sql = "SELECT * FROM friends";

    //    try {
    //        $db = new DB();
    //        $conn = $db->connect();

    //        $statement = $conn->query($sql);

    //        $friends = $statement->fetchAll(PDO::FETCH_OBJ);

    //        $db = null;

    //        $response->getBody()->write(json_encode($friends));

    //        return $response
    //         ->withHeader('content-type', 'application/json')
    //         ->withStatus(200);

    //    } catch (PDOException $e) {
    //        $error = [
    //            "message" => $e->getMessage()
    //        ];

    //        $response->getBody()->write(json_encode($error));

    //        return $response
    //         ->withHeader('content-type', 'application/json')
    //         ->withStatus(500);
    //    }
    // });

    // Get Friends Data by id
    // $app->get('/friends/{id}', function (Request $request, Response $response, array $args) {
    //     $id = $args['id'];

    //     $sql = "SELECT * FROM friends WHERE id = $id";

    //     try {
    //         $db = new DB();
    //         $conn = $db->connect();

    //         $statement = $conn->query($sql);

    //         $friendId = $statement->fetchAll(PDO::FETCH_OBJ);

    //         $db = null;

    //         $response->getBody()->write(json_encode($friendId));

    //         return $response
    //             ->withHeader('content-type', 'application/json')
    //             ->withStatus(200);
    //     } catch(PDOException $e) {
    //         $error = array(
    //             "message" => $e->getMessage()
    //         );

    //         return $response
    //             ->withHeader("content-type", "application/json")
    //             ->withStatus(500);
    //     }
    // });

    // $app->post('/friends/add', function (Request $request, Response $response) {
    //     $email = $request->getParam('email');
    //     $displayName = $request->getParam('display_name');
    //     $phone = $request->getParam('phone');
        
    //     $sql = "INSERT INTO friends (email, display_name, phone) VALUE (:email, :display_name, :phone)";

    //     try {
                
    //         $db = new DB();
    //         $conn = $db->connect();

    //         $statement = $conn->prepare($sql);
    //         $statement->bindParam(':email', $email);
    //         $statement->bindParam(':display_name', $displayName);
    //         $statement->bindParam(':phone', $phone);

    //         $result = $statement->execute();

    //         $db = null;

    //         $response->getBody()->write(json_encode($result));
    //         return $response
    //             ->withHeader('content-type', 'application/json')
    //             ->withStatus(200);

    //     } catch(PDOException $e) {
    //         $error = array(
    //             "message" => $e->getMessage()
    //         );

    //         return $response
    //             ->withHeader('content-type', 'application/json')
    //             ->withStatus(500);
    //     }
    // });