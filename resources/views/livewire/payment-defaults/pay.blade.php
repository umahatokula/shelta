<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Add Property</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">
                            <form wire:submit.prevent="save">
        
                                <div class="box-header">
                                    <h4 class="box-title">Offset Payment Defaults</h4>
                                </div>
                                <div class="box-body">
        
                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-3">Amount</label>
                                        <div class="col-md-9">
                                            <input wire:model.lazy="amount" class="form-control" />
                                            @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
        
                                </div>
                                <div class="box-footer">
                                    <a class="btn-lg btn btn-warning me-1" href="{{ route('clients.show', $client->slug) }}">Cancel</a>
                                    <input type="submit" class="btn-lg btn btn-primary" value="Pay">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
