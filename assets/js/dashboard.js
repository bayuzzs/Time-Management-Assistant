// if the browser has render the page
document.addEventListener('DOMContentLoaded', async function () {
  const { total, priority, overdue, activities } = await getActivities();

  // render heading
  renderHeading(total, priority, overdue);

  // render card
  renderActivity(activities);
  const message = document.querySelector('.alert');
  if (message) {
    setTimeout(function () {
      message.classList.add('alert-hide');
    }, 2500);
  }
});

async function getActivities() {
  return await fetch('/utils/get_activities.php')
    .then((response) => response.json())
    .then((datas) => datas);
}

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

function renderHeading(all, priority, overdue) {
  document.querySelector('.heading__priority__detail-count').innerHTML =
    priority;
  document.querySelector('.heading__overdue__detail-count').innerHTML = overdue;
  document.querySelector('.heading__all__detail-count').innerHTML = all;
}

function renderActivity(activities) {
  const activityContainer = document.querySelector('.activity__content');
  activities.forEach((activity) => {
    activityContainer.innerHTML += Activity(activity);
  });
}

const Activity = ({
  id_activity,
  title,
  priority,
  repetition,
  description,
  date,
  time,
}) => {
  return `<div class="activity__content-item">
  <div class="activity__content-item__left">
    <p class="activity__content-item__left-title">${title}</p>
    <p class="activity__content-item__left-priority">${priority}</p>
    <p class="activity__content-item__left-repetition">${repetition}</p>
    <p class="activity__content-item__left-overdue">${repetition}</p>
    <p class="activity__content-item__left-description">${description}</p>
  </div>
  <div class="activity__content-item__right">
    <div class="activity__content-item__right-time">
      <p>${date}</p>
      <p>${time}</p>
    </div>
    <div class="activity__content-item__right-action">
      <button class="activity__content-item__right-action-edit btn" data-id="${id_activity}"
        onclick="showModalEdit(event)">
        <img src=" ./assets/images/dashboard/edit.svg">
      </button>
      <button class="activity__content-item__right-action-delete btn" data-id="${id_activity}"
        onclick="showModalDelete(event)">
        <img src="./assets/images/dashboard/delete.svg">
      </button>
      <button class="activity__content-item__right-action-complete btn">
        <img src="./assets/images/dashboard/complete.svg">
      </button>
    </div>
  </div>
</div>`;
};
