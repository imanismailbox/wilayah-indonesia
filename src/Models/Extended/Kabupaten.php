<?php

namespace Itik\Indonesia\Models\Extended;

use Itik\Support\Traits\AutoFilter;
use Itik\Support\Traits\AutoSort;

class Kabupaten extends \Itik\Indonesia\Models\Kabupaten
{
    use AutoFilter;
    use AutoSort;

    protected $table = 'cities';
}
