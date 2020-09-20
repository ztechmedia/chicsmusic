const actionButton = (className, text = null) => {
  $(className).html(text);
};

const actionSuccess = (type, response, redirect) => {
  switch (type) {
    case ".action-submit-create":
    case ".action-submit-update":
      return onCreateUpdateSuccess(response, redirect);
    default:
      return console.log("actionSuccess type undefined");
  }
};

const actionError = (type, err) => {
  switch (type) {
    case ".action-submit-create":
    case ".action-submit-update":
      return createError(response);
    default:
      return console.log("actionError type undefined");
  }
};

const actionFormError = (errors) => {
  $.each(errors, function (key, value) {
    $(`#${key}`).addClass("error");
    $(`#${key}-error`).html(value);
    $(`#${key}-error`).style({ color: "red" });
  });
  actionButton(".save", "Save");
};

const onCreateUpdateSuccess = (response, redirect) => {
  swal("Sukses", response.message, "success");
  if (!redirect) {
    document.getElementById("validate").reset();
    $(".select").val("").change();
    $(".form-error").html("");
    $(".form-control").removeClass("error");
    actionButton(".save", "Save");
  } else {
    loadContent(redirect.redirect, redirect.target);
  }
};

const onCreateUpdateError = (err) => {
  swal("Gagal", err, "error");
};
