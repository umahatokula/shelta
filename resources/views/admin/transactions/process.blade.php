<form action="{{ route('transactions.processStore') }}" method="post">
    @csrf

    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <select name="status" class="form-control select2" style="width: 100%;">
                    <option value="1">Approved</option>
                    <option selected="selected" value="2">Disapproved</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary btn-sm btn-block">Save</button>
        </div>
    </div>

</form>
