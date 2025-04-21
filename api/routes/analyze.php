<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../analyzer/QueryOptimizer.php';
require_once __DIR__ . '/../../middleware/RequestValidator.php';

$input = json_decode(file_get_contents('php://input'), true);

$query = RequestValidator::validateSqlQuery($input, true);

try {
    $pdo = Database::getInstance();
    $optimizer = new QueryOptimizer($pdo);
    $analysis = $optimizer->analyze($query);

    echo json_encode([
        $analysis
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => 'Erro na análise da query',
        'details' => $e->getMessage()
    ]);
}
