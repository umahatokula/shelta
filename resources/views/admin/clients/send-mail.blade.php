<div class="row">
           
    <div class="col-md-12 ma-5">
        <div class="box ">
            <div class="box-header with-border">
            <h4 class="box-title"><span>Send Email <i>to</i> <span class="text-warning">{{ $client->sname.' '.$client->onames }}</span> </span></h4>
            <div class="box-tools pull-right">
                &nbsp
            </div>
            </div>

            <div class="box-body">
                <form action="{{ route('clients.sendMail.post') }}" method="post">
                    @csrf

                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input wire:model="subject" class="form-control" autofocus>
                        @error('subject') <span class="text-danger">{{ $subject }}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Mail Content</label>

                        <div wire:ignore class="form-group row">
                            <div class="col-md-12">
                                <textarea wire:model="message" class="form-control required" name="message" id="message" rows="8"></textarea>
                            </div>
                        </div>

                    </div>

                    <button class="btn btn-primary btn-block">Send mail</button>

                </form>
            </div>
        </div>
    </div>
</div>