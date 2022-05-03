<div>
    <div class="rs-contact contact-style2 pt-95 pb-100 md-pt-65 md-pb-70">
        <div class="container">
            <div class="sec-title2 mb-55 md-mb-35 text-start">
                <h1 class="title mb-0">Subscription Form </h1>
            </div>
            <div class="row y-middle">
                <div class="col-lg-12">
                    <div class="contact-wrap">
                        <div id="form-messages"></div>

                        <form wire:submit.prevent="save">
                            <div class="box-header with-border">
                                <h4 class="box-title">&nbsp</h4>
                            </div>
                            <div class="box-body">

                                <input type="hidden" wire:model="client_id" />

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" id="sname">Surname Name <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input value="" class="from-control" type="text">
                                        @error('sname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" id="onames">Other Names <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input value="" class="from-control" type="text">
                                        @error('onames') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" id="email">Email</label>
                                    <div class="col-md-10">
                                        <input value="" class="from-control" type="email">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" id="address">Property <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <select wire:model.lazy="property_id" class="from-control">
                                            <option value="">Please select one</option>

                                        </select>
                                        @error('property_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" id="amount">Amount <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input wire:model="amount" class="from-control" type="number">
                                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" id="amount">Date <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input wire:model="date" class="from-control" type="date">
                                        @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" id="proof_reference_number">Proof of payment Ref.<span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input wire:model="proof_reference_number" class="from-control" type="text">
                                        @error('proof_reference_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" id="proof">Proof of payment <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input wire:model="proof" class="from-control" type="file">
                                        @error('proof') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="d-grid grid-2">
                                <input type="submit" class="readon submit" value="Submit">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
