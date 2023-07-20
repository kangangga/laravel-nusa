<?php

declare(strict_types=1);

namespace Creasi\Nusa\Contracts;

/**
 * @property-read int $regency_code
 * @property-read int $province_code
 * @property-read Province $province
 * @property-read Regency $regency
 * @property-read \Illuminate\Support\Collection<int, Village> $villages
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface District
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Province
     */
    public function province();

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Regency
     */
    public function regency();

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Village
     */
    public function villages();
}
