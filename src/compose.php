<?php
namespace yuyat;

function compose(callable ...$functions)
{
    if (count($functions) < 2) {
            throw new \InvalidArgumentException('at least two functions are required');
    }

    $initial = array_shift($functions);

    return array_reduce($functions, function ($f, $g) {
        return function ($x) use ($f, $g) {
            return $f($g($x));
        };
    }, $initial);
}

function pipeline(callable ...$functions)
{
    return compose(...array_reverse($functions));
}
