<?php

namespace Itik\Indonesia\Models\Extended;

use Itik\Support\Traits\AutoFilter;
use Itik\Support\Traits\AutoSort;

class Kecamatan extends \Itik\Indonesia\Models\Kecamatan
{
    use AutoFilter;
    use AutoSort;

    protected $table = 'districts';
}
