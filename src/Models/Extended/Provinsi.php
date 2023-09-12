<?php

namespace Itik\Indonesia\Models\Extended;

use Itik\Support\Traits\AutoFilter;
use Itik\Support\Traits\AutoSort;

class Provinsi extends \Itik\Indonesia\Models\Provinsi
{
    use AutoFilter;
    use AutoSort;

    protected $table = 'provinces';
}
