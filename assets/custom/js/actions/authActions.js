const errorHandler = (errors) => {
  $.each(errors, function (key, value) {
    $(`#${key}`).addClass("error");
    $(`#${key}-error`).html(value);
  });
  actionButton(".save", "Simpan");
};

$(document.body).on("submit", ".auth-login", function (e) {
  e.preventDefault();
  const element = $(this);
  const url = element.data("url");
  const data = new FormData($(this));

  reqFormData(url, "POST", data, (err, response) => {});
});
