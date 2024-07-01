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

function setMinDateTime() {
    let now = new Date();
    now.setDate(now.getDate() + 1);  // Set date to tomorrow
    now.setHours(17, 0, 0, 0);   /*  This is for setting min time to 9AM in UTC but if in ph it is 5pm*/

    console.log(now);
    let minDateTime = now.toISOString().slice(0, 16);  // Format date as YYYY-MM-DDTHH:MM
    console.log(minDateTime);
    document.getElementsByName("dati")[0].setAttribute("min", minDateTime);
}

function validateForm() {
    let form = document.forms["bookingForm"];
    let mobile = form["monu"].value;
    let numMale = parseInt(form["numa"].value, 10);
    let numFemale = parseInt(form["nufe"].value, 10);

    let mobilePattern = /^\d{11}$/;

    if (!mobilePattern.test(mobile)) {
        alert("Please enter a valid 11-digit mobile number.");
        return false;
    }

    if (!Number.isInteger(numMale) || numMale < 0 || numMale > 50) {
        alert("Number of males must be a non-negative integer and not more than 50.");
        return false;
    }

    if (!Number.isInteger(numFemale) || numFemale < 0 || numFemale > 50) {
        alert("Number of females must be a non-negative integer and not more than 50.");
        return false;
    }

    let totalVisitor = parseInt(numFemale) + parseInt(numMale);

    if (!Number.isInteger(totalVisitor) || totalVisitor < 1 || totalVisitor > 50) {
        alert("Invalid Visitor Count"); /* Validate visitor count in total */
        return false;
    }

    return true;
}

function handleSubmit(event) {
    event.preventDefault(); // Prevent default form submission

    // Check if email has future booking
    if (document.getElementById('emal').classList.contains('input-error')) {
        document.getElementById('emal').classList.add('border-red');
        return; // Prevent form submission
    }

    if (!validateForm()) {
        return; // Prevent form submission if form validation fails
    }

    // Show loading spinner and hide button text
    document.getElementById('submitText').style.display = 'none';
    document.getElementById('loadingSpinner').classList.remove('visually-hidden');

    // Collect form data
    var formData = new FormData(document.getElementById('bookingForm'));

    // Send form data via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'booking.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // AJAX request successful, handle response
                var response = xhr.responseText.trim();
                if (response === 'success') {
                    // Show success alert after a short delay (e.g., 2 seconds)
                    setTimeout(function () {
                        document.getElementById('alertMessage').classList.remove('d-none');
                        // Reset form fields
                        document.getElementById('bookingForm').reset();
                        // Clear email status and enable submit button
                        document.getElementById('emailStatus').innerHTML = '';
                        document.getElementById('emal').classList.remove('input-error');
                        document.getElementById('emal').classList.remove('border-red');
                        document.getElementById('submitButton').disabled = false;
                    }, 2000); // Adjust delay as needed
                } else {
                    // Show error message (optional)
                    console.error('Error: ' + response);
                    // Handle error scenario as needed
                }
            } else {
                // AJAX request failed
                console.error('Error: ' + xhr.status);
                // Handle error scenario as needed
            }

            // Reset button text and hide loading spinner
            setTimeout(function () {
                document.getElementById('submitText').style.display = 'inline';
                document.getElementById('loadingSpinner').classList.add('visually-hidden');
            }, 2000); // Adjust delay as needed
        }
    };
    xhr.onerror = function () {
        // Handle AJAX errors
        console.error('Error: AJAX request failed');
        // Reset button text and hide loading spinner on error
        document.getElementById('submitText').style.display = 'inline';
        document.getElementById('loadingSpinner').classList.add('visually-hidden');
    };
    xhr.send(formData);
}

function dismissAlert() {
    document.getElementById('alertMessage').classList.add('d-none');
}

function checkEmail() {
    var email = document.getElementById('emal').value.trim();
    var emailStatusDiv = document.getElementById('emailStatus');

    if (email === '') {
        emailStatusDiv.innerHTML = ''; // Clear email status if email is empty
        document.getElementById('emal').classList.remove('input-error');
        document.getElementById('emal').classList.remove('border-red');
        document.getElementById('submitButton').disabled = false; // Enable submit button
        return; // If email field is empty, do nothing further
    }

    // Send AJAX request to check if email exists
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'check_email.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // AJAX request successful, handle response
                var response = xhr.responseText.trim();

                if (response === 'exists_future') {
                    // Email exists and has future bookings
                    emailStatusDiv.innerHTML = '<span style="color: red;">This email already has a future booking.</span>';
                    document.getElementById('emal').classList.add('input-error');
                    document.getElementById('emal').classList.add('border-red');
                    document.getElementById('submitButton').disabled = true; // Disable submit button
                } else if (response === 'exists_past') {
                    // Email exists but past bookings are allowed (handle this case if needed)
                    emailStatusDiv.innerHTML = ''; // Clear email status
                    document.getElementById('emal').classList.remove('input-error');
                    document.getElementById('emal').classList.remove('border-red');
                    document.getElementById('submitButton').disabled = false; // Enable submit button
                } else if (response === 'not_exists') {
                    // Email does not exist
                    emailStatusDiv.innerHTML = ''; // Clear email status
                    document.getElementById('emal').classList.remove('input-error');
                    document.getElementById('emal').classList.remove('border-red');
                    document.getElementById('submitButton').disabled = false; // Enable submit button
                } else {
                    console.error('Error: Unexpected response');
                    emailStatusDiv.innerHTML = ''; // Clear email status
                    document.getElementById('emal').classList.remove('input-error');
                    document.getElementById('emal').classList.remove('border-red');
                    document.getElementById('submitButton').disabled = false; // Enable submit button
                }
            } else {
                // AJAX request failed
                console.error('Error: ' + xhr.status);
                emailStatusDiv.innerHTML = ''; // Clear email status
                document.getElementById('emal').classList.remove('input-error');
                document.getElementById('emal').classList.remove('border-red');
                document.getElementById('submitButton').disabled = false; // Enable submit button
            }
        }
    };
    xhr.onerror = function () {
        // Handle AJAX errors
        console.error('Error: AJAX request failed');
        emailStatusDiv.innerHTML = ''; // Clear email status
        document.getElementById('emal').classList.remove('input-error');
        document.getElementById('emal').classList.remove('border-red');
        document.getElementById('submitButton').disabled = false; // Enable submit button
    };
    xhr.send('email=' + encodeURIComponent(email));
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