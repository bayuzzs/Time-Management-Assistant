const hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function (e) {
    const navBar = document.querySelector("nav ul");
    hamburger.classList.toggle("active");
    navBar.classList.toggle("active");
});

// BUAT NAVIGASI
const links = document.querySelectorAll("nav ul li a");
links.forEach((link, index) => {
    if (index === 4) {
        return;
    }
    link.addEventListener("click", function (e) {
        e.preventDefault();
        const section = document
            .getElementById(link.href.split("#")[1])
            .getBoundingClientRect().top;
        const bbody = document.body.getBoundingClientRect().top;
        const destination = section - bbody;
        // console.log(bbody);
        // console.log(destination);
        // console.log(link.getBoundingClientRect().top);
        window.scrollTo(0, destination - 100);
    });
});

// Buat animasi
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
        } else {
            entry.target.classList.remove("show");
        }
    });
});
// checking if feature card in viewport or  not
document.querySelectorAll(".feature-item").forEach((feature) => {
    observer.observe(feature);
});
