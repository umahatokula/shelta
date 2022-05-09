<?php

namespace Tests\Feature;

use Carbon\Carbon;
use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PropertyTest {

    use DatabaseTransactions, DatabaseMigrations;


    public function test_a_user_can_be_created_and_unlocks_beginner_badge()
    {

        Event::fake();

        // run seeders
        $this->seed();

        $user = User::factory()->create(); // generate a user

        $property = Property::create([
            'estate_property_type_id' => rand(1, 6),
            'client_id' => rand(1, 100),
            'unique_number' => rand(1000, 9999),
        ]);

        $transaction = Transaction::create([
            'client_id'          => $user->id,
            'property_id'        => $property->id,
            'amount'             => 15000,
            'type'               => 'online',
            'transaction_number' => time(),
            'date'               => Carbon::now(),
            'instalment_date'    => Carbon::now()->addDays(30),
            'recorded_by'        => 1,
            'status'             => 1,
            'is_approved'        => 1,
        ]);

        dd($transaction);

        (new CompletePaymentNotification())->handle(
            new PaymentMade($transaction)
        );


        $numberOfLessonsWatched = $user->watched()->count();
        $unlockedAchievement = LessonAchievementLevel::where('lessons_to_unlock', $numberOfLessonsWatched)->first();

        $this->assertEquals($unlockedAchievement, null);
    }
}
