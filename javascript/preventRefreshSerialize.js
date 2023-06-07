$(document).ready(function ($) {
  $("#noviProizvod").submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "insert-products.php",
      data: $(this).serialize(),
      success: function () {
        document.getElementById("item_name").value = "";
        document.getElementById("description").value = "";
        document.getElementById("price").value = "";
        document.getElementById("slika").value = "";
        document.getElementById("amount").value = "";
        document.getElementById("published").value = "";
      },
      error: function (textStatus, errorThrown) {
        if (textStatus == "Unauthorized") {
          alert("ERROR: " + errorThrown);
        } else {
          alert("ERROR: " + errorThrown);
        }
      },
    });
  });
});
