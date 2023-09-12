<?php

namespace Itik\Indonesia\Models\Extended;

use Itik\Support\Traits\AutoFilter;
use Itik\Support\Traits\AutoSort;

class Kelurahan extends \Itik\Indonesia\Models\Kelurahan
{
    use AutoFilter;
    use AutoSort;

    protected $table = 'villages';
}
