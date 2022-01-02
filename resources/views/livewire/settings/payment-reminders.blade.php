<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Payment Reminders</h1>
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
                            
                            <form wire:submit.prevent="save">
        
                                <div class="box-body">
                                    <h3 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Add Reminders</h3>
        
                                    <div class="row">
                                        <div class="col-md-6 mb-5">
                                            <h4 class="box-title text-info mb-0 mt-20">&nbsp</h4>
                                        </div>
                                        <div class="col-md-6 mb-5 d-flex justify-content-end  d-flex align-items-center">
                                            <a wire:click.prevent="addReminder" href="#" class="mt-4"> <span class="badge badge-success">Add Reminder</span> </a>
                                        </div>
                                    </div>
                                    <hr class="my-15">
        
                                    @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            Ensure there are no duplicate selections for Property Type
                                        </div>
                                    @endif 
        
                                    @foreach ($reminders as $key => $reminder)
                                    <div class="row">
                                        <div class="col-md-4 mb-5">
                                            <div class="form-group">
                                                <label class="form-label">Number of Days</label>
                                                <input wire:model.lazy="addedReminders.{{$key}}.number_of_days_before_due_date" class="form-control"
                                                    type="number" required>
                                                @error('number_of_days_before_due_date') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-5">
                                            <div class="form-group">
                                                <label class="form-label">Message</label>
                                                <textarea wire:model.lazy="addedReminders.{{$key}}.message" class="form-control" required placeholder="Enter a short message..."></textarea>
                                                @error('message') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-5 pt-4 d-flex justify-content-end align-items-center">
                                            <div class="form-group">
                                                <a wire:click.prevent="removeReminder({{ $key }})" href="#"
                                                    class="text-white"> <span class="badge badge-danger">Remove</span> </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
        
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <a class="btn-lg btn btn-warning me-1" href="{{ url()->previous() }}">Cancel</a>
                                    <input type="submit" class="btn-lg btn btn-primary" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
