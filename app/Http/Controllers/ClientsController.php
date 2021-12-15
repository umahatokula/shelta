<?php

namespace App\Http\Controllers;

use PDF;
use Mail;
use App\Models\User;
use App\Models\Client;
use App\Helpers\Helpers;
use App\Models\Transaction;
use App\Mail\CustomMailable;
use Illuminate\Http\Request;
use App\Mail\PaymentMadeMailable;
use Twilio\Rest\Client as TwilioClient;
use App\Http\Requests\UpdateClientProfileRequest;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('client')) {

            $data['clients'] = Client::paginate(20);

            return view('frontend.clients.index', $data);
        }

        return view('admin.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        
        $data['client'] = $client->load([
            'transactions.property.estatePropertyType.propertyType', 
            'transactions.property.estatePropertyType.estate', 
            'properties.estatePropertyType.propertyType', 
            'properties.estatePropertyType.estate'
        ]);

        $data['propertybalance'] = 0;

        if (auth()->user()->hasRole('client')) {
    
            return view('frontend.clients.show', $data);
        }

        return view('admin.clients.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $data['client'] = $client;
        return view('admin.clients.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $data['client'] = $client;
        return view('admin.clients.destroy', $data);
    }
    
    /**
     * addProperty
     *
     * @param  mixed $client
     * @return void
     */
    public function addProperty(Client $client) {
        $data['client'] = $client;
        return view('admin.clients.add-property', $data);
    }

    public function sendMail(Client $client) {
        $data['client'] = $client;
        
        return view('admin.clients.send-notification', $data);
    }

    public function sendMailPost(Request $request) {
        // dd($request->all());

        $client = Client::findOrFail($request->client_id);

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
        

        // send email
        if ($request->has('email')) {
            if ($client->email) {
                Mail::to($client->email)
                ->send(new CustomMailable($request->subject, $request->message));
            }
        }

        session()->flash('message', 'Notification sent to client');
        return redirect()->back();
        
    }









    //=======================CLIENTS FUNCTIONS=========================
    
    /**
     * login
     *
     * @return void
     */
    public function login() {
        return view('frontend.clients.login');
    }
    
    /**
     * display profile page
     *
     * @param  mixed $user
     * @return void
     */
    public function profile() {

        $user = auth()->user();

        if ($user->hasRole('staff')) {

            $data['enable'] = $user->staff->use_2fa;

        } else {

            $data['enable'] = $user->client->use_2fa;

            $data['client'] = $user->client->load([
                'transactions.property.estatePropertyType.propertyType', 
                'transactions.property.estatePropertyType.estate', 
                'properties.estatePropertyType.propertyType', 
                'properties.estatePropertyType.estate'
            ]);
        }
        

        return view('frontend.clients.profile', $data);
    }

    public function updateClientProfileRequest(UpdateClientProfileRequest $request, $id) {
        dd($request->all());

        $validated = $request->validated();
    }

    public function toggle2FA() {

        $user = User::findOrFail(auth()->id());

        if ($user) {
            $user->use_2fa = !$user->use_2fa;
            $user->save();
        }

        $status = $user->use_2fa ? 'enabled' : 'disabled';

        session()->flash('message', 'Two factor authentication '. $status);
        return redirect()->back();
    }
    
    /**
     * store client Profile
     *
     * @param  mixed $request
     * @return void
     */
    public function storeProfile(Request $request) {

        $data['user'] = $user->load('client');

        return redirect()->route('frontend.users.profile');
    }

    /**
     * Display payment history of client
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payments() {
        
        $client = auth()->user()->client;
        
        $data['client'] = $client->load([
            'transactions.property.estatePropertyType.propertyType', 
            'transactions.property.estatePropertyType.estate', 
            'properties.estatePropertyType.propertyType', 
            'properties.estatePropertyType.estate'
        ]);
        
        $data['propertybalance'] = 0;

        if (auth()->user()->hasRole('client')) {
    
            return view('frontend.clients.payments', $data);
        }

        return view('admin.clients.show', $data);
    }

    /**
     * Display client properties.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function properties() {
        
        $client = auth()->user()->client;
        
        $data['client'] = $client->load([
            'transactions.property.estatePropertyType.propertyType', 
            'transactions.property.estatePropertyType.estate', 
            'properties.estatePropertyType.propertyType', 
            'properties.estatePropertyType.estate'
        ]);
        
        $data['propertybalance'] = 0;

        if (auth()->user()->hasRole('client')) {
    
            return view('frontend.clients.properties', $data);
        }

        return view('admin.clients.show', $data);
    }
    
    /**
     * Download client payment reciept for specifc transaction
     *
     * @param  mixed $clientId
     * @param  mixed $transactionId
     * @return void
     */
    public function downloadReciept($transaction_number) {

        $data['client'] = auth()->user()->client;

        $data['transaction'] = Transaction::where('transaction_number', $transaction_number)->with(['property.estatePropertyType.propertyType', 'property.estatePropertyType.estate'])->first();

        $pdfContent = PDF::loadView('pdf.reciept', $data)->setPaper('a4', 'landscape');
        return $pdfContent->download('reciept.pdf');

    }
    
    /**
     * Mail client payment reciept for specifc transaction
     *
     * @param  mixed $clientId
     * @param  mixed $transactionId
     * @return void
     */
    public function mailReciept($transaction_number) {

        $client = auth()->user()->client;

        $transaction = Transaction::where('transaction_number', $transaction_number)->with(['property.estatePropertyType.propertyType', 'property.estatePropertyType.estate'])->first();
        Mail::to($transaction->client)->queue(new PaymentMadeMailable($transaction));

        session()->flash('message', 'Email sent successfully.');

        return redirect()->route('frontend.clients.payments', $client->slug);

        

        $transaction = Transaction::where('id', $transactionId)->with(['property.estatePropertyType.propertyType', 'property.estatePropertyType.estate'])->first();
        Mail::to($transaction->client)->queue(new PaymentMadeMailable($transaction));
        
        // session()->flash('message', 'Email sent successfully.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Email sent successfully.']);
    }
}
