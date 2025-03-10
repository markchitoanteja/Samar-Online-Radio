document.addEventListener("DOMContentLoaded", function () {
    const currentYearSpan = document.getElementById("current-year");
    const currentYear = new Date().getFullYear();
    currentYearSpan.textContent = currentYear;
});