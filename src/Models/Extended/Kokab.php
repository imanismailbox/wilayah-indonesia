<?php

namespace Badak\Indonesia\Models\Extended;

use Badak\Support\Traits\AutoFilter;
use Badak\Support\Traits\AutoSort;

class Kokab extends \Badak\Indonesia\Models\Kokab
{
    use AutoFilter;
    use AutoSort;

    protected $table = 'kokab';
}
