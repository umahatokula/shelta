<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - 2FA</h1>
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
                            
                            <p>
                                <form wire:submit.prevent="save">
                                    @csrf
    
                                    <div class="mb-3 row my-5">
                                        <label for="example-text-input" class="col-md-7 col-form-label">Do you want to enable or disable Two Factor Authentication? 
    
                                        <br> 
    
                                        (Currently <span class="text-{{ $user_2fa ? 'success' : 'danger' }}">{{ $user_2fa ? 'Enabled' : 'Disabled' }}</span>)</label>
    
                                        <div class="col-md-5 dd-flex justify-content-end">
                                            <button class="btn-lg btn btn-{{ $user_2fa ? 'danger' : 'success' }}" >{{ $user_2fa ? 'Disable Two Factor Authentication' : 'Enable Two Factor Authentication' }}</button>
                                        </div>
                                    </div>
    
                                </form>
    
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
