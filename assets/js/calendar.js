document.addEventListener('DOMContentLoaded', async function () {
  // fetch activities
  let activities = await fetch('/utils/get_activity.php')
    .then((response) => response.json())
    .then((datas) => datas);
  activities = activities.map((data) => {
    return {
      id: data.id_activity,
      title: data.title,
      start: `${data.date}T${data.time}`,
    };
  });

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
        click: function () {
          alert();
        },
      },
    },
    contentHeight: 1000,
    headerToolbar: {
      left: 'dayGridMonth,timeGridWeek,timeGridDay,listYear',
      center: 'title',
      right: 'add_event,prev,next',
    },
    events: activities,
    dayMaxEventRows: true, // for all non-TimeGrid views
    views: {
      timeGrid: {
        dayMaxEventRows: 6, // adjust to 6 only for timeGridWeek/timeGridDay
      },
    },
    initialView: 'dayGridMonth',
  });
  calendar.render();
});
