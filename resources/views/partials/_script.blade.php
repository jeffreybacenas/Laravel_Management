<script>
  document.addEventListener("DOMContentLoaded", function() {
    var addUserButton = document.getElementById("addButton");
    var userInfoSection = document.getElementById("Info");

    addUserButton.addEventListener("click", function() {
      userInfoSection.scrollIntoView({ behavior: "smooth" });
    });
  });
</script>