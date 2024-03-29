<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-3.3.7-dist/css/bootstrap.css') }}" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-3.3.7-dist/css/bootstrap-theme.css') }}"
        crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="{{ asset('assets/bootstrap-3.3.7-dist/js/bootstrap.js') }}"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
    </script>

    <style>
        
    </style>

</head>

<body>
    <div class="" id="invoice">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3 bg-white rounded">

                    <div class="row" style="margin-bottom: 50px">
                        <div class="col-3"  style="display: inline-grid; width: 30%; padding-top: -90px;">
                            <div><span class="font-weight-bold text-uppercase">Ref ID:</span><span class="ml-1">
                                    {{ $transaction->property->unique_number }}</span></div>
                            <div><span class=""> {{ $transaction->date->toFormattedDateString();  }}</span></div>
                        </div>
                        <div class="col-6 text-center"  style="display: inline-grid; width: 30%; padding-top: 0">
                            <h1 class="text-uppercase"><b>RECEIPT</b></h1>
                        </div>
                        <div class="col-3 text-right float-right"  style="display: inline-grid; width: 30%; margin-top: 0">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="" class="img-responsive"
                                width="100px">
                        </div>
                    </div>

                    <div style="display: flex; margin-bottom: 50px">
                        <div style="max-width: 30%; flex: 1; padding-top: -90px;">
                            <div>
                                <span class="font-weight-bold text-uppercase">Ref ID:</span><span class="ml-1">
                                    {{ $transaction->property->unique_number }}</span>
                            </div>
                            <div>
                                <span class=""> {{ $transaction->date->toFormattedDateString();  }}</span>
                            </div>
                        </div>
                        <div style="max-width: 30%; flex: 1; padding-top: 0">
                            <h1 class="text-uppercase"><b>RECEIPT</b></h1>
                        </div>
                        <div style="max-width: 30%; flex: 1; margin-top: 0">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="" class="img-responsive"
                                width="100px">
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 50px">
                        <div class="col-md-8" style="display: inline-grid; width: 60%">
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
                        <div class="col-md-4 text-right float-right" style="display: inline-grid; width: 30%">
                            <img src="{{ asset('assets/images/paid.jpg') }}" alt="" class="img-responsive"
                                width="100px">
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 50px">
                        <div class="col-md-6 text-left" style="display: inline-grid">
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
                        <div class="col-md-6 text-right" style="display: inline-grid; width: 30%; padding-top: -30px;">
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
                                                {{ $transaction->property->estatePropertyType->propertyType ? $transaction->property->estatePropertyType->propertyType->name : null }}
                                                - {{ $transaction->property->unique_number }}
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
                                            <td class="text-right text-uppercase">
                                                <b>{{ number_format($transaction->sum('amount'), 2) }}</b></td>
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

</body>

</html>
