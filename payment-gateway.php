<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <link rel="stylesheet" href="payment-gateway-styles.css">
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="payment-container">
        <div class="payment-header">
            <h1>Complete Your Payment</h1>
        </div>
        <div class="payment-body">
            <form id="payment-form">
                <div class="payment-info">
                    <div class="product-summary">
                        <h3>Order Summary</h3>
                        <ul id="product-list"></ul> <!-- Product list populated via JS -->
                        <div class="total-amount">
                            <p>Total: $<span id="total-price">0.00</span></p>
                        </div>
                    </div>
                    <div class="card-info">
                        <label for="card-element">Credit or Debit Card</label>
                        <div id="card-element"></div> <!-- Stripe Element -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <div class="payment-buttons">
                        <button id="submit" class="submit-button">Pay Now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="payment-gateway.js"></script> <!-- External Payment Script -->
</body>
</html>
