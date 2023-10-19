// Handle DuckType Form
$(document).ready(function () {
  if ($("body").has("module-jm_estimation-estimation")) {
    // EventListener on Links
    $(".ductType-link").on("click", function (e) {
      e.preventDefault();

      // Get Name by Data
      const ductTypeName = $(this).data("ducttype-name");
      //   Get Image by Data
      const ductTypeImage = $(this).data("ducttype-image");

      // Sync Hidden Input ductTypeId & modal Title/Image
      $("#ductType").val(ductTypeName);
      $("#ductType-modal-label").text(ductTypeName);
      $("#ductType-image").attr("src", ductTypeImage);
    });
  }
});
