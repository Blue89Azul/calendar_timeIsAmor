$(function() {
  $(".menuBtn").on("click", function() {
    $(".contents").toggleClass("menu-open");
    $(".global-menu__item").toggleClass("menu-anime");
  });
});
