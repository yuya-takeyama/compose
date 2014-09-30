<?php
namespace yuyat;

function compose(/* functions to compose */)
{
    $functions = array_reverse(func_get_args());
    $initial = array_shift($functions);

    return array_reduce($functions, function ($f, $g) {
        return function ($x) use ($f, $g) {
            return $g($f($x));
        };
    }, $initial);
}
