<link href="{{ public_path('assets/bootstrap-4.6.1-dist/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ public_path('assets/bootstrap-4.6.1-dist/css/bootstrap-theme.css') }}" rel="stylesheet">

<style>

.receiptPDF {
    font-size: 0.7rem;
}

</style>

<div class="row receiptPDF">
    <div class="col-md-12">

        <table class="table" style="border: 0px;">
            <tbody>
                <tr>
                    <td class="text-left" style="vertical-align: middle;">

                        {{ $transaction->property->unique_number }} <br>

                        {{ $transaction->date->toFormattedDateString();  }}

                    </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <h4>RECEIPT</h4>
                    </td>
                    <td class="text-right" style="vertical-align: middle; text-align: right;">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="" class="img-responsive" width="100px">
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table" style="border: 0px;">
            <tbody>
                <tr>
                    <td class="text-left" colspan="2" style="vertical-align: middle;">
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
                    </td>
                    <td class="text-center" style="vertical-align: middle; text-align: right;">
                        <img src="{{ asset('assets/images/paid.jpg') }}" alt="" class="img-responsive" width="100px">
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table" style="border: 0px;">
            <tbody>
                <tr>
                    <td class="text-left" colspan="2" style="vertical-align: top;">
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
                    </td>
                    <td class="text-center" style="vertical-align: top; text-align: center;">
                        <h3 class="">Shipping Address</h3>
                        Same as billing address
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
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
                    <td style="width: 30%">
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
                        <b>{{ number_format($transaction->amount, 2) }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
