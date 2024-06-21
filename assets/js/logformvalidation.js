
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
  

