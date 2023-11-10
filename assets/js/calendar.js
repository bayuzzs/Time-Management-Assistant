document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar');
  const calendar = new FullCalendar.Calendar(calendarEl, {
    eventMouseEnter: function (info) {
      info.el.style.cursor = 'pointer';
      info.el.style.opacity = '0.8';
    },
    eventMouseLeave: function (info) {
      info.el.style.opacity = '1';
    },
    contentHeight: 1000,
    headerToolbar: {
      left: 'dayGridMonth,timeGridWeek,timeGridDay,listYear',
      center: 'title',
      right: 'prev,next',
    },
    events: [
      {
        title: 'Meeting asdasdsdsadsadsadsadasdsa',
        start: '2023-11-09',
      },
      {
        title: 'Meeting',
        start: '2023-11-08',
      },
      {
        title: 'Meeting',
        start: '2023-11-10T10:30:00',
      },
      {
        title: 'Mancing',
        start: '2023-11-11T10:30:00',
      },
    ],
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
