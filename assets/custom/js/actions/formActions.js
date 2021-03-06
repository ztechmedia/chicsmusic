$(".action-logout").on("click", function (e) {
  const element = $(this);
  const url = element.data("url");

  swal(
    {
      title: "Logout",
      text: "Yakin ingin keluar aplikasi ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, Keluar!",
      closeOnConfirm: false,
    },
    function () {
      reqJson(url, "POST", {}, (err, response) => {
        if (response.success) {
          swal.close();
          logoutHandler();
          setTimeout(() => {
            window.location = response.redirect;
          }, 500);
        }
      });
    }
  );
});

$(document.body).on("click", ".action-delete", function (e) {
  const element = $(this);
  const url = element.data("url");
  const message = element.data("message");

  swal(
    {
      title: "Hapus",
      text: message,
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, Hapus!",
      closeOnConfirm: false,
    },
    function () {
      reqJson(url, "GET", {}, (err, response) => {
        if (response) {
          if (!$.isEmptyObject(response.errors)) {
            swal("Oops..!", response.errors, "error");
          } else {
            swal.close();
            row = element.closest("tr");
            row.fadeOut(200, function () {
              element.remove();
            });
          }
        } else {
          console.log("Error: ", err);
        }
      });
    }
  );
});

$(document.body).on("change", ".nested-select", function (e) {
  const element = $(this);
  const tempUrl = element.data("url");
  const url = tempUrl.replace("[id]", element.val());
  const target = element.data("target");
  const empty = element.data("empty");

  let options = `<option value="">${empty}</option>`;

  if (element.val() !== "") {
    reqJson(url, "GET", {}, (err, response) => {
      if (response) {
        response.map((res) => {
          options = options + `<option value="${res.id}">${res.name}</option>`;
        });
        $(target).html(options);
      } else {
        console.log("Error: ", err);
      }
    });
  } else {
    $(target).html(options);
  }
});

const logoutHandler = () => {
  localStorage.removeItem("menu");
  localStorage.removeItem("submenu");
  localStorage.removeItem("currentUrl");
  localStorage.removeItem("prevUrl");
  localStorage.removeItem("sidebar");
};

const submitHandler = (className) => {
  switch (className) {
    case ".action-submit-create":
      return actionCreate(className);
    case ".action-submit-update":
      return actionUpdate(className);
    default:
      return console.log("submitHandler type undefined");
  }
};

const actionCreate = (className) => {
  const element = $(className);
  const action = element.data("action");
  const data = new FormData(element.context.forms[0]);
  actionButton(".save", "Loading...");
  sendRequest(className, action, "POST", data);
};

const actionUpdate = (className) => {
  const element = $(className);
  const action = element.data("action");
  const data = new FormData(element.context.forms[0]);
  const redirect = element.data("redirect");
  const target = element.data("target");
  actionButton(".save", "Loading...");
  sendRequest(className, action, "POST", data, {
    redirect: redirect,
    target: target,
  });
};

const sendRequest = (className, action, type, data, redirect = null) => {
  reqFormData(action, type, data, (err, response) => {
    if (response) {
      if ($.isEmptyObject(response.errors)) {
        actionSuccess(className, response, redirect);
      } else {
        actionFormError(response.errors);
      }
    } else {
      actionError(className, err);
    }
  });
};
