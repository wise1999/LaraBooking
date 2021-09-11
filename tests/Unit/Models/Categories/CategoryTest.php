<?php

namespace Tests\Unit\Models\Categories;

use App\Models\Category;
use App\Models\Facility;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_many_facilities()
    {
        $category = Category::factory()->create();

        $category->facilities()->save(
            Facility::factory()->create()
        );

        $this->assertInstanceOf(Facility::class, $category->facilities->first());
    }
}
