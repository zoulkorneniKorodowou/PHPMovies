
document.addEventListener('DOMContentLoaded', function () {
    var menuBtn = document.getElementById('options-btn');
    var navMenu = document.getElementById('nav-menu');

    if (menuBtn && navMenu) {
        menuBtn.addEventListener('click', function () {
            navMenu.classList.toggle('active');
        });
    }
});
