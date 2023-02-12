let checkbox = document.querySelector('.check-guardian');
let guardianDetails = document.querySelector('.guardian-details');
let selectGuardian = document.querySelector('.select-guardian');

checkbox.addEventListener('click', function handleClick() {
  if (checkbox.checked) {
    selectGuardian.classList.remove('d-none');
    guardianDetails.style.display = 'none';
  } else {
    selectGuardian.classList.add('d-none');
    guardianDetails.style.display = 'block';
  }
});
