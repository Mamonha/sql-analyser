<?php

class InjectionChecker {
    public static function isVulnerable(string $query): bool {
        $patterns = [
            "/'.*--/", 
            "/\b(UNION\b.*\bSELECT\b)/i",
            "/\b(DROP\b|\bDELETE\b|\bINSERT\b)/i"
        ];
        
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $query)) {
                return true;
            }
        }
        return false;
    }
}