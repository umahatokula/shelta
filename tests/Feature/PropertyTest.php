<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTest {

    use RefreshDatabase;


    public function test_a_user_can_be_created_and_unlocks_beginner_badge()
    {
        // run seeders
        $this->seed();

        $property = Property::factory()->create();

        $this->assertCount(1, Property::all());

        $dueDate = $property->nextPaymentDueDate();

        $this->assertEquals($property->date_of_first_payment->addMonth(), $dueDate);
    }
}
