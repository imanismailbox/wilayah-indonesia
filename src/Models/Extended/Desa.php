<?php

namespace Badak\Indonesia\Models\Extended;

use Badak\Support\Traits\AutoFilter;
use Badak\Support\Traits\AutoSort;

class Desa extends \Badak\Indonesia\Models\Desa
{
    use AutoFilter;
    use AutoSort;

    protected $table = 'desa';
}
