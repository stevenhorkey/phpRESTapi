<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Api Get route
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    // Logging
    $this->logger->addInfo('hello'.$name);
    return $response;
});

// Get all customers
$app->get('/customers', function (Request $request, Response $response, array $args) {
    // echo 'CUSTOMERS';
    $sql = 'SELECT * FROM customers';

    try{
        // Get db object
        $db = new db();
        // Connect
        $db = $db->connect();
        // Set statement
        $stmt = $db->query($sql);
        // Fetch all customers using query statement
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;
        // echo json of all customers
        echo json_encode($customers);
    } catch(PDOException $e) {
        echo '{
            "error": {
                "text": {
                    ".$e->getMessage()."
                }
            }
        }';
    }
});

// Get one customer
$app->get('/customer/{id}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');
    // echo 'CUSTOMERS';
    $sql = "SELECT * FROM customers WHERE id = $id";

    try{
        // Get db object
        $db = new db();
        // Connect
        $db = $db->connect();
        // Set statement
        $stmt = $db->query($sql);
        // Fetch all customers using query statement
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;
        // echo json of all customers
        echo json_encode($customer);
    } catch(PDOException $e) {
        echo '{
            "error": {
                "text": {
                    ".$e->getMessage()."
                }
            }
        }';
    }
});

// // Add a customer
// $app->post('/customer/add', function (Request $request, Response $response, array $args) {
//     $id = $request->getAttribute('id');
//     // echo 'CUSTOMERS';
//     $sql = "SELECT * FROM customers WHERE id = $id";

//     try{
//         // Get db object
//         $db = new db();
//         // Connect
//         $db = $db->connect();
//         // Set statement
//         $stmt = $db->query($sql);
//         // Fetch all customers using query statement
//         $customer = $stmt->fetchAll(PDO::FETCH_OBJ);

//         $db = null;
//         // echo json of all customers
//         echo json_encode($customer);
//     } catch(PDOException $e) {
//         echo '{
//             "error": {
//                 "text": {
//                     ".$e->getMessage()."
//                 }
//             }
//         }';
//     }
// });




?>