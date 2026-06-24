<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal | Modern Dark Auth</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <?php if ($is_logged_in): ?>
            <div class="card dashboard animate-fade-in">
                <h2>Welcome Back!</h2>
                <p class="user-email">Logged in as: <span><?php echo htmlspecialchars($_SESSION['user_email']); ?></span></p>
                <div class="dynamic-content">
                    <h3>Your Dashboard</h3>
                    <p>This is a dynamic area visible only to authenticated users.</p>
                </div>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
        <?php else: ?>
            <div class="card auth-card">
                <div class="form-toggle">
                    <button id="toggle-login" class="toggle-btn active">Login</button>
                    <button id="toggle-signup" class="toggle-btn">Sign Up</button>
                </div>

                <div id="alert-box" class="alert hidden"></div>

                <form id="login-form" class="auth-form">
                    <h2>Welcome back</h2>
                    <div class="input-group">
                        <label for="login-email">Email Address</label>
                        <input type="email" id="login-email" required placeholder="name@example.com">
                    </div>
                    <div class="input-group">
                        <label for="login-password">Password</label>
                        <input type="password" id="login-password" required placeholder="••••••••">
                    </div>
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </form>

                <form id="signup-form" class="auth-form hidden">
                    <h2>Create Account</h2>
                    <div class="input-group">
                        <label for="signup-email">Email Address</label>
                        <input type="email" id="signup-email" required placeholder="name@example.com">
                    </div>
                    <div class="input-group">
                        <label for="signup-password">Password</label>
                        <input type="password" id="signup-password" required placeholder="Minimum 6 characters">
                    </div>
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script src="script.js"></script>
</body>
</html>