<?php

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$path = parse_url($requestUri, PHP_URL_PATH);
$endpoint = trim(str_replace('/api', '', $path), '/');

$routes = [
    'analyze' => ['POST' => 'routes/analyze.php'],
    'checker'   => ['POST' => 'routes/checker.php'],
    // 'benchmark'    => ['GET'  => 'routes/benchmark.php'],
];

if (isset($routes[$endpoint][$method])) {
    require __DIR__ . '/' . $routes[$endpoint][$method];
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Endpoint não encontrado']);
