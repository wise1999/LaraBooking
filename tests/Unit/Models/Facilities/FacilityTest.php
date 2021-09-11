<?php

namespace Tests\Unit\Models\Facilities;

use App\Models\Category;
use App\Models\Facility;
use Tests\TestCase;

class FacilityTest extends TestCase
{

    public function test_it_has_category()
    {
        $facility = Facility::factory()->create();

        $facility->category()->save(
            Category::factory()->create()
        );

        $this->assertInstanceOf(Category::class, $facility->category->first());
    }

    public function test_it_returns_formatted_price() {
        $product = Facility::factory()->create([
            'price' => 1000
        ]);

        $this->assertSame($product->formattedPrice, '$10.00');
    }
}
