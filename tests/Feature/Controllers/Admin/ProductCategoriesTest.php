<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Products\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_categories_index_page(): void
    {
        $response = $this->get(route('admin.product-categories.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.product-categories.index');
        $response->assertViewHas(['categories']);
    }

    /** @test */
    public function it_has_a_create_category_page(): void
    {
        $response = $this->get(route('admin.product-categories.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.product-categories.create');
    }

    /** @test */
    public function it_can_create_a_category(): void
    {
        $this->withoutExceptionHandling();
        $data = factory(Category::class)->raw();
        $response = $this->post(route('admin.product-categories.store'), $data);

        // Assert the record is created, the site redirects and a success message is sent
        $this->assertDatabaseHas('product_categories', [
            'name' => $data['name']
        ]);
        $response->assertRedirect(route('admin.product-categories.index'));
        $response->assertSessionHas('success');
    }

    /** @test */
    public function it_can_display_a_single_category(): void
    {
        $category = factory(Category::class)->create();

        $response = $this->get(route('admin.product-categories.show', $category));

        $response->assertStatus(200);
        $response->assertViewIs('admin.product-categories.show');
        $response->assertViewHas('category');
    }

    /** @test */
    public function it_has_an_edit_page(): void
    {
        $category = factory(Category::class)->create();

        $response = $this->get(route('admin.product-categories.edit', $category));

        $response->assertStatus(200);
        $response->assertViewIs('admin.product-categories.edit');
        $response->assertViewHas('category');
    }

    /** @test */
    public function it_can_update_a_category(): void
    {
        $category = factory(Category::class)->create();

        $response = $this->patch(route('admin.product-categories.update', $category), [
            'name' => 'New Category Name'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    /** @test */
    public function it_can_delete_a_category(): void
    {
        $category = factory(Category::class)->create();

        $response = $this->delete(route('admin.product-categories.destroy', $category));

        $response->assertRedirect(route('admin.product-categories.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('product_categories', [
            'name' => $category->name
        ]);
    }
}
