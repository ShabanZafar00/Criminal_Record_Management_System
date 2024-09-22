

  function toggleFields() {
    const checking = document.getElementById('checking').value;
    const additionalFields = document.getElementById('additionalFields');
  
    if (checking === 'Officer') {
      additionalFields.style.display = 'table-row';
    } else {
      additionalFields.style.display = 'none';
    }
  }
  