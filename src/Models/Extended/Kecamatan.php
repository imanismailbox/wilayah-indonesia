<?php

namespace Badak\Indonesia\Models\Extended;

use Badak\Support\Traits\AutoFilter;
use Badak\Support\Traits\AutoSort;

class Kecamatan extends \Badak\Indonesia\Models\Kecamatan
{
    use AutoFilter;
    use AutoSort;

    protected $table = 'kecamatan';
}
