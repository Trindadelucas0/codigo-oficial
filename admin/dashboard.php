<?php
session_start();
require_once '../includes/auth.php';
require_once '../includes/db.php';

// Check if user is logged in and is an admin
if (!isAdmin()) {
    header('Location: ../login.php');
    exit();
}

// Get statistics
$stmt = $pdo->query("SELECT COUNT(*) as total FROM products");
$totalProducts = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role = 'user'");
$totalUsers = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM orders");
$totalOrders = $stmt->fetch()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - STYLISH</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>STYLISH Admin</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="active">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="products.php">
                    <i class="fas fa-tshirt"></i> Products
                </a>
                <a href="orders.php">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
                <a href="users.php">
                    <i class="fas fa-users"></i> Users
                </a>
                <a href="../logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="content-header">
                <h1>Dashboard</h1>
                <div class="admin-info">
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                </div>
            </header>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Products</h3>
                        <p><?php echo $totalProducts; ?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Users</h3>
                        <p><?php echo $totalUsers; ?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Orders</h3>
                        <p><?php echo $totalOrders; ?></p>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <section class="recent-orders">
                <h2>Recent Orders</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $pdo->query("
                                SELECT o.*, u.name as customer_name 
                                FROM orders o 
                                JOIN users u ON o.user_id = u.id 
                                ORDER BY o.created_at DESC 
                                LIMIT 5
                            ");
                            while ($order = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>#" . htmlspecialchars($order['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($order['customer_name']) . "</td>";
                                echo "<td>" . date('M d, Y', strtotime($order['created_at'])) . "</td>";
                                echo "<td><span class='status " . strtolower($order['status']) . "'>" . 
                                     htmlspecialchars($order['status']) . "</span></td>";
                                echo "<td>$" . number_format($order['total'], 2) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script src="../assets/js/admin.js"></script>
</body>
</html>