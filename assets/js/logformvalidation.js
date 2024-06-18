document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("logForm").addEventListener("submit", handleLogFormSubmit);

    // Apply number-only validation to all number inputs
    var numberInputs = document.querySelectorAll("input[type='number']");
    numberInputs.forEach(function(input) {
        input.addEventListener('keypress', function(event) {
            if (!isNumberKey(event)) {
                event.preventDefault();
            }
        });
        input.addEventListener('input', function() {
            if (!this.value.match(/^[0-9]*$/)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
            validateNumberInput(this);
        });
    });

    toggleFields();
});

function toggleFields() {
    var status = document.getElementById("modal-status").value;
    if (status === "Organization") {
        document.getElementById("organizationFields").classList.remove("hidden");
        document.getElementById("individualFields").classList.add("hidden");
    } else {
        document.getElementById("organizationFields").classList.add("hidden");
        document.getElementById("individualFields").classList.remove("hidden");
    }
}

function handleLogFormSubmit(event) {
    event.preventDefault();

    var form = document.getElementById("logForm");
    var inputs = form.querySelectorAll("input[required], select[required]");
    var isValid = true;

    inputs.forEach(function(input) {
        if (!input.checkValidity() || input.classList.contains("input-error")) {
            input.classList.add("input-error");
            isValid = false;
        } else {
            input.classList.remove("input-error");
        }
    });

    if (isValid) {
        form.submit();
    }
}

function isNumberKey(event) {
    var charCode = event.which ? event.which : event.keyCode;
    return (charCode >= 48 && charCode <= 57); // Only numbers 0-9
}

function validateNumberInput(input) {
    var value = parseInt(input.value, 10);
    var errorMsg = '';

    if (value > 50) {
        errorMsg = 'Only accepts less than 50 persons';
        input.classList.add('input-error');
    } else {
        input.classList.remove('input-error');
    }

    var errorElement = input.nextElementSibling;
    if (!errorElement || !errorElement.classList.contains('error-message')) {
        errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        input.parentNode.appendChild(errorElement);
    }

    errorElement.textContent = errorMsg;
    errorElement.style.color = 'red';
}
