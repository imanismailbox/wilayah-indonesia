<?php

namespace Karomap\Indonesia\Models\Extended;

use Laravolt\Support\Traits\AutoFilter;
use Laravolt\Support\Traits\AutoSort;

class Kelurahan extends \Karomap\Indonesia\Models\Kelurahan
{
    use AutoFilter;
    use AutoSort;

    protected $table = 'villages';
}
