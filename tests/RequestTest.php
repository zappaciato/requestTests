<?php

namespace Kris\TestProject\tests;

use Kris\TestProject\Classes\Request;
use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase {

    public function statusCodeMessageTest($e)
    {   
        $e = 404;
        $request = new Request();
        $request->sendRqs();
        $this->assertSame(1, 1);
        $this->assertEqual('1', 1);

        // $this->assertSame('John', $user->name);
        // $this->assertSame(18, $user->age);
        // $this->assertEmpty($user->favorite_movies);
    }

    public function culrPOSTRqs() {
        $this->assertEqual(1, True);
    }
}