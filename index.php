<?php
$title = "STYLISH - Your Fashion Destination";
include 'includes/header.php';
?>

<main>
  <!-- Hero Section -->
  <div class="hero">
    <div class="hero-content">
      <h1>Summer Collection 2024</h1>
      <p>Discover our latest collection of trendy and comfortable clothing for every occasion.</p>
      <button class="btn-primary">Shop Now</button>
    </div>
  </div>

  <!-- Categories -->
  <section class="categories">
    <div class="container">
      <h2>Shop by Category</h2>
      <div class="category-grid">
        <div class="category-card" data-category="men">
          <div class="category-image">
            <img src="https://images.unsplash.com/photo-1490578474895-699cd4e2cf59?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Men's Fashion">
          </div>
          <div class="category-content">
            <h3>Men</h3>
            <button class="btn-secondary">Shop Now</button>
          </div>
        </div>
        <div class="category-card" data-category="women">
          <div class="category-image">
            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Women's Fashion">
          </div>
          <div class="category-content">
            <h3>Women</h3>
            <button class="btn-secondary">Shop Now</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Products -->
  <section class="featured-products">
    <div class="container">
      <h2>Featured Products</h2>
      <div class="product-grid">
        <?php include 'includes/featured-products.php'; ?>
      </div>
    </div>
  </section>

  <!-- Newsletter -->
  <section class="newsletter">
    <div class="container">
      <i class="icon-mail"></i>
      <h2>Subscribe to our newsletter</h2>
      <p>Get the latest updates on new products and upcoming sales</p>
      <form id="newsletter-form" class="newsletter-form">
        <input type="email" placeholder="Enter your email" required>
        <button type="submit" class="btn-primary">Subscribe</button>
      </form>
    </div>
  </section>
</main>

<?php include 'includes/footer.php'; ?>