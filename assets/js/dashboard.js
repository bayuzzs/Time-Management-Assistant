// munculin add sama edit yang ada di pojok kanan bawah dashboard
function toggleAction() {
  document.querySelector('.activity__action').classList.toggle('show');
  document.querySelector('.activity__action-add').classList.toggle('show');
  document.querySelector('.activity__action-edit').classList.toggle('show');
}

// munculin modal buat tambah data
function showModalAdd() {
  document.querySelector('.modal').classList.add('show');
  document.querySelector('.modal__add').classList.add('show');
  document.querySelector('.modal__add__form-title').focus();
}

// sembunyiin modal buat tambah data
function hideModalAdd() {
  document.querySelector('.modal').classList.remove('show');
  document.querySelector('.modal__add').classList.remove('show');
}

function showModalDelete(event) {
  const currentCard = event.currentTarget.parentNode.parentNode.parentNode;
  let title = currentCard.querySelector(
    '.activity__content-item__left-title'
  ).innerHTML;
  document.querySelector(
    '.modal__delete-title'
  ).innerHTML = `Are you sure you want to delete "<b>${title}</b>" activity?`;
  document.querySelector('.modal').classList.add('show');
  document.querySelector('.modal__delete').classList.add('show');
  document.querySelector('.modal__delete__form-id').value =
    event.currentTarget.dataset.id;
}

// sembunyiin modal buat delete data
function hideModalDelete() {
  document.querySelector('.modal').classList.remove('show');
  document.querySelector('.modal__delete').classList.remove('show');
}

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
