document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('bookingForm');
    const submitButton = document.getElementById('bookButton');
    const emailInput = document.getElementById('emal');
    const mobileInput = document.getElementById('monu');
    const emailStatus = document.getElementById('emailStatus');
    const mobileStatus = document.getElementById('mobileStatus');
    const inputs = form.querySelectorAll('input[required]');

    const maleInput = document.getElementById('numa');
    const femaleInput = document.getElementById('nufe');
    const maleError = document.getElementById('maleError');
    const femaleError = document.getElementById('femaleError');

    function checkFormValidity() {
        let allFilled = true;
        inputs.forEach(input => {
            if (!input.value) {
                allFilled = false;
            }
        });

        // Validate email
        const emailValue = emailInput.value.trim().toLowerCase();
        if (emailInput.classList.contains('touched') && !isValidEmail(emailValue)) {
            allFilled = false;
            emailStatus.textContent = "Please enter a valid email.";
            emailInput.classList.add('is-invalid');
            emailStatus.style.color = '#dc3545';
            emailStatus.style.fontSize = 'smaller';
        } else {
            emailInput.classList.remove('is-invalid');
            emailStatus.textContent = "";
        }

        // Validate mobile number
        const mobileValue = mobileInput.value.trim();
        if (mobileInput.classList.contains('touched') && !isValidMobile(mobileValue)) {
            allFilled = false;
            mobileInput.classList.add('is-invalid');
            mobileStatus.textContent = "Please enter a valid mobile number.";
        } else {
            mobileInput.classList.remove('is-invalid');
            mobileStatus.textContent = "";
        }

        // Validate male input
        const maleValue = parseInt(maleInput.value);
        if (maleValue > 50) {
            allFilled = false;
            maleInput.classList.add('is-invalid');
            maleError.textContent = "Only numbers below 50 are allowed.";
            emailStatus.style.color = '#dc3545';
            emailStatus.style.fontSize = 'smaller';
            submitButton.disabled = !allFilled;
        } else {
            maleInput.classList.remove('is-invalid');
            maleError.textContent = "";
        }

        // Validate female input
        const femaleValue = parseInt(femaleInput.value);
        if (femaleValue > 50) {
            allFilled = false;
            femaleInput.classList.add('is-invalid');
            femaleError.textContent = "Only numbers below 50 are allowed.";
            emailStatus.style.color = '#dc3545';
            emailStatus.style.fontSize = 'smaller';
            submitButton.disabled = !allFilled;
        } else {
            femaleInput.classList.remove('is-invalid');
            femaleError.textContent = "";
        }

        submitButton.disabled = !allFilled;
    }

    function isValidEmail(email) {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const invalidSuffix = /\.c0m$/i;
        return pattern.test(email) && !invalidSuffix.test(email);
    }

    function isValidMobile(mobile) {
        const pattern1 = /^(09|\+639)\d{9}$/;
        const pattern2 = /^(09|\+639)\d{11}$/;
        return pattern1.test(mobile) || pattern2.test(mobile);
    }

    emailInput.addEventListener('input', function() {
        emailInput.classList.add('touched');
        checkFormValidity();
    });

    mobileInput.addEventListener('input', function() {
        mobileInput.classList.add('touched');
        checkFormValidity();
    });

    maleInput.addEventListener('input', function() {
        checkFormValidity();
    });

    femaleInput.addEventListener('input', function() {
        checkFormValidity();
    });

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            checkFormValidity();
        });
    });

    form.addEventListener('submit', function() {
        emailInput.classList.add('touched');
        mobileInput.classList.add('touched');
        checkFormValidity();
    });

    checkFormValidity();
});

document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementById('dati');
    const now = new Date().toISOString().slice(0, 16);
    input.setAttribute('min', now);

    input.addEventListener('change', function() {
        const selectedDateTime = new Date(input.value);
        const hours = selectedDateTime.getHours();

        if (hours < 9 || hours > 16) {
            input.classList.add('input-error', 'border-red');
            displayErrorMessage("Only times between 9 AM and 4 PM are allowed.");
            document.getElementById('bookButton').disabled = true;
        } else {
            input.classList.remove('input-error', 'border-red');
            clearErrorMessage();
        }
    });
});

function displayErrorMessage(message) {
    const errorContainer = document.getElementById('dateTimeError');
    errorContainer.textContent = message;
    errorContainer.style.display = 'block';
}

function clearErrorMessage() {
    const errorContainer = document.getElementById('dateTimeError');
    errorContainer.style.display = 'none';
    errorContainer.textContent = '';
}
