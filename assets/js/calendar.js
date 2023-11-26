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
      start: `${data.date}T${data.time}`,
      allDay: false,
    };
  });
  console.log(activities);
  // render calendar
  const calendarEl = document.getElementById('calendar');
  const calendar = new FullCalendar.Calendar(calendarEl, {
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
    contentHeight: 1000,
    headerToolbar: {
      left: 'dayGridMonth,timeGridWeek,timeGridDay,listYear',
      center: 'title',
      right: 'add_event,prev,next',
    },
    events: activities,
    // dayMaxEventRows: true, // for all non-TimeGrid views
    // views: {
    //   timeGrid: {
    //     dayMaxEventRows: 6, // adjust to 6 only for timeGridWeek/timeGridDay
    //   },
    // },
    timeFormat: 'H:mm',
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

function showModalAdd() {
  document.querySelector('.modal').classList.add('show');
  document.querySelector('.modal__add__form-title').focus();
}
// sembunyiin modal buat tambah data
function hideModalAdd() {
  document.querySelector('.modal').classList.remove('show');
}
