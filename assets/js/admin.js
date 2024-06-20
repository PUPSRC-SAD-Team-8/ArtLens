var modal = document.getElementById("myModal");
    var btn = document.getElementById("loginBtn");
    var span = document.getElementsByClassName("close1")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var loginForm = document.getElementById("loginForm");
    var errorMessage = document.getElementById("errorMessage");

    loginForm.addEventListener("submit", function(event) {
        event.preventDefault();

        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;


        if (username === "correct_username" && password === "correct_password") {

            console.log("Login successful");


            modal.style.display = "none";
        } else {
            errorMessage.textContent = "Wrong username or password.";
            modal.style.display = "block";
        }
    });
    
    // JavaScript to toggle password visibility
    const togglePasswordBtn = document.getElementById("togglePassword");
    const passwordField = document.getElementById("pass");

    togglePasswordBtn.addEventListener("click", function() {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            togglePasswordBtn.textContent = "Hide";
        } else {
            passwordField.type = "password";
            togglePasswordBtn.textContent = "Show";
        }
    });