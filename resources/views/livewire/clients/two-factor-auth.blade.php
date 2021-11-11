<div>

    <div class="mb-3 row my-5">
        <label for="example-text-input" class="col-md-7 col-form-label">Enable Two Factor Authentication? (<strong>{{ $enable ? 'Enabled' : 'Disabled' }}</strong>)</label>
        <div class="col-md-5">
            {{-- <input wire:click="toggle2FA" type="checkbox" id="switch6" switch="primary" checked />
            <label class="form-label" for="switch6" data-on-label="Yes" data-off-label="No"></label> --}}
            <button class="btn btn-{{ $enable ? 'danger' : 'success' }}" wire:click="toggle2FA">{{ $enable ? 'Disabled' : 'Enable' }}</button>
        </div>
    </div>

</div>
