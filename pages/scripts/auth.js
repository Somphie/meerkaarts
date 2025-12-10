window.addEventListener('load', function() {
    // Popups and Background
    const loginPopup = document.querySelector('.login-popup');
    const registerPopup = document.querySelector('.register-popup');
    const blurBackground = document.querySelector('.blur-background');

    // Trigger Links
    const navLoginLink = document.getElementById('login-link');
    const switchToRegisterLink = document.querySelector('.signup-link'); // Link in login form
    const switchToLoginLink = document.querySelector('.signin-link'); // Link in register form

    // --- Functions to control visibility ---
    function hideAllPopups() {
        if (loginPopup) loginPopup.style.display = 'none';
        if (registerPopup) registerPopup.style.display = 'none';
        if (blurBackground) blurBackground.style.display = 'none';
    }

    function showLoginPopup() {
        hideAllPopups();
        if (loginPopup) loginPopup.style.display = 'block';
        if (blurBackground) blurBackground.style.display = 'block';
    }

    function showRegisterPopup() {
        hideAllPopups();
        if (registerPopup) registerPopup.style.display = 'block';
        if (blurBackground) blurBackground.style.display = 'block';
    }

    // --- Event Listeners ---

    // When clicking "Login" in the main navigation
    if (navLoginLink) {
        navLoginLink.addEventListener('click', function(event) {
            event.preventDefault();
            showLoginPopup();
        });
    }

    // When clicking "registreer" in the login form
    if (switchToRegisterLink) {
        switchToRegisterLink.addEventListener('click', function(event) {
            event.preventDefault();
            showRegisterPopup();
        });
    }

    // When clicking "Sign In" in the register form
    if (switchToLoginLink) {
        switchToLoginLink.addEventListener('click', function(event) {
            event.preventDefault();
            showLoginPopup();
        });
    }

    // When clicking the dark background
    if (blurBackground) {
        blurBackground.addEventListener('click', hideAllPopups);
    }

    // --- Logic on Page Load ---

    // Check URL for error flags
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('action')) {
        if (urlParams.get('action') === 'login_error') {
            showLoginPopup();
        } else if (urlParams.get('action') === 'register_error') {
            showRegisterPopup();
        }
    } else {
        // Initially hide everything if there are no errors
        hideAllPopups();
    }
});
