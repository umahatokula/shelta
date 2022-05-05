<?php

namespace Tests\Feature;

use App\Models\Property;
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

        $transaction = Transaction::factory()
            ->count(1)
            ->create(); // generate enough lessons to test all levels of achievements dfddf

        foreach ($lessons as $lesson) {

            (new CompletePaymentNotification())->handle(
                new PaymentMade($transaction)
            );

        }

        $numberOfLessonsWatched = $user->watched()->count();
        $unlockedAchievement = LessonAchievementLevel::where('lessons_to_unlock', $numberOfLessonsWatched)->first();

        $this->assertEquals($unlockedAchievement, null);
    }
}
