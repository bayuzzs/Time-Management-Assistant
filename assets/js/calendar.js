document.addEventListener('DOMContentLoaded', async function () {
  // fetch activities
  const activities = await getActivities();
  const calendarActivities = calendarFormatActivities(activities);
  // render calendar
  renderCalendar(calendarActivities);

  // for alert
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
    .then((data) => data);
}

function calendarFormatActivities(activities) {
  if (!activities) {
    activities = [];
  }

  return activities.map((data) => {
    return {
      id: data.id_activity,
      title: data.title,
      start: new Date(data.date + ' ' + data.time).getTime(),
      color: `#${data.priority === 'important' ? 'fdd527' : '0091ff'}`,
      textColor: `#${data.priority === 'important' ? '000000' : 'ffffff'}`,
      display: 'block',
    };
  });
}

function renderCalendar(events) {
  const calendarEl = document.getElementById('calendar');
  const calendar = new FullCalendar.Calendar(calendarEl, {
    eventClick: (info) => showModalEdit(info),
    dateClick: (info) =>
      info.view.type === 'dayGridMonth' ? showModalAdd(info.dateStr) : null,
    eventMouseEnter: function (info) {
      info.el.style.cursor = 'pointer';
      info.el.style.opacity = '0.8';
    },
    eventMouseLeave: function (info) {
      info.el.style.opacity = '1';
    },
    customButtons: {
      add_event: {
        text: 'Add',
        click: showModalAdd,
      },
    },
    headerToolbar: {
      left: 'dayGridMonth,timeGridWeek,timeGridDay,listYear',
      center: 'title',
      right: 'add_event,prev,next',
    },
    events,
    nextDayThreshold: '01:00:00',
    initialView: 'dayGridMonth',
  });
  calendar.render();
}

// munculin modal buat tambah data
function showModalAdd(date = '') {
  // set the date
  if (date) {
    document.querySelector('.modal__add__form__datetime-date').value = date;
  }
  document.querySelector('.modal').classList.add('show');
  document.querySelector('.modal__add').classList.add('show');
  document.querySelector('.modal__add__form-title').focus();
}

// sembunyiin modal buat tambah data
function hideModalAdd() {
  document.querySelector('.modal').classList.remove('show');
  document.querySelector('.modal__add').classList.remove('show');
}

async function showModalEdit(event) {
  const activity_id = event.event.id;
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
  const deleteBtn = document.querySelector('.modal__edit__form__button-delete');
  const completeBtn = document.querySelector(
    '.modal__edit__form__button-complete'
  );

  // set the form values
  formId.value = activity.id_activity;
  formTitle.value = activity.title;
  formDescription.value = activity.description;
  formDate.value = activity.date;
  formTime.value = activity.time;
  formPriority.checked = true;
  formRepetition.checked = true;

  // set data-value
  deleteBtn.dataset.id = activity.id_activity;
  deleteBtn.dataset.title = activity.title;
  completeBtn.dataset.id = activity.id_activity;
  completeBtn.dataset.title = activity.title;
  completeBtn.dataset.description = activity.description;
  completeBtn.dataset.date = activity.date;
  completeBtn.dataset.repetition = activity.repetition;
}

// sembunyiin modal buat edit data
function hideModalEdit() {
  document.querySelector('.modal').classList.remove('show');
  document.querySelector('.modal__edit').classList.remove('show');
}

function showModalDelete(event) {
  const id = event.currentTarget.dataset.id;
  const title = event.currentTarget.dataset.title;
  document.querySelector(
    '.modal__delete-title'
  ).innerHTML = `Are you sure you want to delete "<b>${title}</b>" activity?`;
  document.querySelector('.modal__delete__wrapper').classList.add('show');
  document.querySelector('.modal__delete').classList.add('show');
  document.querySelector('.modal__delete__form-id').value = id;
}

function hideModalDelete() {
  document.querySelector('.modal__delete__wrapper').classList.remove('show');
  document.querySelector('.modal__delete').classList.remove('show');
}
function showModalComplete(event) {
  const title = event.currentTarget.dataset.title;
  document.querySelector(
    '.modal__complete-title'
  ).innerHTML = `Complete the "<b>${title}</b>" activity?`;

  // show the modal
  document.querySelector('.modal__complete__wrapper').classList.add('show');
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
  document.querySelector('.modal__complete__wrapper').classList.remove('show');
  document.querySelector('.modal__complete').classList.remove('show');
}
