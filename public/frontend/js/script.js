document.addEventListener("DOMContentLoaded", function () {
    var myCarousel = document.querySelector("#cardCarousel");
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 2000,
        wrap: true,
    });
});
