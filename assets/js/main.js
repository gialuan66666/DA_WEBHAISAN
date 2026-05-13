document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".my-navbar .nav-link");

    links.forEach(link => {
        link.addEventListener("click", function () {
            links.forEach(l => l.classList.remove("active"));
            this.classList.add("active");
        });
    });
});

window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".custom-navbar");

    if (window.scrollY > 50) {
        navbar.classList.add("navbar-scrolled");
    } else {
        navbar.classList.remove("navbar-scrolled");
    }
});

let slides = document.querySelectorAll(".cc-hero-slide");
let index = 0;

setInterval(() => {
    slides[index].classList.remove("active");

    index++;
    if (index >= slides.length) index = 0;

    slides[index].classList.add("active");
}, 4000);