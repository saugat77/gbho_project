<div wire:ignore.self class="modal fade" id="orderPaymentStatusModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="h4-responsive modal-title w-100">Change Payment Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="updatePaymentStatus">
                <div class="modal-body mx-3">
                    <div class="col-md-6 mx-auto">
                        <div class="form-group">
                            <label>Order Status</label>
                            <select wire:model.defer="order.payment_status" name="order.payment_status" class="custom-select rounded-0 @error('order.payment_status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                @foreach (config('constants.order.payment_status') as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <x-invalid-feedback field="order.payment_status"></x-invalid-feedback>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-success my-0 border font-poppins text-capitalize">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
