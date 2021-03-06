<?php

namespace Kraken\Config\Overwrite;

use Kraken\Util\Support\ArraySupport;

class OverwriteReverseMerger
{
    /**
     * @param array $old
     * @param array $new
     * @return array
     */
    public function __invoke($old, $new)
    {
        return ArraySupport::merge([ $new, $old ]);
    }
}
