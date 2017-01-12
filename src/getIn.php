<?php

declare(strict_types = 1);

namespace Prelude;

const getIn = __NAMESPACE__.'\getIn';

function getIn(array $xss)
{
    return function (array $ks, $notfound = false) use ($xss) {
        if (!isset($ks[0])) {
            return $notfound;
        }

        $xs = get($xss)(head($ks), $notfound);
        
        return is_array($xs)
            ? getIn($xs)(tail($ks), $notfound)
            : $xs;
    };
}
