<?php

require_once __DIR__ . '/../../analyzer/InjectionChecker.php';
require_once __DIR__ . '/../../middleware/RequestValidator.php';
$input = json_decode(file_get_contents('php://input'), true);

$query = RequestValidator::validateSqlQuery($input, false);

try {
    $checker = new InjectionChecker($query);

    if ($checker->isVulnerable()) {
        echo json_encode([
            'false' => 'Query suspeita de SQL Injection',
            'original_query' => $query,
            'safe_query' => $checker->getSanitizedQuery()
        ]);
        exit;
    }
    echo json_encode([
        'true' => 'Query segura livre de injeção!',
        'original_query' => $query
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => 'Erro na análise da query',
        'details' => $e->getMessage()
    ]);
}
