<?php

namespace Badak\Indonesia\Models\Extended;

use Badak\Support\Traits\AutoFilter;
use Badak\Support\Traits\AutoSort;

class Provinsi extends \Badak\Indonesia\Models\Provinsi
{
    use AutoFilter;
    use AutoSort;

    protected $table = 'provinsi';
}
