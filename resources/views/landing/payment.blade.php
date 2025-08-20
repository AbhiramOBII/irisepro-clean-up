@extends('landing.partials.base')

@section('title', 'Complete Your Payment')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg">
        <div class="text-center">
            <h2 class="mt-2 text-2xl font-extrabold text-gray-900">Complete Your Payment</h2>
            <p class="mt-2 text-sm text-gray-600">Challenge Enrollment ID #{{ $enrollment->id }}</p>
        </div>

        <button id="pay-btn" class="w-full inline-flex justify-center py-3 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            Pay ₹{{ number_format($order['amount']/100, 2) }}
        </button>

        <form id="payment-form" action="{{ route('payment.verify') }}" method="POST" class="hidden">
            @csrf
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
            <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        </form>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('pay-btn').addEventListener('click', function(e){
        e.preventDefault();
        const options = {
            key: "{{ $key }}",
            amount: "{{ $order['amount'] }}",
            currency: "INR",
            name: "Irise Pro",
            description: "Challenge Enrollment",
            order_id: "{{ $order['id'] }}",
            handler: function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('payment-form').submit();
            },
            prefill: {
                name: "{{ $enrollment->full_name }}",
                email: "{{ $enrollment->email_id }}",
                contact: "{{ $enrollment->phone_number }}"
            },
            theme: {
                color: "#0F6FFF"
            }
        };
        const rzp = new Razorpay(options);
        rzp.on('payment.failed', function (response){
            alert('Payment failed: ' + response.error.description);
        });
        rzp.open();
    });
</script>
@endsection
