<?php

class QueryOptimizer {
    private $pdo;
    
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    
    public function analyze(string $query): array {
        $stmt = $this->pdo->prepare("EXPLAIN ANALYZE $query");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}