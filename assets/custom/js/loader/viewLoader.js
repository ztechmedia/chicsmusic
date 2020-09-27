const loadContent = (url, div) => {
  $(div).load(url);
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
  const element = $(this);
  const to = element.data("to");
  const target = element.data("target");
  const secondary = element.data("secondary");

  if (secondary === "yes") {
    localStorage.setItem("secondaryUrl", to);
    localStorage.setItem("secondaryTarget", target);
  } else {
    localStorage.setItem("currentUrl", to);
  }

  setContentLoader(target);
  target ? loadContent(to, target) : loadContent(to, ".content");
});
