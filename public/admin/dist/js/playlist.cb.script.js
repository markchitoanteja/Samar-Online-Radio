document.addEventListener("DOMContentLoaded", function () {
    const checkAll = document.getElementById("checkAllDays");
    const checkboxes = document.querySelectorAll(".day-checkbox");

    checkAll.addEventListener("change", () => {
        checkboxes.forEach(cb => cb.checked = checkAll.checked);
    });

    checkboxes.forEach(cb => {
        cb.addEventListener("change", () => {
            checkAll.checked = [...checkboxes].every(cb => cb.checked);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const checkAll = document.getElementById("editCheckAllDays");
    const checkboxes = document.querySelectorAll(".edit-day-checkbox");

    checkAll.addEventListener("change", function () {
        checkboxes.forEach(cb => cb.checked = checkAll.checked);
    });
});