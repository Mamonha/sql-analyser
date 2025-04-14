<?php

class Benchmark {
    public static function measure(callable $query, int $iterations = 1000): float {
        $start = microtime(true);
        for ($i = 0; $i < $iterations; $i++) {
            $query();
        }
        return (microtime(true) - $start) * 1000;
    }
}