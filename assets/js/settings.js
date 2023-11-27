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
