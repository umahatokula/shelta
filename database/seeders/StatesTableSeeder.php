<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        State::truncate();

        \DB::statement("INSERT INTO `states` (`id`, `country_id`, `name`) VALUES
        (1, 47, 'Abia'),
        (2, 47, 'Adamawa'),
        (3, 47, 'Akwa Ibom'),
        (4, 47, 'Anambra'),
        (5, 47, 'Bauchi'),
        (6, 47, 'Bayelsa'),
        (7, 47, 'Benue'),
        (8, 47, 'Borno'),
        (9, 47, 'Cross River'),
        (10, 47, 'Delta'),
        (11, 47, 'Ebonyi'),
        (12, 47, 'Edo'),
        (13, 47, 'Ekiti'),
        (14, 47, 'Enugu'),
        (15, 47, 'FCT'),
        (16, 47, 'Gombe'),
        (17, 47, 'Imo'),
        (18, 47, 'Jigawa'),
        (19, 47, 'Kaduna'),
        (20, 47, 'Kano'),
        (21, 47, 'Katsina'),
        (22, 47, 'Kebbi'),
        (23, 47, 'Kogi'),
        (24, 47, 'Kwara'),
        (25, 47, 'Lagos'),
        (26, 47, 'Nasarawa'),
        (27, 47, 'Niger'),
        (28, 47, 'Ogun'),
        (29, 47, 'Ondo'),
        (30, 47, 'Osun'),
        (31, 47, 'Oyo'),
        (32, 47, 'Plateau'),
        (33, 47, 'Rivers'),
        (34, 47, 'Sokoto'),
        (35, 47, 'Taraba'),
        (36, 47, 'Yobe'),
        (37, 47, 'Zamfara');");

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
