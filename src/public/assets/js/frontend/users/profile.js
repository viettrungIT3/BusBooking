const input = document.getElementById("imageUpload");
const label = document.getElementById("imageLabel");

input.addEventListener("change", function () {
  label.style.display = this.disabled ? "none" : "inline-block";
});

$(document).ready(function () {
  checkURL();

  function checkURL() {
    var currentURL = window.location.pathname;

    if (currentURL == "/user/profile") {
      disableForm();
      $("#btn-cancel-edit-profile, #btn-update-profile").hide();
      $("#btn-edit-profile").show();
    } else if (currentURL == "/user/profile/edit") {
      enableForm();
      $("#btn-cancel-edit-profile, #btn-update-profile").show();
      $("#btn-edit-profile").hide();
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
    // Nếu đăng nhập bằng Google, loại bỏ thuộc tính disabled cho các trường thông tin liên hệ
    if (isLoginGG) {
      $("#form-profile input[name*='name']").prop("disabled", true);
      $("#form-profile input[name*='email']").prop("disabled", true);
      $("#form-profile input[name*='profile_img']").prop("disabled", true);
    }
  }

  function resetForm() {
    $('#form-profile')[0].reset();
  }
});
