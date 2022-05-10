<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Estate;
use App\Models\Setting;
use App\Helpers\Helpers;
use App\Models\Property;
use App\Mail\CustomMailable;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\EstatePropertyType;

class EstatePropertyTypeController extends Controller
{
    /**
     * showClients
     *
     * @param  mixed $estate
     * @param  mixed $propertyType
     * @return void
     */
    public function showClients(Estate $estate, PropertyType $propertyType) {

        $data['estate'] = $estate;
        $data['propertyType'] = $propertyType;

        return view('admin.estate-propert-type.show-clients', $data);
    }

    /**
     * sendNotification
     *
     * @param  mixed $estate
     * @param  mixed $propertyType
     * @return void
     */
    public function sendNotification(Estate $estate, PropertyType $propertyType) {
        $data['estate'] = $estate;
        $data['propertyType'] = $propertyType;

        return view('admin.estate-propert-type.send-notification', $data);
    }

    public function sendNotificationStore(Request $request) {
        // dd($request->all());

        $company_email = Setting::first() ? Setting::first()->company_email : env('MAIL_FROM_ADDRESS', 'hello@example.com');
        $estate = Estate::findOrFail($request->estate_id);
        $propertyType = PropertyType::findOrFail($request->property_type_id);
        $estatePropertyType = EstatePropertyType::where([
            'estate_id' => $estate->id,
            'property_type_id' => $propertyType->id,
        ])->first();


        // get all properties of this property type in this estate
        $properties = Property::whereIn('estate_property_type_id', function ($query) use($estate, $propertyType) {
            $query->select('id')
                ->from('estate_property_type')
                ->where('estate_property_type.estate_id', '=', $estate->id)
                ->where('estate_property_type.property_type_id', '=', $propertyType->id)
                ->get()
                ->toArray();
        })
        ->whereNotNull('client_id')
        ->get();


        // get the amount paid and unpaid for this property type in this estate for every client that owns this property type in the estate
        $clients = $properties->map(function($property) use($propertyType) {
            return $property->client->load('transactions');
        })->each(function($client) use($estatePropertyType, $propertyType) {

            $client->unpaid = $estatePropertyType->price;

            $client->transactions->each(function($transaction) use($client, $propertyType) {
                if ($transaction->property->estatePropertyType->propertyType->id == $propertyType->id) {

                    $client->paid = $client->paid + $transaction->amount;
                    $client->unpaid = $client->unpaid - $transaction->amount;

                }
            });

        });


        // send email
        if ($request->has('email')) {
            Mail::to($company_email)
                ->bcc($clients->pluck('email'))
                ->send(new CustomMailable($request->subject, $request->message));
        }

        foreach ($clients as $client ) {

            // send SMS
            if ($request->has('sms')) {
                if ($client->phone) {

                    Helpers::sendSMSMessage($client->phone, $request->message);

                }
            }


            // send whatsapp
            if ($request->has('whatsapp')) {
                if ($client->phone) {

                    Helpers::sendWhatsAppMessage($client->phone, $request->message);

                }
            }

        }

        session()->flash('message', 'Email sent successfully.');
        return redirect()->back();
    }
}
