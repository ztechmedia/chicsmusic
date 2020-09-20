$(".action-logout").on("click", function (e) {
  const element = $(this);
  const url = element.data("url");
  const redirect = element.data("redirect");

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
      $.ajax({
        url: url,
        success: function () {
          swal.close();
          logoutHandler();
          window.location = redirect;
        },
      });
    }
  );
});

const logoutHandler = () => {
  localStorage.removeItem("menu");
  localStorage.removeItem("submenu");
  localStorage.removeItem("currentUrl");
};
