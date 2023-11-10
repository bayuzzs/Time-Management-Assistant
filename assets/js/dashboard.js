function toggleSidebar() {
  let sidebar = document.querySelector('.sidebar');
  sidebar.classList.toggle('active');
}
function toggleEdit() {
  const parentButtons = document.querySelector(
    '.activity__content-item__right-action'
  );
  const buttons = document.querySelectorAll(
    '.activity__content-item__right-action .btn'
  );
  console.log(parentButtons);
  parentButtons.classList.toggle('show');
  buttons.forEach((button) => {
    button.classList.toggle('show');
  });
}
