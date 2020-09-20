const loadContent = (url, div) => {
  $.ajax({
    url: url,
    success: (data) => {
      $(div).html(data);
    },
  });
};

$(".side-menu").on("click", function (e) {
  const element = $(this);
  const url = element.data("url");
  const menu = element.data("menu");

  setContentLoader();
  setActiveMenu(menu);
  setActiveSub(null);
  localStorage.setItem("currentUrl", url);
  if (url) loadContent(url, ".content");
});

$(".side-submenu").on("click", function (e) {
  const element = $(this);
  const url = element.data("url");
  const menu = element.data("menu");
  const submenu = element.data("submenu");

  setContentLoader();
  setActiveMenu(menu);
  setActiveSub(submenu);
  localStorage.setItem("currentUrl", url);
  if (url) loadContent(url, ".content");
});

$(document.body).on("click", ".link-to", function (e) {
  e.preventDefault();
  setContentLoader();
  const element = $(this);
  const to = element.data("to");
  const target = element.data("target");
  localStorage.setItem("currentUrl", to);
  target ? loadContent(to, target) : loadContent(to, ".content");
});
