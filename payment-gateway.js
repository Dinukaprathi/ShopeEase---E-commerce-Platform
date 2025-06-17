document.addEventListener("DOMContentLoaded", function() {
    // Mock cart data (replace with actual cart data as needed)
    var cart = [
        { name: "Wireless Headphones", price: 99.99, quantity: 1 },
        { name: "Smart Watch", price: 199.99, quantity: 1 }
    ];

    // Calculate subtotal
    var subtotal = 0;
    cart.forEach(item => subtotal += item.price * item.quantity);

    // Populate product list and total price
    var productListHtml = cart.map(item => 
        `<li>${item.name} - $${item.price} x ${item.quantity} = $${(item.price * item.quantity).toFixed(2)}</li>`
    ).join('');
    
    document.getElementById('product-list').innerHTML = productListHtml;
    document.getElementById('total-price').textContent = subtotal.toFixed(2);

    // Initialize Stripe
    var stripe = Stripe('your-publishable-key-here');  // Replace with your Stripe public key
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    // Handle form submission
    document.getElementById('payment-form').addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createPaymentMethod({ type: 'card', card: card }).then(function(result) {
            if (result.error) {
                document.getElementById('card-errors').textContent = result.error.message;
            } else {
                alert('Payment successful. Payment Method ID: ' + result.paymentMethod.id);
            }
        });
    });
});
