<form action="{{ route('clients.resetPasswordPost') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12  mb-4">
            <p>
                Password will be reset to <strong>12345678</strong>. Client will receive a mail.
            </p>
        </div>
    </div>
    <div class="row">
        <input type="hidden" name="client_id" value="{{ $client->id }}">
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mx-2">Yes, reset</button>
            <a href="{{ route('clients.show', $client) }}" class="btn btn-danger mx-2">Cancel</a>
        </div>
    </div>
</form>
