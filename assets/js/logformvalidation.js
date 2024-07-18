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

/*document.addEventListener('DOMContentLoaded', function() {
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
        const errorMessage = field.parentElement.querySelector('.invalid-feedback');
        if (field.value === '' || value > 50) {
            field.classList.add('is-invalid');
            errorMessage.textContent = value > 50 ? 'Value cannot exceed 50.' : '';
            errorMessage.style.display = 'block'; // Show the error message
            field.setCustomValidity('Invalid');
        } else {
            field.classList.remove('is-invalid');
            errorMessage.style.display = 'none'; // Hide the error message
            field.setCustomValidity('');
        }
    }
});

  // Function to update required attributes based on form mode
  function updateRequiredAttributes(showFields, hideFields) {
    showFields.querySelectorAll('input[required], select[required]').forEach(function(field) {
        if (!field.closest('.form-floating').classList.contains('optional-field')) {
            field.setAttribute('required', '');
        }
    });

    // Remove required attribute specifically for the "MI (Optional)" field
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
        if (!input.value.trim()) {
            isValid = false;
            showError(input, 'This field cannot be blank.');
        } else {
            clearError(input);
        }
    });

    document.getElementById('logButton').disabled = !isValid;
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
});*/