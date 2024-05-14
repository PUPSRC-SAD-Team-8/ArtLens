<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/forgotpassword.css">
    <script>
        function toggleVerification(event) {
            var email = document.getElementById('email-input').value.trim();
            var emailError = document.getElementById('email-error');
            if (email === "") {
                emailError.innerText = "Please enter your email.";
                return false; // Prevent form submission
            } else {
                emailError.innerText = ""; // Clear error message
            }
            document.getElementById('reset-section').style.display = 'none';
            document.getElementById('verification-section').style.display = 'block';
            return false; // Prevent form submission
        }

        function moveToNext(input, nextInputId) {
            if (input.value.length >= input.maxLength) {
                document.getElementById(nextInputId).focus();
            }
        }

        function verifyCode() {
            var verificationInputs = document.getElementsByClassName('verification-input');
            var verificationError = document.getElementById('verification-error');
            for (var i = 0; i < verificationInputs.length; i++) {
                if (verificationInputs[i].value.trim() === "") {
                    verificationError.innerText = "Please fill in all verification code fields.";
                    return false; // Prevent form submission
                }
            }
            verificationError.innerText = ""; // Clear error message
            document.getElementById('verification-section').style.display = 'none';
            document.getElementById('password-section').style.display = 'block';
            return false; // Prevent form submission
        }
    </script>
</head>
<body>
    <nav class="head navbar navbar-expand-lg navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <h1 style="color: white; font-family: 'Arial Grook', sans-serif;"><b>ArtLens</b></h1>
            <a class="nav-link admin-login-mobile btn1 homebtn" href="index.php">Home</a>
        </div>
    </nav>
    <div class="container container-center">
        <div class="row">
            <div class="col-md-6">
                <img style="max-width: 100%;" src="assets/images/pass.jpg">
            </div>
            <div id="reset-section" class="col-md-6" style="background-color: aliceblue; padding: 20px; margin-top: 5%; height: 50%; width: 40%;">
                <h3>Forgot Password</h3>
                <hr>
                <form id="reset-form" onsubmit="return toggleVerification(event)">
                    <label class="form-label">Enter Email</label>
                    <input id="email-input" class="form-control" type="email" placeholder="juan@gmail.com" required>
                    <div id="email-error" style="color: red; font-size: 12px;"></div>
                    <br>
                    <button id="reset-btn" class="btn btn-primary" style="width: 100%">Reset</button>
                    <div class="text-center mt-3">
                        <a href="index.php" class="link-bank" style="color: gray; text-decoration: none;">Back to Sign in</a>
                    </div>
                </form>
            </div>
            <div id="verification-section" class="col-md-6" style="background-color: aliceblue; padding: 20px; display: none; margin-top: 5%; height: 50%; width: 40%;">
                <h3>Verification</h3>
                <hr>
                <center><p>Your Code was sent to you via Email</p></center>
                <form onsubmit="return verifyCode()">
                    <div class="mb-3">
                        <label class="form-label">Enter Verification Code</label>
                        <div class="d-flex justify-content-between">
                            <input id="verification-input-1" class="form-control verification-input" style="width: 100px;" type="text" maxlength="1" required oninput="moveToNext(this, 'verification-input-2')">
                            <input id="verification-input-2" class="form-control verification-input" style="width: 100px;" type="text" maxlength="1" required oninput="moveToNext(this, 'verification-input-3')">
                            <input id="verification-input-3" class="form-control verification-input" style="width: 100px;" type="text" maxlength="1" required oninput="moveToNext(this, 'verification-input-4')">
                            <input id="verification-input-4" class="form-control verification-input" style="width: 100px;" type="text" maxlength="1" required>
                        </div>
                        <div id="verification-error" style="color: red; font-size: 12px;"></div>
                    </div>
                    <button class="btn btn-primary btn-block" style="width: 100%">Verify</button>
                    <div class="text-center mt-3">
                        <a href="index.php" class="link-bank" style="color: gray; text-decoration: none;">Back to Sign in</a>
                    </div>
                </form>
            </div>
            <div id="password-section" class="col-md-6" style="background-color: aliceblue; padding: 20px; display: none; margin-top: 5%; height: 50%; width: 40%;">
                <h3>New Password</h3>
                <hr>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Enter New Password</label>
                        <input class="form-control" type="password">
                        <label class="form-label">Confirm Password</label>
                        <input class="form-control" type="password">
                        <br>
                        <button class="btn btn-primary btn-block" style="width: 100%">Change Password</button>
                        <div class="text-center mt-3">
                            <a href="index.php" class="link-bank" style="color: gray; text-decoration: none;">Back to Sign in</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
