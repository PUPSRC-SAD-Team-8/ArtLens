
var modal = document.getElementById("myModal1");
var span = document.getElementsByClassName("close2")[0];

span.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



function showForm() {
    document.getElementById("formContent").classList.remove("hidden");
    document.getElementById("statusContent").classList.add("hidden");
    document.getElementById("modalTitle").textContent = "Booking Form";
    document.querySelector(".btn-toggle.form").style.backgroundColor = "#4169E1";
    document.querySelector(".btn-toggle.form").style.color = "white"; // Set text color to white
    document.querySelector(".btn-toggle.status").style.backgroundColor = "white";
    document.querySelector(".btn-toggle.status").style.color = "black"; // Set text color to black
}

function showStatus() {
    document.getElementById("formContent").classList.add("hidden");
    document.getElementById("statusContent").classList.remove("hidden");
    document.getElementById("modalTitle").textContent = "Booking Status";
    document.querySelector(".btn-toggle.form").style.backgroundColor = "white";
    document.querySelector(".btn-toggle.form").style.color = "black"; // Set text color to black
    document.querySelector(".btn-toggle.status").style.backgroundColor = "#4169E1";
    document.querySelector(".btn-toggle.status").style.color = "white"; // Set text color to white
}

// Set default text color
document.querySelector(".btn-toggle.form").style.color = "white"; // Default text color for form button
document.querySelector(".btn-toggle.status").style.color = "black"; // Default text color for status button

function checkStatus() {
    // Retrieve the reference number
    var referenceNumber = document.querySelector('#statusContent input[name="contact_email"]').value;

    // AJAX request to send the reference number to check_status.php
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "check_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from check_status.php
            document.getElementById('statusMessage').innerHTML = xhr.responseText;
            // Hide the image when search is made
            document.getElementById('noInfoImage').style.display = 'none';
            // Change the background color to blue
            document.getElementById('imageContainer').style.backgroundColor = '#4169E1';
        }
    };
    xhr.send("contact_email=" + referenceNumber); // Send the reference number as POST data
}
// time and date validation
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById('dati');
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1); // Set date to tomorrow

    // Calculate minimum datetime string
    const minDateTime = tomorrow.toISOString().slice(0, 16); // Format as YYYY-MM-DDTHH:mm

    // Set attribute for input element
    input.setAttribute('min', minDateTime);

    // Validate time on input change
    input.addEventListener('input', function () {
        const selectedDateTime = new Date(this.value);
        const selectedTime = selectedDateTime.getHours() * 100 + selectedDateTime.getMinutes(); // Convert time to 24-hour format HHmm

        const minTime = 900; // 9:00 AM in HHmm format (900)
        const maxTime = 1600; // 4:00 PM in HHmm format (1600)

        if (selectedTime < minTime || selectedTime > maxTime) {
            this.setCustomValidity(`Please select a time between 9:00 AM and 4:00 PM.`);
            document.getElementById("bookButton").setAttribute('required', '');

        } else {
            this.setCustomValidity('');
        }
    });
});
// time and date validation end

//start of booking form date and email validation
function handleSubmit(event) {
    event.preventDefault();

    // Show loading spinner
    document.getElementById('submitText').style.display = 'none';
    document.getElementById('loadingSpinner').classList.remove('visually-hidden');

    // Collect form data
    var formData = new FormData(document.getElementById('bookingForm'));

    // Send form data via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'booking.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) { // Check for successful response
                var response = xhr.responseText.trim();
                if (response === 'success') {
                    // Show success alert after a short delay (e.g., 3 seconds)
                    setTimeout(function () {
                        document.getElementById('alertMessage').classList.remove('d-none');
                        // Reset form fields
                        document.getElementById('bookingForm').reset();
                        // Clear email status and enable submit button
                        document.getElementById('emailStatus').innerHTML = '';
                        document.getElementById('emal').classList.remove('input-error');
                        document.getElementById('emal').classList.remove('border-red');
                    }, 3000); // Adjust delay as needed
                } else {

                }
            }


            // Hide loading spinner after request completes
            setTimeout(function () {
                document.getElementById('submitText').style.display = 'inline';
                document.getElementById('loadingSpinner').classList.add('visually-hidden');
            }, 3000); // Adjust delay as needed
        } else if (xhr.status === 400) {
            var response = xhr.responseText.trim();

            if (response.includes('Invalid OTP')) {
                document.getElementById('otpStatus').textContent = 'Invalid OTP';
            }

        }
    };
    xhr.onerror = function () {


        // Hide loading spinner on error
        document.getElementById('submitText').style.display = 'inline';
        document.getElementById('loadingSpinner').classList.add('visually-hidden');
    };
    xhr.send(formData);
}

// Function to check email and date on input change
function checkBookingAvailability() {
    var email = document.getElementById('emal').value.trim();
    var datetime = document.getElementById('dati').value.trim();

    if (email === '' || datetime === '') {
        // Clear email status if email or date field is empty
        document.getElementById('emailStatus').innerHTML = '';
        document.getElementById('emal').classList.remove('input-error');
        document.getElementById('emal').classList.remove('border-red');
        return;
    }

    // AJAX request to check if email has a booking on the same day
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    formData.append('emal', email);
    formData.append('dati', datetime);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) { // Check for successful response
                var response = xhr.responseText.trim();
                if (response === 'exists_same_day') {
                    // Show error message for existing booking on the same day
                    document.getElementById('emailStatus').innerHTML = '<p style="color: red; font-size: smaller;">Email already has a booking on the same day.</p>';
                    document.getElementById('emal').classList.add('input-error');
                    document.getElementById('emal').classList.add('border-red');

                } else {
                    // Clear email status and enable submit button if no booking exists

                    document.getElementById('emal').classList.remove('input-error');
                    document.getElementById('emal').classList.remove('border-red');

                }
            } else {
            }
        }
    };

    xhr.open('POST', 'check_booking_availability.php', true); // Replace with the PHP file to check booking availability
    xhr.send(formData);
}

// Event listeners for input fields
document.getElementById('emal').addEventListener('input', checkBookingAvailability);
document.getElementById('dati').addEventListener('change', checkBookingAvailability);

// Event listener for form submission
document.getElementById('bookingForm').addEventListener('submit', handleSubmit);

//end of booking form

function dismissAlert() {
    document.getElementById('alertMessage').classList.add('d-none');
}

function preventInvalidInput(e) {
    const invalidChars = ['-', 'e', '+', '.'];
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
}

function restrictMobileInput(e) {
    const allowedKeys = [
        'Backspace', 'ArrowLeft', 'ArrowRight', 'Delete', 'Tab'
    ];
    if (allowedKeys.includes(e.key)) {
        return;
    }
    if (e.key < '0' || e.key > '9' || e.target.value.length >= 11) {
        e.preventDefault();
    }
}

window.onload = function () {
    setMinDateTime();
    document.getElementsByName("numa")[0].addEventListener("keydown", preventInvalidInput);
    document.getElementsByName("nufe")[0].addEventListener("keydown", preventInvalidInput);
    document.getElementsByName("monu")[0].addEventListener("keydown", restrictMobileInput);
};
