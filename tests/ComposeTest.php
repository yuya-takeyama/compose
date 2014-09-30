<?php
namespace yuyat;

require_once __DIR__ . '/../src/compose.php';

class ComposeTest extends \PHPUnit_Framework_TestCase
{
    public function test_compose_two_functions()
    {
        $plusOne = function ($x) {
            return $x + 1;
        };
        $double = function ($x) {
            return $x * 2;
        };
        $plusOneAndDouble = compose($double, $plusOne);

        $this->assertSame(8, $plusOneAndDouble(3));
    }

    public function test_compose_many_functions()
    {
        $splitAsWords = function ($str) {
            return \preg_split('/\s+/u', $str);
        };
        $camelizeWords = function ($words) {
            return \array_map('ucfirst', $words);
        };
        $join = function ($words) {
            return \join('', $words);
        };
        $lowerCamelize = compose('lcfirst', $join, $camelizeWords, $splitAsWords);

        $this->assertSame('fooBarBaz', $lowerCamelize('foo bar baz'));
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function test_invalid_argument()
    {
        compose(function ($x) { return $x; }, 'invalid argument');
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage at least two functions are required
     */
    public function test_arguments_shortage()
    {
        compose(function ($x) { return $x; });
    }
}
