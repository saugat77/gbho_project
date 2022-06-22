<div class="d-sm-flex justify-content-between font-poppins">
    <div>
        <div class="info-box border z-depth-0">
            <span class="info-box-icon bg-primary"><i class="fas fa-luggage-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-sm">Order Status</span>
                <span class="info-box-number mdb-color-text font-medium">{{ strtoupper($order->status) }}</span>
            </div>
        </div>
    </div>

    <div>
        <div class="info-box border z-depth-0">
            <span class="info-box-icon bg-danger"><i class="far fa-credit-card"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-sm">Payment Option</span>
                <span class="info-box-number mdb-color-text font-medium">{{ strtoupper($order->payment_method) }}</span>
            </div>
        </div>
    </div>

    <div>
        <div class="info-box border z-depth-0">
            <span class="info-box-icon bg-success"><i class="fas fa-hand-holding-usd"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-sm">Payment Status</span>
                <span class="info-box-number mdb-color-text font-medium">{{ strtoupper($order->payment_status) }}</span>
            </div>
        </div>
    </div>
</div>

{{-- <div class="white border rounded">
        <div class="p-4 yellow lighten-4 font-weight-bolder amber-text border-bottom rounded-top">
           <span class="mr-2 deep-purple-"><i class="fas fa-luggage-cart fa-lg"></i></span> Order Status
        </div>
        <div class="py-2 text-center">
            {{ ucfirst($order->status) }}
</div>
</div>
<div class="white border rounded">
    <div class="p-4 blue lighten-4 font-weight-bolder text-primary border-bottom rounded-top">
        <span class="mr-2 deep-purple-"><i class="far fa-credit-card fa-lg"></i></span> Payment Option
    </div>
    <div class="py-2 text-center">
        {{ ucfirst($order->payment_method) }}
    </div>
</div>
<div class="white border rounded">
    <div class="p-4 yellow lighten-4 font-weight-bolder amber-text border-bottom rounded-top">
        <span class="mr-2 deep-purple-"><i class="fas fa-hand-holding-usd fa-lg"></i></span> Payment Status
    </div>
    <div class="py-2 px-3 text-center">
        {{ ucfirst($order->status) }}
    </div>
</div> --}}
