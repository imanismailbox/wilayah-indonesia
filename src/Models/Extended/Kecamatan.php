<?php

namespace Karomap\Indonesia\Models\Extended;

use Laravolt\Support\Traits\AutoFilter;
use Laravolt\Support\Traits\AutoSort;

class Kecamatan extends \Karomap\Indonesia\Models\Kecamatan
{
    use AutoFilter;
    use AutoSort;

    protected $table = 'districts';
}
