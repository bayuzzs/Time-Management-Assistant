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
