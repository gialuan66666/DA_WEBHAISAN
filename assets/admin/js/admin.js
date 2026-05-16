document.addEventListener("DOMContentLoaded", () => {
  const btn = document.querySelector(".mobile-toggle");
  const sidebar = document.querySelector(".sidebar");
  if (btn && sidebar) {
    btn.addEventListener("click", () => sidebar.classList.toggle("show"));
  }
});
