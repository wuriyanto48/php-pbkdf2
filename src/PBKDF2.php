<?php

declare(strict_types=1);

namespace Wuriyanto\PhpPbkdf2;

class PBKDF2 {

    private string $digest;
    private int $salt_size;
    private int $key_length;
    private int $iterations;

    private function __construct(string $digest, int $salt_size, int $key_length, int $iterations) {
        $this->digest = $digest;
        $this->salt_size = $salt_size;
        $this->key_length = $key_length;
        $this->iterations = $iterations;

    }

    public static function create(
        string $digest = 'sha256', 
        int $salt_size = 16, 
        int $key_length = 32, 
        int $iterations = 1000
    ): PBKDF2 {
        return new self($digest, $salt_size, $key_length, $iterations);
    }

    public function hash(string $password): string {
        $salt = $this->generateSalt();
        $hash = hash_pbkdf2(
            $this->digest, 
            $password, 
            $salt, 
            $this->iterations, 
            $this->key_length, 
            true
        );

        return sprintf('%s|%s', $salt, base64_encode($hash));
    }

    public function verify(string $password, string $hash): bool {
        $parts = explode('|', $hash);
        if (count($parts) !== 2) {
            return false;
        }

        [$saltB64, $hashB64] = $parts;

        $calculated_hash = hash_pbkdf2(
            $this->digest, 
            $password, 
            $saltB64, 
            $this->iterations, 
            $this->key_length, 
            true
        );

        return hash_equals($calculated_hash, base64_decode($hashB64));
    }

    private function generateSalt(): string {
        return base64_encode(random_bytes($this->salt_size));
    }
}