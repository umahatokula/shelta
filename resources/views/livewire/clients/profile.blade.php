<div>
    
    <form wire:submit.prevent="save">
        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Surname Name</label>
            <div class="col-md-10">
                <input wire:model.lazy="sname" class="form-control" type="text">
                @error('sname') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Other Names</label>
            <div class="col-md-10">
                <input wire:model.lazy="onames" class="form-control" type="text">
                @error('onames') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Phone Number</label>
            <div class="col-md-10">
                <input wire:model.lazy="phone" class="form-control" type="text">
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
            <div class="col-md-10">
                <input wire:model.lazy="email" class="form-control" type="text">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </form>

</div>
