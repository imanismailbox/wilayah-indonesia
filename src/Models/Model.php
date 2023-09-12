<?php

namespace Karomap\Indonesia\Models;

class Model extends \Illuminate\Database\Eloquent\Model
{
    protected $keyType = 'string';

    protected $searchableColumns = ['kode', 'nama'];

    protected $guarded = [];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('wilayah-indonesia.table_prefix') . $this->table;
        $this->primaryKey = 'kode';
        $this->appends = ['address'];
    }

    public function scopeSearch($query, $keyword)
    {
        if ($keyword && $this->searchableColumns) {
            $query->whereLike($this->searchableColumns, $keyword);
        }
    }
}
