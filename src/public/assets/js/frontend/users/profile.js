$(document).ready(function () {
  checkURL();

  function checkURL() {
    document.getElementById("imageLabel").style.display = "none";

    var currentURL = window.location.pathname;

    if (currentURL == "/user/profile/edit") {
      enableForm();
      $("#btn-cancel-edit-profile, #btn-update-profile").show();
      $("#btn-edit-profile").hide();
      if (isLoginGG || isLoginGG == 1) {
        console.log("isLoginGG", isLoginGG);
        document.getElementById("imageLabel").style.display = "none";
      } else {
        document.getElementById("imageLabel").style.display = "inline-block";
      }
    } else if (currentURL.includes("/user/profile")) {
      window.history.pushState("", "", "/user/profile");
      disableForm();
      $("#btn-cancel-edit-profile, #btn-update-profile").hide();
      $("#btn-edit-profile").show();
    }
  }

  $("#btn-edit-profile").click(function (event) {
    event.preventDefault();
    window.history.pushState("", "", "/user/profile/edit");
    checkURL();
  });

  $("#btn-update-profile").click(function () {
    $("#profileForm").submit();
  });

  $("#btn-cancel-edit-profile").click(function (event) {
    event.preventDefault();
    disableForm();
    window.history.pushState("", "", "/user/profile");
    checkURL();
    resetForm();
  });

  function disableForm() {
    $("#form-profile input").prop("disabled", true);
  }

  function enableForm() {
    $("#form-profile input").prop("disabled", false);
    $("#form-profile input[name*='email']").prop("disabled", true);
    // Nếu đăng nhập bằng Google, loại bỏ thuộc tính disabled cho các trường thông tin liên hệ
    if (isLoginGG) {
      $("#form-profile input[name*='name']").prop("disabled", true);
      $("#form-profile input[name*='profile_img']").prop("disabled", true);
    }
  }

  function resetForm() {
    $("#form-profile")[0].reset();
  }
});
