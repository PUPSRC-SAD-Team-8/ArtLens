
function validateForm() {
    let isValid = true;

    // Perform final validation checks
    isValid = validateInput('firstNameInput', 'firstNameError') && isValid;
    isValid = validateInput('lastNameInput', 'lastNameError') && isValid;
    isValid = validateMiddleInitial() && isValid; // Validate middle initial separately
    isValid = validateInput('emailInput', 'emailError') && isValid;
    isValid = validateInput('mobileNumberInput', 'mobileNumberError') && isValid;
    isValid = validateInput('employeeIdInput', 'employeeIdError') && isValid;

    document.getElementById('saveChangesBtn').disabled = !isValid;
    return isValid;
}

function validateMiddleInitial() {
    let inputElement = document.getElementById('middleInitialInput');
    let value = inputElement.value.trim();

    // Validate middle initial
    if (value.length !== 1 || !/[A-Za-z]/.test(value)) {
        inputElement.classList.add('is-invalid');
        inputElement.setCustomValidity('Please enter a valid middle initial (one letter only).');
        return false;
    } else {
        inputElement.classList.remove('is-invalid');
        inputElement.setCustomValidity('');
        return true;
    }
}

function validateInput(inputId, errorId) {
    let inputElement = document.getElementById(inputId);
    let errorElement = document.getElementById(errorId);
    let value = inputElement.value.trim();
    let isValid = true;
    let message = '';

    // Determine validation rule based on input id
    if (inputId === 'emailInput') {
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(value)) {
            isValid = false;
            message = 'Please enter a valid email address.';
        }
    } else if (inputId === 'mobileNumberInput') {
        let mobilePattern = /^(\+63|09)\d{9}$/;
        if (!mobilePattern.test(value) || /\D/.test(value)) {
            isValid = false;
            message = 'Please enter a valid mobile number starting with +63 or 09';
        }
    } else if (inputId === 'employeeIdInput') {
        let employeeIdPattern = /^\d{3}-\d{3}$/;
        if (!employeeIdPattern.test(value)) {
            isValid = false;
            message = 'Please enter a valid Employee ID in the format 000-000.';
        }
    }

    // Update UI based on validation
    if (!isValid) {
        inputElement.classList.add('is-invalid');
        errorElement.textContent = message;
    } else {
        inputElement.classList.remove('is-invalid');
        errorElement.textContent = '';
    }

    checkFormValidity();
    return isValid;
}

function checkFormValidity() {
    const form = document.getElementById('employeeForm');
    const inputs = form.querySelectorAll('input');
    let isValid = true;

    inputs.forEach(input => {
        if (input.classList.contains('is-invalid')) {
            isValid = false;
        }
    });

    document.getElementById('saveChangesBtn').disabled = !isValid;
}

function toggleEdit() {
    let formElements = document.querySelectorAll('#employeeForm input');
    formElements.forEach(element => {
        if (element.type !== 'hidden' && element.type !== 'button') {
            element.removeAttribute('readonly');
        }
    });
    document.getElementById('saveChangesBtn').style.display = 'block';
    document.getElementById('saveChangesBtn').disabled = true; // Disable button initially
}

