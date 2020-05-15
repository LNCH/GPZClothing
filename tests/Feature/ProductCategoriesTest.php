<?php

namespace Tests\Feature;

use App\Models\Products\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_category_has_a_name(): void
    {
        $category = factory(Category::class)->create(['name' => 'Hoodies']);

        $this->assertEquals('Hoodies', $category->name);
    }

    /** @test */
    public function a_product_category_has_a_description(): void
    {
        $category = factory(Category::class)->create(['description' => 'Test category description']);

        $this->assertEquals('Test category description', $category->description);
    }

    /** @test */
    public function a_product_category_has_a_status(): void
    {
        $category = factory(Category::class)->create(['status' => Category::STATUS_ACTIVE]);

        $this->assertEquals(Category::STATUS_ACTIVE, $category->status);
    }
}
