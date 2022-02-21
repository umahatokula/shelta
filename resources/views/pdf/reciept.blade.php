<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=roboto">
<style>
body {
  font-family: "Sofia", sans-serif;
}
</style>

<script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>



<style>
    #invoice {
        font-size: 1.5rem
    }

</style>

<div class="container mt-5" id="invoice">
    <div class="row">
        <div class="col-md-12">
            <div class="p-3 bg-white rounded">

                <div class="row" style="margin-bottom: 50px">
                    <div class="col-md-3 mt-4" style="padding-top: 30px">
                        <div><span class="font-weight-bold text-uppercase">Ref ID:</span><span
                                class="ml-1"> {{ $transaction->property->unique_number }}</span></div>
                        <div><span class="ml-1"> {{ $transaction->date->toFormattedDateString();  }}</span></div>
                    </div>
                    <div class="col-md-6 mt-4 text-center" style="padding-top: 15px">
                        <h1 class="text-uppercase"><b>RECEIPT</b></h1>
                    </div>
                    <div class="col-md-3 text-right">
                        @php
                            $image=file_get_contents(asset('assets/images/logo.png'));
                            $imagedata=base64_encode($image);
                            $imgpath='<img src="data:image/png;base64, '.$dataBase64.'">';
                        @endphp
                        <img src="{{ $imgpath }}" alt="" class="img-fluid" width="100px">
                    </div>
                </div>

                <div class="row" style="margin-bottom: 50px">
                    <div class="col-md-9">
                        <div class="text-bold">Richboss Realty Limited</div>
                        <div>
                            <span class="text-muted">Suite F31-32, Melita Plaza, Area 11, Garki, Abuja</span>
                        </div>
                        <div>
                            <span class="text-muted">08023557905</span>
                        </div>
                        <div>
                            <span class="text-muted">
                                richbossrealty@gmail.com</span>
                        </div>
                    </div>
                    <div class="col-md-3 text-right mt-3">
                        {{-- <img src="{{ asset('assets/images/paid.jpg') }}" alt="" class="img-fluid" width="100px"> --}}
                    </div>
                </div>

                <div class="row" style="margin-bottom: 50px">
                    <div class="col-6">
                        <h3 class="">Billing Address</h3>
                        <div>
                            <span class="text-muted">{{ $client->address}}</span>
                        </div>
                        <div>
                            <span class="text-muted">{{ $client->phone}}</span>
                        </div>
                        <div>
                            <span class="text-muted">{{ $client->email}}</span>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <h3 class="">Shipping Address</h3>
                        Same as billing address
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th class="text-uppercase">Product</th>
                                        <th class="text-center text-uppercase">QTY</th>
                                        <th class="text-right text-uppercase">Price (NGN)</th>
                                        <th class="text-right text-uppercase">Total (NGN)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if ($transaction->property)
                                            @if ($transaction->property->estatePropertyType)
                                            <span
                                                class="">{{ $transaction->property->estatePropertyType->estate ? $transaction->property->estatePropertyType->estate->name : null }}</span>
                                            -
                                            {{ $transaction->property->estatePropertyType->propertyType ? $transaction->property->estatePropertyType->propertyType->name : null }} - {{ $transaction->property->unique_number }}
                                            @endif
                                            @endif
                                        </td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($transaction->amount, 2) }}</td>
                                        <td class="text-right">
                                            {{ number_format($transaction->amount, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right text-uppercase" colspan="3"><b>Total</b></td>
                                        <td class="text-right text-uppercase"><b>{{ number_format($transaction->sum('amount'), 2) }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
