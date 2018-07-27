<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Api Get route
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
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
$app->post('/customer/add', function (Request $request, Response $response, array $args) {
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $address = $request->getParam('address');
    $city = $request->getParam('city');
    $state = $request->getParam('state');

    $sql = "INSERT INTO customers (first_name,last_name,phone,email,address,city,state) VALUES (:first_name,:last_name,:phone,:email,:address,:city,:state);";

    try{
        // Get db object
        $db = new db();
        // Connect
        $db = $db->connect();
        // Set statement
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name',  $last_name);
        $stmt->bindParam(':phone',      $phone);
        $stmt->bindParam(':email',      $email);
        $stmt->bindParam(':address',    $address);
        $stmt->bindParam(':city',       $city);
        $stmt->bindParam(':state',      $state);

        $stmt->execute();

        echo '{
            "notice": {
                "text": {
                    "Customer Added"
                }
            }
        }';
    } catch(PDOException $e) {
        echo '{
            "error": {
                "text": {
                    "'.$e->getMessage().'"
                }
            }
        }';
    }
});




?>