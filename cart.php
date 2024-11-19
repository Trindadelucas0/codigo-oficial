<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/auth.php';

requireLogin();

// Get cart items
$stmt = $pdo->prepare("
    SELECT c.*, p.name, p.price, p.image_url 
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$cartItems = $stmt->fetchAll();

// Calculate total
$total = 0;
foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - STYLISH</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="pt-20">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>

            <?php if (empty($cartItems)): ?>
                <div class="text-center py-8">
                    <p class="text-gray-600 mb-4">Your cart is empty</p>
                    <a href="index.php" class="inline-block bg-gray-900 text-white px-6 py-2 rounded-lg hover:bg-gray-800">
                        Continue Shopping
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="md:col-span-2">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="flex items-center gap-4 p-4 bg-white rounded-lg shadow-md mb-4">
                                <img src="<?php echo htmlspecialchars($item['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($item['name']); ?>"
                                     class="w-24 h-24 object-cover rounded">
                                
                                <div class="flex-1">
                                    <h3 class="font-semibold"><?php echo htmlspecialchars($item['name']); ?></h3>
                                    <p class="text-gray-600">$<?php echo number_format($item['price'], 2); ?></p>
                                    
                                    <div class="flex items-center gap-2 mt-2">
                                        <button class="quantity-btn" data-action="decrease" data-id="<?php echo $item['id']; ?>">-</button>
                                        <span class="quantity"><?php echo $item['quantity']; ?></span>
                                        <button class="quantity-btn" data-action="increase" data-id="<?php echo $item['id']; ?>">+</button>
                                    </div>
                                </div>

                                <button class="remove-item" data-id="<?php echo $item['id']; ?>">
                                    <i class="fas fa-trash text-red-500"></i>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Order Summary -->
                    <div class="bg-white p-6 rounded-lg shadow-md h-fit">
                        <h2 class="text-xl font-bold mb-4">Order Summary</h2>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span>$<?php echo number_format($total, 2); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping</span>
                                <span>Free</span>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <div class="flex justify-between font-bold">
                                <span>Total</span>
                                <span>$<?php echo number_format($total, 2); ?></span>
                            </div>
                        </div>

                        <button class="w-full bg-gray-900 text-white py-3 rounded-lg mt-6 hover:bg-gray-800">
                            Proceed to Checkout
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        // Cart functionality
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', async function() {
                const id = this.dataset.id;
                const action = this.dataset.action;
                
                try {
                    const response = await fetch('api/cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id, action }),
                    });
                    
                    if (response.ok) {
                        location.reload();
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });

        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', async function() {
                const id = this.dataset.id;
                
                try {
                    const response = await fetch('api/cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id, action: 'remove' }),
                    });
                    
                    if (response.ok) {
                        location.reload();
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>
</body>
</html>