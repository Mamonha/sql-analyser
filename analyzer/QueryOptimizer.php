<?php

class QueryOptimizer {
    private $pdo;
    
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function analyze(string $query): array {
        $stmt = $this->pdo->prepare("EXPLAIN $query");
        $stmt->execute();
        $explainResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $alerts = [];
        foreach ($explainResults as $result) {
            if ($result['key'] === null) {
                $alerts[] = "⚠️ Nenhum índice usado na tabela {$result['table']} - Considere adicionar um índice";
            }
            if ($result['type'] === 'ALL') {
                $alerts[] = "🚨 FULL TABLE SCAN na tabela {$result['table']} - Otimização urgente necessária!";
            }
            if (strpos($result['Extra'] ?? '', 'filesort') !== false) {
                $alerts[] = "⚠️ Ordenação ineficiente (filesort) na tabela {$result['table']}";
            }
        }
        return [
            'alerts' => $alerts,
            'query' => $query,
            'explain' => $explainResults,
            'data' => $explainResults
        ];
    }
}