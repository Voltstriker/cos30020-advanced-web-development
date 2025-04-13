document.addEventListener("DOMContentLoaded", function() {
    const pageName = window.location.pathname.split('/').pop().split('.')[0];
    const element = document.getElementById(pageName);
    if (element) {
        element.classList.add("active");
    }
});