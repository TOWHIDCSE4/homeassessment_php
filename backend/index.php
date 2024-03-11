<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once 'Database.php';

require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();

$app->add(function (Request $request, $handler) use ($responseFactory) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello, this is the home page!");
    return $response;
});

$app->get('/api/blogs', function (Request $request, Response $response) {
    $db = new Database(); 
    $conn = $db->getConnection();

    $query = "SELECT * FROM posts";
    $result = pg_query($conn, $query);

    if (!$result) {
        echo "Error when mining data!";
        exit;
    }

    $results = array();
    while ($row = pg_fetch_assoc($result)) {
        $results[] = $row;
    }

    $response->getBody()->write(json_encode($results));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/api/blogs', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $title = $data['title'];
    $body = $data['body'];

    $db = new Database();
    $conn = $db->getConnection();

    $query = "INSERT INTO posts (title, body) VALUES ('$title', '$body')";

    $result = pg_query($conn, $query);

    if ($result) {
        $responseBody = json_encode(array('success' => true, 'message' => 'Post created successfully'));
        $response->getBody()->write($responseBody);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    } else {
        $responseBody = json_encode(array('success' => false, 'message' => 'Failed to create post'));
        $response->getBody()->write($responseBody);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});


$app->run();
