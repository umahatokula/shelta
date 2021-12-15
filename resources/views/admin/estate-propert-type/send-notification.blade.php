<div class="row">
           
    <div class="col-md-12 ma-5">
        <div class="box ">
            <div class="box-header with-border">
            <h5 class="box-title">Message subscribers of <span class="text-warning">{{ $propertyType->name }}</span> <span> {{ $estate->name }}</span></h5>
            <div class="box-tools pull-right">
                &nbsp
            </div>
            </div>

            <div class="box-body">
                <form action="{{ route('estate-property-type.clients.send-notification.store') }}" method="post">
                    @csrf

                    <input type="hidden" name="property_type_id" value="{{ $propertyType->id }}">
                    <input type="hidden" name="estate_id" value="{{ $estate->id }}">
                
                    <div class="form-check">
                        <input name="sms" class="form-check-input" type="checkbox" value="sms" id="sms" checked="">
                        <label class="form-check-label" for="sms">
                            SMS
                        </label>
                    </div>
                    <div class="form-check">
                        <input name="whatsapp" class="form-check-input" type="checkbox" value="whatsapp" id="whatsapp">
                        <label class="form-check-label" for="whatsapp">
                            WhatsApp
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input name="email" class="form-check-input" type="checkbox" value="email" id="email">
                        <label class="form-check-label" for="email">
                            Email
                        </label>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">Subject (For Email only)</label>
                        <input wire:model="subject" class="form-control" name="subject" autofocus>
                        @error('subject') <span class="text-danger">{{ $subject }}</span> @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">Message</label>

                        <div wire:ignore class="form-group row">
                            <div class="col-md-12">
                                <textarea wire:model="message" class="form-control required" name="message" id="message" rows="8"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-block btn-lg">Send notification</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>