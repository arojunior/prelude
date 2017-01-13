<?php

declare(strict_types = 1);

namespace Prelude;

const indexOf = __NAMESPACE__.'\indexOf';

function indexOf($needle)
{
    return function (array $haystack, bool $strict = false) use ($needle) {
        return array_search($needle, $haystack, $strict);
    };
}
