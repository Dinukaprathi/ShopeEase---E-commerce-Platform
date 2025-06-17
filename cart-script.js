
//remove item
$(document).ready(function () {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    function updateCartUI() {
        $("#cart-items").empty();
        let total = 0;

        cart.forEach((item, index) => {
            total += item.price * item.quantity;
            $("#cart-items").append(`
                <div>
                    <p>${item.name} - $${item.price} x ${item.quantity}</p>
                    <button class="remove" data-index="${index}">Remove</button>
                </div>
            `);
        });

        $("#cart-total").text(total.toFixed(2));
        $("#cart-count").text(cart.length);
        localStorage.setItem("cart", JSON.stringify(cart));
    }
    //add to cart 
    $(".add-to-cart").click(function () {
        let product = $(this).closest(".product");
        let id = product.data("id");
        let name = product.data("name");
        let price = parseFloat(product.data("price"));

        let existing = cart.find(item => item.id === id);
        if (existing) {
            existing.quantity += 1;
        } else {
            cart.push({ id, name, price, quantity: 1 });
        }

        updateCartUI();
    });
    // remove item from cart
    $(document).on("click", ".remove", function () {
        let index = $(this).data("index");
        cart.splice(index, 1);
        updateCartUI();
    });

    $("#clear-cart").click(function () {
        cart = [];
        updateCartUI();
    });

    updateCartUI();
});
