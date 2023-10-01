<?php

namespace Creasi\Tests\Features;

use PHPUnit\Framework\Attributes\DependsOnClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

#[Group('api')]
#[Group('villages')]
class VillageTest extends TestCase
{
    protected $path = 'nusa/villages';

    protected $fields = [
        'code',
        'name',
        'district_code',
        'regency_code',
        'province_code',
        'postal_code',
    ];

    #[Test]
    #[DependsOnClass(DistrictTest::class)]
    public function it_shows_available_villages()
    {
        $response = $this->getJson($this->path);

        $response->assertOk()->assertJsonStructure([
            'data' => [$this->fields],
            'links' => ['first', 'last', 'prev', 'next'],
            'meta' => ['current_page', 'from', 'last_page', 'links', 'path', 'per_page', 'to', 'total'],
        ]);
    }

    #[Test]
    public function it_shows_villages_by_selected_codes()
    {
        $response = $this->getJson($this->path(query: [
            'codes' => [3375031004, 3375031006],
        ]));

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    #[Test]
    public function it_shows_errors_when_codes_item_is_not_numeric()
    {
        $response = $this->getJson($this->path(query: [
            'codes' => ['foo'],
        ]));

        $response->assertUnprocessable();
    }

    #[Test]
    public function it_shows_errors_when_codes_is_not_an_array()
    {
        $response = $this->getJson($this->path(query: [
            'codes' => 33,
        ]));

        $response->assertUnprocessable();
    }

    #[Test]
    public function it_shows_villages_by_search_query()
    {
        $response = $this->getJson($this->path(query: [
            'search' => 'Padukuhan Kraton',
        ]));

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    #[Test]
    public function it_shows_single_village()
    {
        $response = $this->getJson($this->path('3375031006'));

        $response->assertOk()->assertJsonStructure([
            'data' => $this->fields,
        ]);
    }
}