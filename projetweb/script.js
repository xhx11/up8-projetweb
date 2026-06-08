const menuBtn = document.querySelector(".menu-btn");
const nav = document.querySelector(".topnav");

if (menuBtn && nav) {
  menuBtn.addEventListener("click", function () {
    nav.classList.toggle("active");
  });
}