function toggleEdit() {
  const parentButtons = document.querySelectorAll(
    '.activity__content-item__right-action'
  );
  const buttons = document.querySelectorAll(
    '.activity__content-item__right-action .btn'
  );
  parentButtons.forEach((button) => {
    button.classList.toggle('show');
  });
  buttons.forEach((button) => {
    button.classList.toggle('show');
  });
}

// if the browser has render the page
document.addEventListener('DOMContentLoaded', function () {
  // for alert
  const message = document.querySelector('.alert');
  if (message) {
    setTimeout(function () {
      message.classList.add('alert-hide');
    }, 2500);
  }
});
