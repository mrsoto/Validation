<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Max
 * @covers Respect\Validation\Exceptions\MaxException
 */
class MaxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidMax
     */
    public function testValidMaxInputShouldReturnTrue($maxValue, $inclusive, $input)
    {
        $max = new Max($maxValue, $inclusive);
        $this->assertTrue($max->validate($input));
        $this->assertTrue($max->check($input));
        $this->assertTrue($max->assert($input));
    }

    /**
     * @dataProvider providerForInvalidMax
     * @expectedException Respect\Validation\Exceptions\MaxException
     */
    public function testInvalidMaxValueShouldThrowMaxException($maxValue, $inclusive, $input)
    {
        $max = new Max($maxValue, $inclusive);
        $this->assertFalse($max->validate($input));
        $this->assertFalse($max->assert($input));
    }

    public function providerForValidMax()
    {
        return array(
            array(200, false, ''),
            array(200, false, 165.0),
            array(200, false, -200),
            array(200, true, 200),
            array(200, false, 0),
            array('-18 years', true, '1988-09-09'),
            array('z', true, 'z'),
            array('z', false, 'y'),
            array('tomorrow', true, 'now'),
        );
    }

    public function providerForInvalidMax()
    {
        return array(
            array(200, false, 300),
            array(200, false, 250),
            array(200, false, 1500),
            array(200, false, 200),
        );
    }
}
