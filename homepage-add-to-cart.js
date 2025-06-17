// Function to update product quantity
function updateQuantity(id, change) {
    let quantityInput = document.getElementById("quantity-" + id);
    let newQuantity = parseInt(quantityInput.value) + change;
    if (newQuantity < 1) newQuantity = 1;
    quantityInput.value = newQuantity;
}

// Wait for document to load
$(document).ready(function () {
    $(".add-to-cart-button").click(function () {
        let productDiv = $(this).closest(".product");
        let productId = productDiv.data("id");
        let quantity = $("#quantity-" + productId).val();

        // Show alert box
        alert(`✅ Item added successfully! \nProduct ID: ${productId} \nQuantity: ${quantity}`);
    });
});
