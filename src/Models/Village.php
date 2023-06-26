<?php

declare(strict_types=1);

namespace Creasi\Nusa\Models;

use Creasi\Nusa\Contracts\Village as VillageContract;

/**
 * @property-read Province $province
 * @property-read Regency $regency
 * @property-read District $district
 */
class Village extends Model implements VillageContract
{
    protected $fillable = ['district_code', 'regency_code', 'province_code', 'postal_code'];

    protected $casts = [
        'district_code' => 'int',
        'regency_code' => 'int',
        'province_code' => 'int',
        'postal_code' => 'int',
    ];

    public function getTable()
    {
        return config('creasi.nusa.table_names.villages', parent::getTable());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Province
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Regency
     */
    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|District
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
