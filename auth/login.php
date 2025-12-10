<div class="login-popup">
        <div class="login-container">
            <div class="login-header">
                <h2>Login</h2>
            </div>
            <div class="login-form-content">
                <form action="../auth/actions/login_action.php" method="POST">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="johnus@donnus.com" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Wachtwoord</label>
                        <input type="password" id="password" name="password" required>
                        <a href="#" class="forgot-password">Wachtwoord vergeten?</a>
                    </div>
                    <div class="login-actions">
                        <button type="submit" class="login-btn">Login</button>
                    </div>
                </form>
                <a href="javascript:void(0)" class="signup-link">registreer</a>
            </div>
        </div>
    </div>
</div>
