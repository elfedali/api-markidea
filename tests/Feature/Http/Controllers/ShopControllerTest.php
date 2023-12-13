<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Owner;
use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ShopController
 */
final class ShopControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $shops = Shop::factory()->count(3)->create();

        $response = $this->get(route('shop.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ShopController::class,
            'store',
            \App\Http\Requests\ShopStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $owner = Owner::factory()->create();
        $name = $this->faker->name();
        $description = $this->faker->text();
        $is_active = $this->faker->boolean();

        $response = $this->post(route('shop.store'), [
            'owner_id' => $owner->id,
            'name' => $name,
            'description' => $description,
            'is_active' => $is_active,
        ]);

        $shops = Shop::query()
            ->where('owner_id', $owner->id)
            ->where('name', $name)
            ->where('description', $description)
            ->where('is_active', $is_active)
            ->get();
        $this->assertCount(1, $shops);
        $shop = $shops->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $shop = Shop::factory()->create();

        $response = $this->get(route('shop.show', $shop));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ShopController::class,
            'update',
            \App\Http\Requests\ShopUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $shop = Shop::factory()->create();
        $owner = Owner::factory()->create();
        $name = $this->faker->name();
        $description = $this->faker->text();
        $is_active = $this->faker->boolean();

        $response = $this->put(route('shop.update', $shop), [
            'owner_id' => $owner->id,
            'name' => $name,
            'description' => $description,
            'is_active' => $is_active,
        ]);

        $shop->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($owner->id, $shop->owner_id);
        $this->assertEquals($name, $shop->name);
        $this->assertEquals($description, $shop->description);
        $this->assertEquals($is_active, $shop->is_active);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $shop = Shop::factory()->create();

        $response = $this->delete(route('shop.destroy', $shop));

        $response->assertNoContent();

        $this->assertModelMissing($shop);
    }
}
