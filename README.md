## wuriyanto/php-pbkdf2

🔐 A simple, secure, and lightweight PBKDF2 password hashing library for PHP.

This library provides a clean API to:
- Hash passwords using **PBKDF2**
- Verify passwords securely
- Generate cryptographically secure random salts
- Protect against timing attacks using `hash_equals`

---

### ✨ Features

- ✅ PBKDF2 via native `hash_pbkdf2`
- 🔐 Secure random salt generation (`random_bytes`)
- 🧪 Fully unit tested with PHPUnit
- 📦 Composer-ready PHP library
- ⚡ Lightweight and dependency-free

---

### 📦 Installation From Github

Add Repository VCS to your `composer.json`'s project

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/wuriyanto48/php-pbkdf2"
    }
  ],
  "require": {
    "wuriyanto48/php-pbkdf2": "dev-master"
  }
}
```

Install
```shell
composer require wuriyanto48/php-pbkdf2:dev-master
```

### 🚀 Usage

```php
use Wuriyanto\PhpPbkdf2\PBKDF2;

$pbkdf2 = PBKDF2::create('sha256', 16, 32, 1000);
$password = 'myPasswordx726@';

try {
    $hash = $pbkdf2->hash($password);
    print($hash . PHP_EOL); // In general, you will store it in a Database.

    $isValid = $pbkdf2->verify($password, $hash);

    print($isValid . PHP_EOL);
} catch (ValueError $e) {
    print('Error: ' . $e->getMessage() . PHP_EOL);
}
```

### 🧠 Hash Format

The generated hash is stored in the following format:

```shell
<base64_salt>|<base64_pbkdf2_hash>
```

Example:
```shell
Ma5lZ4ARqV9qtNsl7hR09g==|j3qb4URxAgqo0xD1Kk1katmsGGRu/c928tGoeUdJGzY=
```

### 🧪 Running Tests
```shell
composer install
vendor/bin/phpunit
```