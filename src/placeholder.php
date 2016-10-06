<?php

namespace Prelude;

const placeholder = __NAMESPACE__.'\placeholder';

function placeholder(callable $fn, ...$ps)
{
    $ks = pipe(filter(equals(_)), keys)($ps);

    $throw = function () {
        throw new \InvalidArgumentException();
    };

    $success = function (...$args) use ($fn, $ps, $ks) {
        $args = pipe(flip, map(get($args)), replace($ps))($ks);
        return $fn(...$args);
    };

    return ifElse(equals([]), $throw, always($success))($ks);
}
