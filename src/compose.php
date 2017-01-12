<?php

declare(strict_types = 1);

namespace Prelude;

const compose = __NAMESPACE__.'\compose';

/**
 * Performs right-to-left function composition.
 * The rightmost function may have any arity; the remaining functions must be unary.
 */
function compose(callable ...$args)
{
    return pipe(...array_reverse($args));
}
