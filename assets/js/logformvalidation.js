function toggleFields() {
    const status = document.getElementById('modal-status').value;
    const organizationFields = document.querySelector('.organization');
    const individualFields = document.querySelector('.individual');

    if (status === 'Organization') {
        individualFields.style.display = 'none';
        organizationFields.style.display = 'block';
        updateRequiredAttributes(organizationFields, individualFields);
    } else {
        organizationFields.style.display = 'none';
        individualFields.style.display = 'block';
        updateRequiredAttributes(individualFields, organizationFields);
    }
}

function updateRequiredAttributes(showFields, hideFields) {
    showFields.querySelectorAll('input, select').forEach(function(field) {
        field.setAttribute('required', '');
    });
    hideFields.querySelectorAll('input, select').forEach(function(field) {
        field.removeAttribute('required');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    toggleFields(); // Initial toggle on page load

    // Optional: Add onchange event listener to 'modal-status' select element
    const modalStatusSelect = document.getElementById('modal-status');
    modalStatusSelect.addEventListener('change', toggleFields);
});

document.addEventListener('DOMContentLoaded', function() {
    const organizationFields = document.getElementsByClassName('organization');
    
    Array.from(organizationFields).forEach(orgField => {
        const numberFields = orgField.querySelectorAll('input[type="number"]');
        
        numberFields.forEach(field => {
            field.addEventListener('input', function() {
                validateField(field);
            });

            field.addEventListener('blur', function() {
                validateField(field);
            });
        });
    });

    function validateField(field) {
        const value = parseInt(field.value, 10);
        if (value > 50) {
            field.classList.add('is-invalid');
            field.setCustomValidity('Invalid');
        } else {
            field.classList.remove('is-invalid');
            field.setCustomValidity('');
        }
        checkFormValidity();
    }
});

function updateRequiredAttributes(showFields, hideFields) {
    showFields.querySelectorAll('input[required], select[required]').forEach(function(field) {
        if (!field.closest('.form-floating').classList.contains('optional-field')) {
            field.setAttribute('required', '');
        }
    });

    const optionalField = showFields.querySelector('#mo');
    if (optionalField) {
        optionalField.removeAttribute('required');
    }

    hideFields.querySelectorAll('input[required], select[required]').forEach(function(field) {
        field.removeAttribute('required');
    });
}

function validateForm() {
    const form = document.getElementById('logForm');
    const status = document.getElementById('modal-status').value;
    let isValid = true;

    if (status === 'Individual') {
        document.querySelectorAll('.organization input, .organization select').forEach(function(field) {
            field.removeAttribute('required');
        });
    } else {
        document.querySelectorAll('.individual input, .individual select').forEach(function(field) {
            field.removeAttribute('required');
        });
    }

    form.querySelectorAll('input[required]').forEach(input => {
        // Exclude specific inputs from validation
        if (input.id !== 'contact_email' && input.name !== 'uname' && input.id !== 'pass') {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        }
    });

    // Validate mobile number and email separately
    validateFieldNum(document.getElementById('mobile1'));
    validateEmail('email');

    // Check if there are any inputs without a value
    const emptyInputs = form.querySelectorAll('input[required]:not(.is-invalid):not([type="hidden"]):not([type="radio"]):not([type="checkbox"]), select[required]:not(.is-invalid)');
    emptyInputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
        }
    });

    document.getElementById('logButton').disabled = !isValid;
    return isValid;
}

function validateField(input) {
    // Exclude specific inputs from adding 'is-invalid' class when empty
    if (input.id !== 'contact_email' && input.name !== 'uname' && input.id !== 'pass') {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            document.getElementById('logButton').disabled = true;
        } else {
            input.classList.remove('is-invalid');
            checkFormValidity();
        }
    }
}

function validateFieldNum(input) {
    const phRegex = /^(09|\+639)\d{9}$/;
    const errorElement = input.nextElementSibling.nextElementSibling; // Assuming error message element follows immediately after the input

    if (!input.value.trim()) {
        input.classList.add('is-invalid');
        errorElement.textContent = ''; // Clear previous message if any
        document.getElementById('logButton').disabled = true;
    } else if (!phRegex.test(input.value)) {
        input.classList.add('is-invalid');
        errorElement.textContent = 'Please enter a valid PH mobile number starting with +63 or 09.';
        document.getElementById('logButton').disabled = true;
    } else {
        input.classList.remove('is-invalid');
        errorElement.textContent = ''; // Clear error message on success
        checkFormValidity();
    }
}

function validateEmail(id) {
    const email = document.getElementById(id);
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const errorElement = email.nextElementSibling.nextElementSibling; // Assuming error message element follows immediately after the input

    if (!email.value.trim()) {
        email.classList.add('is-invalid');
        errorElement.textContent = ''; // Clear previous message if any
        document.getElementById('logButton').disabled = true;
    } else if (!emailRegex.test(email.value)) {
        email.classList.add('is-invalid');
        errorElement.textContent = 'Invalid email address.';
        document.getElementById('logButton').disabled = true;
    } else {
        email.classList.remove('is-invalid');
        errorElement.textContent = ''; // Clear error message on success
        checkFormValidity();
    }
}

function checkFormValidity() {
    const form = document.getElementById('logForm');
    const isValid = !form.querySelectorAll('.is-invalid').length;
    document.getElementById('logButton').disabled = !isValid;
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

    // Initial validation on page load
    validateForm();
});
