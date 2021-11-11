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
                        <div class="col-md-4 mb-5">
                            <a @click="show = true" x-show="!show" href="#" class="waves-effect waves-light btn btn-success btn-sm float-right ml-3">Send Emai</a>
                            
                            <a @click="show = false" x-show="show" href="#" class="waves-effect waves-light btn btn-danger btn-sm float-right ml-3">Cancel</a>
                        </div>
                                    
                        <div x-show="show" @emailSent.window="show = false" x-transition.duration.500ms class="col-md-12 ma-5">
                            <div class="box box-outline-primary">
                                <div class="box-header with-border">
                                <h4 class="box-title"><strong>Compose Email</strong></h4>
                                <div class="box-tools pull-right">
                                    &nbsp
                                </div>
                                </div>
            
                                <div class="box-body">
                                    <form wire:submit.prevent="sendMail">
                                        
                                        <div class="form-group">
                                            <label class="form-label">Subject</label>
                                            <input wire:model="subject" class="form-control" autofocus>
                                            @error('subject') <span class="text-danger">{{ $subject }}</span> @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Mail Content</label>
                
                                            <div wire:ignore class="form-group row">
                                                <div class="col-md-12">
                                                    <textarea wire:model="message" class="form-control required" name="message" id="message"></textarea>
                                                </div>
                                            </div>
                
                                        </div>
                
                                        <button class="btn btn-primary btn-block {{ $clients->isEmpty() ? 'disabled' : '' }}">Send mail</button>
                
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12">
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

        </div>

    </section>
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
