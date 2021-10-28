<div>

    <section class="content">
        <div class="row">
            <div class="col-12">

                <h3>Search Results</h3>

                @forelse ($results as $result)
                <div class="box">
                    <div class="box-body">
                        <h4>
                            <a href="{{ route('clients.show', $result) }}">{{ $result->sname }} {{ $result->onames }}</a>
                        </h4> <br>
                        <div class="row">
                            <div class="col-lg-3">
                                <p>Phone number: <a href="tel:{{ $result->phone }}">{{ $result->phone }}</a></p>
                                <p>Email: <a href="mailto:{{ $result->email }}">{{ $result->email }}</a></p>
                            </div>
                            <div class="col-lg-9">
                                @forelse ($result->properties as $property)

                                    @if ($property->estatePropertyType)
                                        <a href="{{ route('property-types.show', $property->estatePropertyType->propertyType) }}">{{ $property->estatePropertyType->propertyType ? ucfirst(strtolower($property->estatePropertyType->propertyType->name)) : null }}</a> 
                                    @endif

                                    @if (!$loop->last) <br> @endif

                                @empty
                                    <p>No property</p>
                                @endforelse
                            </div>
                        </div>
                        
                    </div>
                </div>
                @empty
                <p>No results</p>
                @endforelse

            </div>
        </div>
    </section>

</div>
