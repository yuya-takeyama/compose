<?php
namespace yuyat;

function compose(/* functions to compose */)
{
    $functions = array_reverse(func_get_args());

    if (count($functions) < 2) {
            throw new \InvalidArgumentException('at least two functions are required');
    }

    foreach ($functions as $f) {
        if (!is_callable($f)) {
            throw new \InvalidArgumentException('all of arguments should be callable');
        }
    }

    $initial = array_shift($functions);

    return array_reduce($functions, function ($f, $g) {
        return function ($x) use ($f, $g) {
            return $g($f($x));
        };
    }, $initial);
}
