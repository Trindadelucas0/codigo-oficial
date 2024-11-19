<?php
session_start();
require_once '../includes/auth.php';
require_once '../includes/db.php';

// Check if user is logged in and is an admin
if (!isAdmin()) {
    header('Location: ../login.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $stock = $_POST['stock'];
            $image_url = $_POST['image_url'];

            $stmt = $pdo->prepare("
                INSERT INTO products (name, description, price, category, stock, image_url) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$name, $description, $price, $category, $stock, $image_url]);
        }
    }
}

// Get all products
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management - STYLISH Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <?php include 'includes/admin-sidebar.php'; ?>

        <!-- Main Content -->
        <main class="main-content">
            <header class="content-header">
                <h1>Products Management</h1>
                <button class="btn-primary" onclick="openAddProductModal()">
                    <i class="fas fa-plus"></i> Add New Product
                </button>
            </header>

            <!-- Products Table -->
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>"
                                     class="product-thumbnail">
                            </td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo htmlspecialchars($product['category']); ?></td>
                            <td>$<?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo $product['stock']; ?></td>
                            <td>
                                <button class="btn-icon" onclick="editProduct(<?php echo $product['id']; ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon delete" onclick="deleteProduct(<?php echo $product['id']; ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Add Product Modal -->
    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Product</h2>
            <form id="addProductForm" method="POST" action="products.php">
                <input type="hidden" name="action" value="add">
                
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" required>
                </div>

                <div class="form-group">
                    <label for="image_url">Image URL</label>
                    <input type="url" id="image_url" name="image_url" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Add Product</button>
                    <button type="button" class="btn-secondary" onclick="closeAddProductModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/admin.js"></script>
</body>
</html>