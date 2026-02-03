<?php

declare(strict_types=1);

namespace Wuriyanto\PhpPbkdf2\Tests;

use PHPUnit\Framework\TestCase;
use Wuriyanto\PhpPbkdf2\PBKDF2;

final class PBKDF2Test extends TestCase
{

    public function testHashAndVerify(): void
    {
        $pbkdf2 = PBKDF2::create('sha256', 16, 32, 1000);
        $password = 'secure_password';

        $hash = $pbkdf2->hash($password);
        
        $this->assertIsString($hash);

        $isValid = $pbkdf2->verify($password, $hash);
        $this->assertTrue($isValid);

        $isInvalid = $pbkdf2->verify('wrong_password', $hash);
        $this->assertFalse($isInvalid);
    }

    public function testVerifyFromHash1(): void
    {
        $pbkdf2 = PBKDF2::create('sha1', 8, 32, 15000);

        $hash = 'lPeWBK4RMSg=|Z0IUQ+7lIm+EiQotZd3/53StMUIfToYZuhyzMAjMqe0=';
        $password = '123456';

        $isValid = $pbkdf2->verify($password, $hash);
        $this->assertTrue($isValid);
    }

}
