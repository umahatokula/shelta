
<table class="table table-centered table-nowrap mb-0">
    <thead>
        <tr>
            <th class="text-left">Property Number</th>
            <th class="text-left">Property Type</th>
            <th>Estate</th>
            <th>Owner</th>
            <th class="text-end">Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($properties as $property)
            <tr>
                <td class="text-left">{{ $property->unique_number }}</td>
                <td class="text-left">
                    @if ($property->estatePropertyType)
                        {{ $property->estatePropertyType->propertyType->name }}
                    @endif
                </td>
                <td class="text-left">
                    @if ($property->estatePropertyType)
                        {{ $property->estatePropertyType->estate->name }}
                    @endif
                </td>
                <td>
                    @if ($property->client )
                        {{ $property->client->sname.' '.$property->client->onames }}
                    @else
                        <span class="badge bg-danger">not subscribed</span>
                    @endif
                </td>
                <td class="text-end">
                        {{ $property->getPropertyPrice() }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No properties</td>
            </tr>
        @endforelse

    </tbody>
</table>
