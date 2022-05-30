<div class="modal-header">
    <h6 class="modal-title" id="fundModalLabel">Fund Details</h6>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-6 mb-3">
            <p class="m-0">Member: {{ $fund->member->name }}</p>
        </div>
        <div class="col-lg-6 mb-3">
            <p class="m-0">Type: {{ $fund->member->type == 1 ? 'Regular Member' : 'Family Member' }}</p>
        </div>
        <div class="col-lg-6 mb-3">
            <p class="m-0">Month: {{ $fund->months->name }} {{ $fund->year }}</p>
        </div>
        <div class="col-lg-6 mb-3">
            <p class="m-0">Amount: {{ $fund->amount }} TK</p>
        </div>
        <div class="col-lg-12 mb-3">
            <p class="m-0">Payment Method: {{ $fund->payment_methods->name ?? 'N/A' }}</p>
        </div>
        <div class="col-lg-12 mb-3">
            <p class="m-0">Payment On: {{ $fund->created_at->format('j F Y | h:i:s A') }}</p>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
</div>
