<table class="table table-centered table-nowrap mb-0">
    <thead>
    <tr>
        <th>#</th>
        <th class="text-left">Name</th>
        <th class="text-left">Email</th>
        <th class="text-left">Phone number</th>
        <th class="text-left">Property</th>
        <th class="text-left">Estate</th>
        <th class="text-left">Property Type</th>
        <th class="text-end">Paid (&#x20A6;)</th>
         <th class="text-end">Unpaid (&#x20A6;)</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data as $datum)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-left">
                @if(!is_null($datum['client']))
                    <a href="{{ route('clients.show', $datum['client']->slug) }}">{{ $datum['client']->name }}</a>
                @endif
            </td>
            <td class="text-left">
                @isset($datum['client'])
                    {{ $datum['client']->email }}
                @endisset
            </td>
            <td class="text-left">
                @isset($datum['client'])
                    {{ $datum['client']->phone }}
                @endisset
            </td>
            <td class="text-left">
                @isset($datum['property'])
                    {{ $datum['property']->unique_number }}
                @endisset
            </td>
            <td class="text-left">
                @isset($datum['estate'])
                    {{ $datum['estate']->name }}
                @endisset
            </td>
            <td class="text-left">
                @isset($datum['propertyType'])
                    {{ $datum['propertyType']->name }}
                @endisset
            </td>
            <td class="text-end">{{ number_format($datum['client']->paid) }}</td>
            <td class="text-end">{{ number_format($datum['client']->unpaid) }}</td>
        </tr>
    @endforeach

    </tbody>
</table>
