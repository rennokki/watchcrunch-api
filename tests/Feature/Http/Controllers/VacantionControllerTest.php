<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Vacantion;
use Tests\TestCase;

class VacantionControllerTest extends TestCase
{
    public function test_index_works_without_filters()
    {
        /** @var Vacantion $vacantion */
        $vacantion = Vacantion::factory()->create([
            'start' => now(),
            'end' => now()->addDays(7),
            'price' => 100.00,
        ]);

        $this->getJson(route('vacantion.index'))
            ->assertJsonCount(1);
    }

    public function test_index_with_filters()
    {
        /** @var Vacantion $vacantion */
        $vacantion = Vacantion::factory()->create([
            'start' => now(),
            'end' => now()->addDays(7),
            'price' => 100.00,
        ]);

        $this->getJson(route('vacantion.index', [
            'price[eq]' => 100,
        ]))->assertJsonCount(1);

        $this->getJson(route('vacantion.index', [
            'price[eq]' => 101,
        ]))->assertJsonCount(0);
    }

    public function test_show_vacantion()
    {
        /** @var Vacantion $vacantion */
        $vacantion = Vacantion::factory()->create([
            'start' => now(),
            'end' => now()->addDays(7),
            'price' => 100.00,
        ]);

        $this->getJson(route('vacantion.show', ['vacantion' => $vacantion]))
            ->assertJsonFragment($vacantion->only([
                'id',
                'start',
                'end',
                'price',
            ]));
    }

    public function test_create_vacantion()
    {
        /** @var Vacantion $vacantionStub */
        $vacantionStub = Vacantion::factory()->make([
            'start' => now(),
            'end' => now()->addDays(7),
            'price' => 100.00,
        ]);

        $this->postJson(route('vacantion.store'), $vacantionStub->only(['start', 'end', 'price']))
            ->assertCreated();

        /** @var Vacantion $vacantion */
        $this->assertNotNull(
            $vacantion = Vacantion::first()
        );

        $this->assertTrue($vacantion->is($vacantion));
    }

    public function test_update_vacantion()
    {
        /** @var Vacantion $vacantion */
        $vacantion = Vacantion::factory()->create([
            'start' => now(),
            'end' => now()->addDays(7),
            'price' => 100.00,
        ]);

        $newData = [
            'start' => now()->addDays(1),
            'end' => now()->addDays(10),
            'price' => 50.0,
        ];

        $this->patchJson(route('vacantion.update', ['vacantion' => $vacantion]), $newData)
            ->assertJsonFragment([
                'id' => $vacantion->id,
            ]);

        $updatedVacantion = $vacantion->fresh();

        $this->assertTrue(
            $vacantion->fill($newData)->is($updatedVacantion)
        );
    }

    public function test_delete_vacantion()
    {
        /** @var Vacantion $vacantion */
        $vacantion = Vacantion::factory()->create([
            'start' => now(),
            'end' => now()->addDays(7),
            'price' => 100.00,
        ]);

        $this->deleteJson(route('vacantion.destroy', ['vacantion' => $vacantion]))
            ->assertOk();

        $this->assertNull(Vacantion::find($vacantion->id));
    }
}
