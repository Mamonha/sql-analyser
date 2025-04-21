<?php

class RequestValidator
{
    public static function validateSqlQuery(array $input, bool $allowMethods): string
    {
        if (!isset($input['query']) || empty(trim($input['query']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Query SQL não fornecida']);
            exit;
        }

        $query = trim($input['query']);

        if ($allowMethods && preg_match('/^(INSERT|UPDATE|DELETE|DROP|ALTER|TRUNCATE|CREATE|REPLACE)/i', $query)) {
            http_response_code(403);
            echo json_encode(['error' => 'Apenas queries SELECT são permitidas']);
            exit;
        }

        return $query;
    }
}
