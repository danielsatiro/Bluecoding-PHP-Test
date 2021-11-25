<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\ShortUrl;

class ShortUrlTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testEncodeSuccess()
    {
        $code = ShortUrl::encode(123);
        $this->assertEquals('adp', $code);
    }

    public function testDecodeSuccess()
    {
        $id = ShortUrl::decode('adp');
        $this->assertEquals(123, $id);
    }
}
