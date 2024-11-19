<?php
session_start();
require_once 'includes/db.php';

// Get men's products
$stmt = $pdo->prepare("SELECT * FROM products WHERE category = 'men' ORDER BY created_at DESC");
$stmt->execute();
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Men's Collection - STYLISH</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="pt-20">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <header class="text-center mb-12">
                <h1 class="text-4xl font-bold mb-4">Men's Collection</h1>
                <p class="text-gray-600">Discover our latest men's fashion collection</p>
            </header>

            <!-- Filters -->
            <div class="flex flex-wrap gap-4 mb-8">
                <select class="px-4 py-2 border rounded-lg">
                    <option value="">Sort by</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                    <option value="newest">Newest</option>
                </select>

                <select class="px-4 py-2 border rounded-lg">
                    <option value="">Filter by</option>
                    <option value="t-shirts">T-Shirts</option>
                    <option value="shirts">Shirts</option>
                    <option value="pants">Pants</option>
                    <option value="jackets">Jackets</option>
                </select>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($products as $product): ?>
                    <div class="group relative">
                        <div class="aspect-square w-full overflow-hidden rounded-lg bg-gray-200">
                            <img src="<?php echo htmlspecialchars($product['image_url']); ?>"
                                 alt="<?php echo htmlspecialchars($product['name']); ?>"
                                 class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity">
                            <button class="absolute bottom-4 right-4 bg-white p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity"
                                    onclick="addToCart(<?php echo $product['id']; ?>)">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                <?php echo htmlspecialchars($product['name']); ?>
                            </h3>
                            <p class="text-lg font-semibold text-gray-900">
                                $<?php echo number_format($product['price'], 2); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        function addToCart(productId) {
            fetch('api/cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'add',
                    product_id: productId
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count
                    const cartCount = document.querySelector('.cart-count');
                    cartCount.textContent = parseInt(cartCount.textContent) + 1;
                    
                    // Show notification
                    alert('Product added to cart!');
                }
            });
        }
    </script>
</body>
</html>