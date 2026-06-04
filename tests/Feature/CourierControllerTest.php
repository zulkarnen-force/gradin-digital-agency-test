<?php

namespace Tests\Feature;

use App\Models\Courier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourierControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_couriers(): void
    {
        Courier::factory()->count(15)->create();

        $response = $this->getJson('/api/couriers');

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data',
                'links',
                'meta',
            ]);

        $this->assertCount(
            10,
            $response->json('data')
        );
    }

    public function test_can_filter_by_level(): void
    {
        Courier::factory()->create([
            'level' => '1',
        ]);

        Courier::factory()->create([
            'level' => '2',
        ]);

        $response = $this->getJson(
            '/api/couriers?level=2'
        );

        $response->assertOk();

        $this->assertCount(
            1,
            $response->json('data')
        );

        $this->assertEquals(
            '2',
            $response->json('data.0.level')
        );
    }

    public function test_can_search(): void
    {
        Courier::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        Courier::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
        ]);

        $response = $this->getJson(
            '/api/couriers?search=John'
        );

        $response->assertOk();

        $this->assertCount(
            1,
            $response->json('data')
        );

        $this->assertEquals(
            'John',
            $response->json('data.0.first_name')
        );
    }

    public function test_can_make_courier(): void
    {
        $payload = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'level' => '2',
        ];

        $response = $this->postJson(
            '/api/couriers',
            $payload
        );

        $response
            ->assertCreated()
            ->assertJson([
                'message' => 'Courier created successfully',
            ]);

        $this->assertDatabaseHas(
            'couriers',
            $payload
        );
    }

    public function test_can_get_one_courier(): void
    {
        $courier = Courier::factory()->create();

        $response = $this->getJson(
            "/api/couriers/{$courier->id}"
        );

        $response
            ->assertOk()
            ->assertJsonPath(
                'data.id',
                $courier->id
            );
    }

    public function test_can_update_one_courier(): void
    {
        $courier = Courier::factory()->create([
            'first_name' => 'Old',
        ]);

        $response = $this->putJson(
            "/api/couriers/{$courier->id}",
            [
                'first_name' => 'New',
            ]
        );

        $response->assertOk();

        $this->assertDatabaseHas(
            'couriers',
            [
                'id' => $courier->id,
                'first_name' => 'New',
            ]
        );
    }

    public function test_can_delete_one_courier(): void
    {
        $courier = Courier::factory()->create();

        $response = $this->deleteJson(
            "/api/couriers/{$courier->id}"
        );

        $response
            ->assertOk()
            ->assertJson([
                'message' => 'Courier deleted successfully',
            ]);

        $this->assertDatabaseMissing(
            'couriers',
            [
                'id' => $courier->id,
            ]
        );
    }

    public function test_get_one_courier_returns_404_for_missing_courier(): void
    {
        $this->getJson('/api/couriers/99999')
            ->assertNotFound();
    }

    public function test_update_one_courier_returns_404_for_missing_courier(): void
    {
        $this->putJson(
            '/api/couriers/99999',
            [
                'first_name' => 'John',
            ]
        )->assertNotFound();
    }

    public function test_delete_one_courier_returns_404_for_missing_courier(): void
    {
        $this->deleteJson('/api/couriers/99999')
            ->assertNotFound();
    }
}