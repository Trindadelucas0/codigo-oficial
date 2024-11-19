<?php
$products = [
    [
        'id' => 1,
        'name' => 'Classic White T-Shirt',
        'price' => 29.99,
        'category' => 'Men',
        'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'
    ],
    [
        'id' => 2,
        'name' => 'Denim Jacket',
        'price' => 89.99,
        'category' => 'Women',
        'image' => 'https://images.unsplash.com/photo-1544642899-f0d6e5f6ed6f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'
    ],
    [
        'id' => 3,
        'name' => 'Summer Dress',
        'price' => 59.99,
        'category' => 'Women',
        'image' => 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'
    ],
    [
        'id' => 4,
        'name' => 'Slim Fit Jeans',
        'price' => 69.99,
        'category' => 'Men',
        'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'
    ]
];

foreach ($products as $product): ?>
    <div class="product-card" data-product-id="<?php echo $product['id']; ?>">
        <div class="product-image">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <button class="add-to-cart" data-product-id="<?php echo $product['id']; ?>">
                <i class="fas fa-shopping-cart"></i>
            </button>
        </div>
        <div class="product-info">
            <p class="product-category"><?php echo $product['category']; ?></p>
            <h3 class="product-name"><?php echo $product['name']; ?></h3>
            <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
        </div>
    </div>
<?php endforeach; ?>