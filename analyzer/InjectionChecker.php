<?php

class InjectionChecker {
    private string $query;
    private array $suspiciousPatterns;
 
    public function __construct(string $query) {
        $this->query = trim($query);
    }

    public function isVulnerable(): bool {
        $this->suspiciousPatterns = [
            "/--|#/",

            "/\b(UNION\s+SELECT)\b/i",
            "/\b(DROP|DELETE|INSERT|UPDATE|REPLACE|TRUNCATE|ALTER)\b/i",

            "/\b(OR|AND)\b\s+\d+=\d+/i",
            "/\b(OR|AND)\b\s+['\"]?.+['\"]?\s*=\s*['\"]?.+['\"]?/i",

            "/['\"]\s*(OR|AND)\s*['\"]?\d+=\d+/i",
        ];

        foreach ($this->suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $this->query)) {
                return true;
            }
        }
        return false;
    }

    public function getSanitizedQuery(): string {
        $sanitized = $this->query;
        foreach ($this->suspiciousPatterns as $pattern) {
            $sanitized = preg_replace($pattern,'',$sanitized);
        }
        return trim($sanitized);
    }
}