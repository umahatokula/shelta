
<table class="table table-centered table-nowrap mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-start">Client (&#8358;)</th>
            <th class="text-start">Property</th>
            <th class="text-end">Amount</th>
            <th class="text-start">Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($defaults as $default)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-start">{{ $default->client->name }}</td>
                <td class="text-start">{{ $default->property->unique_number }}</td>
                <td class="text-end">{{ number_format($default->default_amount, 2) }}</td>
                <td class="text-start">{{ $default->missed_date->toFormattedDateString() }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No transactions</td>
            </tr>
        @endforelse
    </tbody>
</table>
