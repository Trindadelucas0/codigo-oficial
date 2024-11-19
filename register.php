<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } else {
        if (register($name, $email, $password)) {
            header('Location: login.php');
            exit();
        } else {
            $error = 'Email already exists';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - STYLISH</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="pt-20">
        <div class="max-w-md mx-auto px-4 py-8">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold mb-6">Create Account</h1>
                
                <?php if ($error): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="register.php">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 mb-2">Name</label>
                        <input type="text" id="name" name="name" required
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-gray-500">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-gray-500">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-gray-500">
                    </div>

                    <div class="mb-6">
                        <label for="confirm_password" class="block text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-gray-500">
                    </div>

                    <button type="submit" class="w-full bg-gray-900 text-white py-2 px-4 rounded-lg hover:bg-gray-800">
                        Register
                    </button>
                </form>

                <p class="mt-4 text-center text-gray-600">
                    Already have an account? <a href="login.php" class="text-gray-900 hover:underline">Login</a>
                </p>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>