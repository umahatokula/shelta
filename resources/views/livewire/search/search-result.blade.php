<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Search Results</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">
                            <div class="row">
                                <div class="col-12">

                                    @forelse ($results as $result)
                                        <div class="mb-5">
                                            <h4>
                                                <a href="{{ route('clients.show', $result) }}">{{ $result->sname }} {{ $result->onames }}</a>
                                            </h4> <br>
                                            <div class="row">
                                                <div class="col-lg-6 d-block justify-content-start">
                                                    <p style="display: block">Phone number: <a href="tel:{{ $result->phone }}">{{ $result->phone }}</a></p>
                                                    <p>Email: <a href="mailto:{{ $result->email }}">{{ $result->email }}</a></p>
                                                </div>
                                                <div class="col-lg-6 d-block justify-content-end">
                                                    @forelse ($result->properties as $property)

                                                        @if ($property->estatePropertyType()->exists())
                                                            @if ($property->estatePropertyType->propertyType()->exists())
                                                                <a href="{{ route('property-types.show', $property->estatePropertyType->propertyType) }}">{{ $property->estatePropertyType->propertyType ? ucfirst(strtolower($property->estatePropertyType->propertyType->name)) : null }}</a>
                                                            @endif
                                                        @endif

                                                        @if (!$loop->last) <br> @endif

                                                    @empty
                                                        <p>No property</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No results</p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
