<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (env('PHILEOTECH_CLIENT') == 'hall7') {
            PropertyType::create([
                'name' => 'CUBIQ DUPLEX',
                'description' => 'This elegantly designed edifice, stands as an epitome of lifestyle living. This  fully detached duplex features five bedrooms, with two living rooms, a two-car parking garage, a kitchen and dining with ample space and a swimming pool that grants you a resort like experience at the comfort of your own home.'
            ]);
            
            PropertyType::create([
                'name' => 'HEXAGON COURTYARD',
                'description' => 'This is an epitome of style and sophistication. Simply move in and live the lifestyle you’ve always dreamed of in this luxurious cluster homes on two suspended floors. An Impressive array of semi-detached homes creating an open hexagon courtyard. Each community features a state of the art key card security barrier. The Hexagon courtyard features a unique patio which makes for a grand entrance and flows effortlessly into a befittingly spacious living room and dining area that extends into a do all you can large kitchen with an eat-in area. It offers four large bedrooms which are all en-suite. Among its other features is a one bedroom boy’s quarters, a study, box room, store, and a laundry room.

                Some of the units also come with a basement which gives you the perfect space for a more personal touch to your home.This grandeur home comes complete with an elegant lobby,an open courtyard and water features.'
            ]);

            PropertyType::create([
                'name' => 'ARROWHEAD DUPLEXES',
                'description' => 'This elaborately layered and inviting arrow head styled homes are a tease to the senses with an extraordinary first of it’s kind in architectural design, It’s features includes a bespoke kitchen with a eat-in area big enough for any family, a grandeur living room, an ante room, a private study that offers a work from home opportunity, four great sized all en – suite bedrooms, a box room, a store and a laundry room.

                Some of the units offer a basement fit for a game room or cinema, a mini gym, or just for that extra space'
            ]);

            PropertyType::create([
                'name' => 'SUPER-DELUXE VILLA',
                'description' => 'This stylish, private and peaceful townhouse exudes an impressive and luminous ambience. Generously proportioned, it offers dual living & dining options, ample sized kitchen with an open terrace on two suspended floors.

                It is a spacious four bedroom with the possibility of a 5th bedroom, also with 3 parking spaces and an attached boy’s quarter.'
            ]);

            PropertyType::create([
                'name' => 'APARTMENTS',
                'description' => 'The bridge will bring a new dream to your doorsteps every day. Sleep tight tomorrow there will be another dream.'
            ]);

            PropertyType::create([
                'name' => 'DELUXE VILLA',
                'description' => 'Sitting high and enjoying breathtaking views is this well presented family home.

                It features 4 generous bedrooms, 2 separate living areas, large kitchen & dining area,3 parking spaces and an attached boy’s quarters.'
            ]);

            PropertyType::create([
                'name' => 'PEAKED TERRACES',
                'description' => 'This contemporary classic is designed for creating memories that will last a lifetime. With an impressive façade the straight terraces features a three bedroom all en-suite duplex with a one bedroom boys quarters and an ample parking space that can take up to three cars.'
            ]);

            PropertyType::create([
                'name' => 'THE FRONT VILLA',
                'description' => 'Don’t miss this unique opportunity to secure an immaculate home, in an ultra -convenient location.

                It features 3 bedrooms, 2 separate living areas, large kitchen & dining area,
                3 parking spaces and an attached boy’s quarters.'
            ]);
        }


        if (env('PHILEOTECH_CLIENT') == 'ochacho') {
            PropertyType::create([
                'name' => '3 BEDROOM FLATS WITH 1 BQ',
                'description' => 'Serene environment ✔️
                Good roads ✔️
                Good Drainage ✔️
                24hrs power supply ✔️
                Street lights ✔️
                24hrs armed security ✔️
                Price: 35 million
                You can be a part of the ochacho family with a N2.5m initial deposit, you can spread your balance and own your dream home with us.'
            ]);
            
            PropertyType::create([
                'name' => 'FULLY DETACHED DUPLEX WITH PENTHOUSE',
                'description' => 'Fully Detached standalone duplex with penthouse, 5 bedroom with two room boys quarters.
                40,000 per square metre
                Landalone:
                600sqm – 24 million
                DPC – 8.6 million
                Carcass – 90 million
                Fully finished -120 million'
            ]);

            PropertyType::create([
                'name' => 'SEMI DETACHED DUPLEX WITH PENTHOUSE',
                'description' => 'Semi Detached duplex with penthouse, 4 bedroom with one room boys quarters.
                40,000 per square metre
                Landalone:
                300sqm – 12 million
                350sqm – 14 million
                DPC – 4.3 million
                Carcass – 55 million'
            ]);

        }
    }
}
