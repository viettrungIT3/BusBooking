$(function () {
  $("#table-view")
    .DataTable({
      responsive: true,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf"],
    })
    .buttons()
    .container()
    .appendTo("#example1_wrapper .col-md-6:eq(0)");
});
