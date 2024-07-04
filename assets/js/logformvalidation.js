

function toggleFields() {
    var status = document.getElementById('modal-status').value;
    var organizationFields = document.querySelector('.organization');
    var individualFields = document.querySelector('.individual');
    var moInput = document.getElementById('mo'); // Assuming 'mo' is the ID of the input field

    if (status === 'Organization') {
        individualFields.style.display = 'none';
        organizationFields.style.display = 'block';

        // Set required attribute for organization fields
        organizationFields.querySelectorAll('input, select').forEach(function(field) {
            field.setAttribute('required', '');
        });

        // Remove required attribute from individual fields
        individualFields.querySelectorAll('input, select').forEach(function(field) {
            field.removeAttribute('required');
        });
    } else {
        organizationFields.style.display = 'none';
        individualFields.style.display = 'block';

        // Set required attribute for individual fields
        individualFields.querySelectorAll('input, select').forEach(function(field) {
            field.setAttribute('required', '');
        });

        // Remove required attribute from organization fields
        organizationFields.querySelectorAll('input, select').forEach(function(field) {
            field.removeAttribute('required');
        });
    }

    // Always remove required attribute from 'mo' input field
    moInput.removeAttribute('required');
}

document.addEventListener('DOMContentLoaded', function() {
    toggleFields(); // Initial toggle on page load
});

function validateAlphabet(input) {
    var field = input.value.trim();

    // Regular expression to match only letters
    var alphabetPattern = /^[a-zA-Z]$/;

    // Check if the input is empty or doesn't match the letter pattern
    if (field !== '' && !alphabetPattern.test(field)) {
        input.value = '';
    }
}

// Attach event listener to validateAlphabet function on input event
document.getElementById('mo').addEventListener('input', function() {
    validateAlphabet(this);
});


function toggleFields() {
    const status = document.getElementById('modal-status').value;
    if (status === 'Individual') {
        document.querySelector('.individual').style.display = 'block';
        document.querySelector('.organization').style.display = 'none';
    } else {
        document.querySelector('.individual').style.display = 'none';
        document.querySelector('.organization').style.display = 'block';
    }
}
function validateForm() {
    const form = document.getElementById('logForm');
    const inputs = form.querySelectorAll('input[required]');
    let isValid = true;
    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            showError(input, 'This field cannot be blank.');
            document.getElementById('logButton').disabled = true;
        } else {
            clearError(input);
            document.getElementById('logButton').disabled = false;
        }
    });
    return isValid;
}

function validateField(input) {
    if (!input.value.trim()) {
        showError(input, 'This field cannot be blank.');
        document.getElementById('logButton').disabled = true;
    } else {
        clearError(input);
        document.getElementById('logButton').disabled = false;
    }
}

function validateFieldNum(input) {
    const phRegex = /^(09|\+639)\d{9}$/;
    if (!input.value.trim()) {
        showError(input, 'This field cannot be blank.');
        document.getElementById('logButton').disabled = true;
    } else if (!phRegex.test(input.value)) {
        showError(input, 'Please enter a valid PH mobile number starting with +63 or 09.');
        document.getElementById('logButton').disabled = true;
    } else {
        clearError(input);
        document.getElementById('logButton').disabled = false;
    }
}

function validateEmail(id) {
    const email = document.getElementById(id);
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim()) {
        showError(email, 'This field cannot be blank.');
        document.getElementById('logButton').disabled = true;
    } else if (!emailRegex.test(email.value)) {
        showError(email, 'Invalid email address.');
        document.getElementById('logButton').disabled = true;
    } else {
        clearError(email);
        document.getElementById('logButton').disabled = false;
    }
}

function showError(input, message) {
    input.classList.add('invalid');
    const errorElement = input.nextElementSibling.nextElementSibling;
    errorElement.textContent = message;
    errorElement.style.display = 'block';
}

function clearError(input) {
    input.classList.remove('invalid');
    const errorElement = input.nextElementSibling.nextElementSibling;
    errorElement.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    const requiredInputs = document.querySelectorAll('input[required]');
    requiredInputs.forEach(input => {
        input.addEventListener('input', () => validateField(input));
        input.addEventListener('blur', () => validateField(input));
    });

    document.getElementById('mobile1').addEventListener('input', () => validateFieldNum(document.getElementById('mobile1')));
    document.getElementById('mobile1').addEventListener('blur', () => validateFieldNum(document.getElementById('mobile1')));

    document.getElementById('email').addEventListener('input', () => validateEmail('email'));
    document.getElementById('email').addEventListener('blur', () => validateEmail('email'));
});