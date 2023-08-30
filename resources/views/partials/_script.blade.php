<script>
  
  document.addEventListener("DOMContentLoaded", function () {
        var editButtons = document.querySelectorAll(".scrollButton");
        var userInfoSection = document.getElementById("Info");

        editButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                userInfoSection.scrollIntoView({ behavior: "smooth" });
            });
        });
    });


</script>