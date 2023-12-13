// if the browser has render the page
document.addEventListener('DOMContentLoaded', async function () {
  // for alert
  const message = document.querySelector('.alert');
  if (message) {
    setTimeout(function () {
      message.classList.add('alert-hide');
    }, 2500);
  }

  // make chart
  // if user have history
  if (document.querySelector('#historyChart')) {
    const { data, options } = await getHistories('week');
    createChart(data, options);
  }
});

function showModalDelete(event) {
  let title = event.currentTarget.dataset.title;
  document.querySelector(
    '.modal__delete-title'
  ).innerHTML = `Are you sure you want to delete "<b>${title}</b>" history?`;
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

async function getHistories(filter) {
  try {
    let data = await fetch(`/utils/get_histories.php?filter=${filter}`);
    data = await data.json();
    return data;
  } catch (error) {
    console.error(error);
  }
}
function createChart(data, options) {
  const ctx = document.getElementById('historyChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options,
  });
}

async function updateChart(event) {
  // make chart
  const { data, options } = await getHistories(event.currentTarget.value);
  const chartContainer = document.querySelector('.chart__container');
  chartContainer.innerHTML = `<canvas id="historyChart"></canvas>`;
  const ctx = document.getElementById('historyChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options,
  });
}
