<table class="table">
    <thead>
        <tr>
            <th colspan="2">Transaction Details</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">Recorded on</td>
            <td>

                {{ $transaction->date ? $transaction->date->toFormattedDateString() : null }}
            </td>
        </tr>
        <tr>
            <td scope="row">Being Instalment for</td>
            <td>
                {{ $transaction->instalment_date ? $transaction->instalment_date->toFormattedDateString() : null }}
            </td>
        </tr>
        <tr>
            <td scope="row">Client</td>
            <td>{{ $transaction->client->sname.' '.$transaction->client->onames  }}</td>
        </tr>
        <tr>
            <td scope="row">Transaction ID</td>
            <td>{{ $transaction->transaction_number  }}</td>
        </tr>
        <tr>
            <td scope="row">Amount</td>
            <td>&#8358; {{ number_format($transaction->amount, 2)  }}</td>
        </tr>
        <tr>
            <td scope="row">Property</td>
            <td>{{ $transaction->property->estatePropertyType->propertyType->name  }} <strong>[ {{ $transaction->property->unique_number }} ]</strong></td>
        </tr>
        <tr>
            <td scope="row">Estate</td>
            <td>{{ $transaction->property->estatePropertyType->estate->name  }}</td>
        </tr>
        <tr>
            <td scope="row">Type</td>
            <td>
                @if ($transaction->onlinePayment)
                    Online
                @else
                    Recorded
                @endif
            </td>
        </tr>
        <tr>
            <td scope="row">Recorded By</td>
            <td>{{ $transaction->recordedBy->name  }}</td>
        </tr>
        <tr>
            <td scope="row">Status</td>
            <td>
                @if ($transaction->status == 1)
                    <span class="badge badge-success">approved</span>
                @elseif ($transaction->status == 2)
                    <span class="badge badge-danger">unapproved</span>
                @else
                    <span class="badge badge-default">unprocessed</span>
                @endif
            </td>
        </tr>
        <tr>
            <td scope="row">Processed By</td>
            <td>{{ $transaction->processedBy->name  }}</td>
        </tr>
    </tbody>
</table>
