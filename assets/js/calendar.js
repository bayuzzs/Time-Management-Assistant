document.addEventListener('DOMContentLoaded', async function () {
  // fetch activities
  let activities = await fetch('/utils/get_activities.php')
    .then((response) => response.json())
    .then((datas) => datas);
  activities = activities.map((data) => {
    // return this for calendar format properly
    return {
      id: data.id_activity,
      title: data.title,
      start: new Date(data.date + ' ' + data.time).getTime(),
      color: `#${data.priority === 'important' ? 'fdd527' : '0091ff'}`,
      textColor: `#${data.priority === 'important' ? '000000' : 'ffffff'}`,
      display: 'block',
    };
  });

  // render calendar
  const calendarEl = document.getElementById('calendar');
  const calendar = new FullCalendar.Calendar(calendarEl, {
    eventClick: function (info) {
      showModalEdit(info);
    },
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
    events: activities,
    nextDayThreshold: '01:00:00',
    initialView: 'dayGridMonth',
  });
  calendar.render();

  // for alert
  const message = document.querySelector('.alert');
  if (message) {
    setTimeout(function () {
      message.classList.add('alert-hide');
    }, 2500);
  }
});

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

async function showModalEdit(event) {
  const activity_id = event.event.id;
  console.log(event.event);
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
