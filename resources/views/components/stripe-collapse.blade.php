<label class="mt-3">Card Details: </label>
<div id="cardElement"></div>
<small class="form-text text-muted" id="cardErrors" role="alert"></small>

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{config('services.stripe.key')}}');
        const elements = stripe.elements({locale: 'en'});
        const cardElement = elements.create('card');
        cardElement.mount('#cardElement');
    </script>
@endpush
