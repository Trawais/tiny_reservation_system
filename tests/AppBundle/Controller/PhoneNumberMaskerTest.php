<?php

namespace Tests\AppBundle\Controller;

use PHPUnit\Framework\TestCase;
use AppBundle\Service\PhoneNumberMasker;

class PhoneNumberMaskerTest extends TestCase
{
    protected $masker;

    protected function setUp(): void
    {
        $this->masker = new PhoneNumberMasker();
    }

    /**
     * @dataProvider provider
     */
    public function testIndex($input, $expected)
    {
        $res = $this->masker->mask($input);
        $this->assertEquals($expected, $res);
    }

    public function provider()
    {
        return [
            ['Trixie, boc, 702123456', 'Trixie, boc, 702****56'],
            ['Trixie, boc, 702 123 456', 'Trixie, boc, 702 1****56'],
            ['Trixie, boc, +420 702 123 456', 'Trixie, boc, +420 702 1****56'],
            ['Trixie, boc, 702 12 34 56', 'Trixie, boc, 702 12****56'],
        ];
    }
}
