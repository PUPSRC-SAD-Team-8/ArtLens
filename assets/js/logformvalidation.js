
  document.getElementById('mobile1').addEventListener('input', function (e) {
    // Remove any non-numeric characters
    e.target.value = e.target.value.replace(/[^0-9]/g, '');

    // Limit to 11 characters
    if (e.target.value.length > 11) {
      e.target.value = e.target.value.slice(0, 11);
    }
  });

  // Prevent input of 'e', '+', '-', '.' and any non-digit characters
  document.getElementById('mobile1').addEventListener('keypress', function (e) {
    if (e.key < '0' || e.key > '9') {
      e.preventDefault();
    }
  });
  

  function toggleFields() {
    var status = document.getElementById('modal-status').value;
    var organizationFields = document.querySelector('.organization');
    var individualFields = document.querySelector('.individual');

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
}

document.addEventListener('DOMContentLoaded', (event) => {
    toggleFields(); // Ensure the fields are toggled correctly on page load
});

