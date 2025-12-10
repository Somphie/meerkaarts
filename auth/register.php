<div class="register-popup">
    <div class="login-container">
        <div class="login-header">
            <h2>Create Account</h2>
        </div>
        <div class="login-form-content">
            <?php
            if (isset($_SESSION['error'])) {
                echo '<p style="color: red; text-align: center;">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>
            <form action="../auth/actions/register_action.php" method="POST">
                <div class="input-group">
                    <label for="reg-username">Username</label>
                    <input type="text" id="reg-username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="reg-email">Email</label>
                    <input type="email" id="reg-email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="reg-password">Password</label>
                    <input type="password" id="reg-password" name="password" required>
                </div>
                <div class="input-group">
                    <label for="reg-password-confirm">Confirm Password</label>
                    <input type="password" id="reg-password-confirm" name="password_confirm" required>
                </div>
                <div class="login-actions">
                    <button type="submit" class="login-btn">Register</button>
                </div>
            </form>
            <a href="javascript:void(0)" class="signin-link" style="text-align: center; display: block; margin-top: 15px; color: #0000EE; text-decoration: underline; font-size: 12px;">Already have an account? Sign In</a>
        </div>
    </div>
</div>