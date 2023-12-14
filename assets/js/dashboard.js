// if the browser has render the page
document.addEventListener('DOMContentLoaded', function () {
  // for alert
  const message = document.querySelector('.alert');
  if (message) {
    setTimeout(function () {
      message.classList.add('alert-hide');
    }, 2500);
  }
  // if user doesn't have activities
  const isCardExist = document.querySelectorAll('.activity__content-item');
  if (!isCardExist.length) {
    // disable search and filter button
    const searchBtn = document.querySelector(
      '.activity__heading-action .search'
    );
    searchBtn.disabled = true;
    searchBtn.classList.add('disabled');
    const filterBtn = document.querySelector(
      '.activity__heading-action .filter'
    );
    filterBtn.disabled = true;
    filterBtn.classList.add('disabled');

    // disable edit button
    const editBtn = document.querySelector('.activity__action-edit');
    editBtn.disabled = true;
    editBtn.classList.add('disabled');
  }
});

// munculin add sama edit yang ada di pojok kanan bawah dashboard
function toggleAction() {
  document.querySelector('.activity__action').classList.toggle('show');
  document.querySelector('.activity__action-add').classList.toggle('show');
  document.querySelector('.activity__action-edit').classList.toggle('show');

  const buttons = document.querySelectorAll(
    '.activity__content-item__right-action .btn'
  );
  buttons.forEach((button) => {
    button.classList.remove('show');
  });
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
// munculin modal buat edit data
async function showModalEdit(event) {
  const activity_id = event.currentTarget.dataset.id;
  const activity = await fetch(
    `/utils/get_activity.php?id=${activity_id}`
  ).then((response) => response.json());

  document.querySelector('.modal').classList.add('show');
  document.querySelector('.modal__edit').classList.add('show');
  document.querySelector('.modal__edit__form-title').focus();

  // get the form elements
  const formId = document.querySelector('.modal__edit__form-id');
  const formTitle = document.querySelector('.modal__edit__form-title');
  const formDescription = document.querySelector(
    '.modal__edit__form-description'
  );
  const formDate = document.querySelector('.modal__edit__form__datetime-date');
  const formTime = document.querySelector('.modal__edit__form__datetime-time');
  const formPriority = document.querySelector(
    `.modal__edit__form__priority input[value="${activity.priority}"]`
  );
  const formRepetition = document.querySelector(
    `.modal__edit__form__repetition input[value="${activity.repetition}"]`
  );

  // set the form values
  formId.value = activity.id_activity;
  formTitle.value = activity.title;
  formDescription.value = activity.description;
  formDate.value = activity.date;
  formTime.value = activity.time;
  formPriority.checked = true;
  formRepetition.checked = true;
}

// sembunyiin modal buat edit data
function hideModalEdit() {
  document.querySelector('.modal').classList.remove('show');
  document.querySelector('.modal__edit').classList.remove('show');
}

function showModalDelete(event) {
  let title = event.currentTarget.dataset.title;
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
function showModalComplete(event) {
  const title = event.currentTarget.dataset.title;
  document.querySelector(
    '.modal__complete-title'
  ).innerHTML = `Complete the "<b>${title}</b>" activity?`;

  // show the modal
  document.querySelector('.modal').classList.add('show');
  document.querySelector('.modal__complete').classList.add('show');

  // set value form
  document.querySelector('.modal__complete__form-id').value =
    event.currentTarget.dataset.id;
  document.querySelector('.modal__complete__form-title').value =
    event.currentTarget.dataset.title;
  document.querySelector('.modal__complete__form-description').value =
    event.currentTarget.dataset.description;
  document.querySelector('.modal__complete__form-date').value =
    event.currentTarget.dataset.date;
  document.querySelector('.modal__complete__form-repetition').value =
    event.currentTarget.dataset.repetition;
}

function hideModalComplete() {
  document.querySelector('.modal').classList.remove('show');
  document.querySelector('.modal__complete').classList.remove('show');
}

function toggleEdit() {
  const buttons = document.querySelectorAll(
    '.activity__content-item__right-action .btn'
  );
  buttons.forEach((button) => {
    button.classList.toggle('show');
  });
}

async function search() {
  const search = document.querySelector('.search').value;
  const filter = document.querySelector('.filter').value;

  const parentCard = document.querySelector('.activity__content');
  let cards = await fetch(
    `/utils/search_activity.php?title=${search}&filter=${filter}`
  );
  cards = await cards.text();
  if (cards === 'empty') {
    parentCard.innerHTML = `<div class="activity__content__empty"><img src="./assets/images/dashboard/not-found.png"><p>We couldn't find the task you were looking for.</p></div>`;
    return;
  }
  parentCard.innerHTML = cards;
}
