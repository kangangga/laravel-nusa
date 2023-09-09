<?php

namespace Creasi\Tests\Features;

use PHPUnit\Framework\Attributes\DependsOnClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

#[Group('api')]
#[Group('districts')]
class DistrictTest extends TestCase
{
    protected $path = 'nusa/districts';

    protected $fields = ['code', 'name', 'regency_code', 'province_code'];

    #[Test]
    #[DependsOnClass(RegencyTest::class)]
    public function it_shows_available_districts()
    {
        $response = $this->getJson($this->path);

        $response->assertOk()->assertJsonStructure([
            'data' => [$this->fields],
        ]);
    }

    #[Test]
    public function it_shows_districts_by_search_query()
    {
        $response = $this->getJson($this->path(query: [
            'search' => 'Pekalongan',
        ]));

        $response->assertOk()->assertJsonCount(5, 'data');
    }

    #[Test]
    public function it_shows_single_district()
    {
        $response = $this->getJson($this->path('337503'));

        $response->assertOk()->assertJsonStructure([
            'data' => $this->fields,
        ]);
    }

    #[Test]
    public function it_shows_available_villages_in_a_district()
    {
        $response = $this->getJson($this->path('337503/villages'));

        $response->assertOk()->assertJsonStructure([
            'data' => [$this->fields],
        ]);
    }
}
