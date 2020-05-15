<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Products\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_an_index_of_all_categories(): void
    {
        $response = $this->get(route('admin.product-categories.index'));
        $response->assertStatus(200);
    }

    /** @test */
    public function the_index_page_returns_the_correct_view(): void
    {
        $response = $this->get(route('admin.product-categories.index'));
        $response->assertViewIs('admin.product-categories.index');
    }

    /** @test */
    public function the_index_page_has_a_collection_of_categories(): void
    {
        $categories = factory(Category::class, 5)->create();

        $response = $this->get(route('admin.product-categories.index'));
        $response->assertViewHas(['categories']);
    }
}
