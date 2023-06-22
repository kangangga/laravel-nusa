<?php

declare(strict_types=1);

namespace Creasi\Nusa\Models;

/**
 * @property-read string $code
 * @property-read string $name
 */
class Province extends Model
{
    protected $fillable = ['code', 'name'];

    protected $casts = [];

    public function getTable()
    {
        return config('creasi.nusa.table_names.provinces', parent::getTable());
    }
}
