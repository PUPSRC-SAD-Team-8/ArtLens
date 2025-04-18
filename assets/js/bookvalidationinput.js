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

        // Check if all required fields are filled
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

        // Validate male and female inputs
        const maleValue = parseInt(maleInput.value) || 0;
        const femaleValue = parseInt(femaleInput.value) || 0;
        const total = maleValue + femaleValue;

        if (maleValue > 50) {
            allFilled = false;
            maleInput.classList.add('is-invalid');
            maleError.textContent = "Only numbers below 50 are allowed.";
        } else {
            maleInput.classList.remove('is-invalid');
            maleError.textContent = "";
        }

        if (femaleValue > 50) {
            allFilled = false;
            femaleInput.classList.add('is-invalid');
            femaleError.textContent = "Only numbers below 50 are allowed.";
        } else {
            femaleInput.classList.remove('is-invalid');
            femaleError.textContent = "";
        }

        if (total > 50) {
            allFilled = false;
            maleInput.classList.add('is-invalid');
            femaleInput.classList.add('is-invalid');
            maleError.textContent = `Total cannot exceed 50. Currently, ${femaleValue} female(s) are entered.`;
            femaleError.textContent = `Total cannot exceed 50. Currently, ${maleValue} male(s) are entered.`;
            emailStatus.style.color = '#dc3545';
            emailStatus.style.fontSize = 'smaller';
        } else {
            maleInput.classList.remove('is-invalid');
            femaleInput.classList.remove('is-invalid');
            maleError.textContent = "";
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
