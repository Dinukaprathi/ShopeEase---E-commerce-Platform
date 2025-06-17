<?php
// Get current page for active link highlighting
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header>
    <div class="header-content">
        <div class="logo">
            <i class="fas fa-store"></i>
            ShopEase
        </div>
        <nav>
            <ul>
                <li><a href="index.php" class="<?php echo $current_page === 'index.php' ? 'active' : ''; ?>">
                    <i class="fas fa-home"></i> Home
                </a></li>
                <li><a href="#" class="<?php echo $current_page === 'categories.php' ? 'active' : ''; ?>">
                    <i class="fas fa-th-large"></i> Categories
                </a></li>
                <li><a href="sign-in.php" class="<?php echo $current_page === 'sign-in.php' ? 'active' : ''; ?>">
                    <i class="fas fa-user"></i> Sign in
                </a></li>
                <li><a href="cart.php" class="<?php echo $current_page === 'cart.php' ? 'active' : ''; ?>">
                    <i class="fas fa-shopping-cart"></i> Cart (<span class="cart-count"><?php echo array_sum(array_column($_SESSION['cart'], 'quantity')); ?></span>)
                </a></li>
            </ul>
        </nav>
    </div>
</header>

<style>
    :root {
        --primary-blue: #12195F;
        --secondary-blue: #4285f4;
        --primary-orange: #ff6b00;
        --secondary-orange: #ff8533;
        --text-dark: #202124;
        --text-light: #5f6368;
        --white: #ffffff;
        --gray-light: #f8f9fa;
        --gray-border: #dadce0;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    header {
        background: var(--primary-blue);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 1rem 5%;
        position: sticky;
        top: 0;
        z-index: 1000;
        border-bottom: 3px solid var(--primary-blue);
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--white);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .logo i {
        color: var(--primary-orange);
        font-size: 1.6rem;
    }

    nav ul {
        display: flex;
        list-style: none;
        gap: 2.5rem;
        margin: 0;
    }

    nav ul li a {
        color: var(--white);
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: background 0.2s, color 0.2s;
        position: relative;
    }

    nav ul li a.active, nav ul li a:hover {
        background: var(--secondary-blue);
        color: var(--white);
    }

    nav ul li a.active::after {
        content: '';
        display: block;
        height: 3px;
        width: 60%;
        background: var(--primary-orange);
        border-radius: 2px;
        position: absolute;
        left: 20%;
        bottom: 2px;
    }

    .cart-count {
        background: var(--primary-orange);
        color: var(--white);
        border-radius: 999px;
        padding: 0.2em 0.7em;
        font-size: 0.95em;
        font-weight: bold;
        margin-left: 0.3em;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        transition: background 0.2s;
    }

    @media (max-width: 800px) {
        .header-content {
            flex-direction: column;
            gap: 1rem;
        }
        nav ul {
            gap: 1.2rem;
        }
    }
</style>

<script>
    // Add animation class when cart count updates
    function updateCartCountAnimation() {
        const cartCount = document.querySelector('.cart-count');
        cartCount.classList.add('updated');
        setTimeout(() => {
            cartCount.classList.remove('updated');
        }, 500);
    }
</script> 