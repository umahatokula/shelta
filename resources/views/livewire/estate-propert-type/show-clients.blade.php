<div>

    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Clients</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="mdi mdi-home-outline"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ url()->previous() }}">Estate Property Type Clients</a></li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            
            <div class="col-lg-12">
                <div class="box p-15">
                    <h4 class="box-title">
                        {{ $propertyType->name }} 
                        
                        <span class="font-weight-bold font-italic" style="font-size: 1rem">in</span>

                        <span class="text-warning">{{ $estate->name }}</span>
                    </h4>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="box p-15">

                    <h4>Client List</h4>

                    @if ($clients->isNotEmpty())
                        
					<div class="table-responsive">
                        <table id="propertyTypeEstateShowClients" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">Name</th>
                                    <th class="text-right">Paid (&#x20A6;)</th>
                                    <th class="text-right">Unpaid (&#x20A6;)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-left">{{ $client->sname.' '.$client->onames }}</td>
                                    <td class="text-right">{{ number_format($client->paid) }}</td>
                                    <td class="text-right">{{ number_format($client->unpaid) }}</td>
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
            
            <div class="col-lg-5">
                <div class="box p-15">
                    <h4>Compose Mail</h4>
                    <form wire:submit.prevent="sendMail">
                        
                        <div class="form-group">
                            <textarea wire:model="message" class="form-control" name="wysiwyg-editor" required></textarea>
                            @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button class="btn btn-primary btn-block {{ $clients->isEmpty() ? 'disabled' : '' }}">Send mail</button>

                    </form>
                    
                </div>
            </div>
            

        </div>

    </section>
</div>

@push('scripts')

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/data-table.js') }}"></script>


<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endpush
