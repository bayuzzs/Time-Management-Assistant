const hamburger = document.querySelector('.hamburger');
hamburger.addEventListener('click', function (e) {
  const navBar = document.querySelector('nav ul');
  hamburger.classList.toggle('active');
  navBar.classList.toggle('active');
});

// BUAT NAVIGASI
const links = document.querySelectorAll('nav ul li a');
links.forEach((link, index) => {
  // index 4 is button to login
  if (index === 4) {
    return;
  }
  link.addEventListener('click', function (e) {
    e.preventDefault();
    const section = document
      .getElementById(link.href.split('#')[1])
      .getBoundingClientRect().top;
    const bbody = document.body.getBoundingClientRect().top;
    const destination = section - bbody;
    window.scrollTo(0, destination - 100);
  });
});

// Buat animasi
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('show');
    } else {
      entry.target.classList.remove('show');
    }
  });
});
// checking if feature card in viewport or  not
document.querySelectorAll('.feature-item').forEach((feature) => {
  observer.observe(feature);
});

async function userSubmit(e) {
  e.preventDefault();
  const body = new FormData(e.target);
  loader(true);
  try {
    await fetch(
      'https://script.google.com/macros/s/AKfycbyQSapm3WEF4HQYwBaP8hIA6gq7Q1WDCRIM3tgLdlFmuce4KW8ggVWe18HELWnRjFzr/exec',
      {
        method: 'POST',
        body,
      }
    );
    e.target.reset();
    loader(false);
  } catch (err) {
    console.log(err);
  }
}

function loader(action) {
  if (action) {
    document.querySelector('.alert-loader').style.display = 'grid';
    document.querySelector('.alert.alert-success').style.display = 'none';
    document.querySelector('.form-wrap form').style.display = 'none';
  } else {
    document.querySelector('.alert-loader').style.display = 'none';
    document.querySelector('.alert.alert-success').style.display = 'flex';
    document.querySelector('.form-wrap form').style.display = 'block';
  }
}
