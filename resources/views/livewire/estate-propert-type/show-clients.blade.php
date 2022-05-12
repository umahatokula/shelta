<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h4>{{ config('app.name', 'Real Estate App') }} - Estate Property Type Clients</h4>
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

                            <div>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="box p-15">
                                        <div x-data="{show: false}" class="row">
                                            <div class="col-md-8 mb-5">
                                                <h4 class="box-title">
                                                    {{ $propertyType->name }}

                                                    <span class="font-weight-bold font-italic" style="font-size: 1rem">in</span>

                                                    <span class="text-warning">{{ $estate->name }}</span>
                                                </h4>
                                            </div>
                                            <div class="col-md-4 mb-5 d-flex justify-content-end">
                                                <a data-toggle="modal" data-keyboard="false" data-target="#modal-center" data-remote="{{ route('estate-property-type.clients.send-notification', [$estate, $propertyType]) }}" href="#" class="btn btn-warning  float-right mx-3">Send notification</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="box p-15">

                                        <h4>Client List</h4>

                                        @if ($data->isNotEmpty())

                                        <div class="table-responsive-md">
                                            <table class="table table-centered table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th class="text-left">Name</th>
                                                        <th class="text-left">Email</th>
                                                        <th class="text-left">Property</th>
                                                        <th class="text-end">Paid (&#x20A6;)</th>
                                                        {{-- <th class="text-end">Unpaid (&#x20A6;)</th> --}}
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
                                                            @isset($datum['property'])
                                                                {{ $datum['property']->unique_number }}
                                                            @endisset
                                                        </td>
                                                        <td class="text-end">{{ number_format($datum['client']->paid) }}</td>
                                                        {{-- <td class="text-end">{{ number_format($client->unpaid) }}</td> --}}
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                          </table>
                                        </div>
                                        @else
                                        <p>
                                            No data
                                        </p>
                                        @endif


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/data-table.js') }}"></script>


{{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> --}}
<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
<script>
    const editor = CKEDITOR.replace('message');
    editor.on('change', function(event){
        console.log(event.editor.getData())
        @this.set('message', event.editor.getData());
    })
</script>
@endpush
