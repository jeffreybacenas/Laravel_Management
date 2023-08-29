<script>
  
  document.addEventListener("DOMContentLoaded", function () {
        var editButtons = document.querySelectorAll(".scrollButton");
        var userInfoSection = document.getElementById("Info");

        editButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                userInfoSection.scrollIntoView({ behavior: "smooth" });
            });
        });

        var elems = document.getElementById("navId");

        [].forEach.call(elems, function(el) {
            el.classList.remove("mt-3");
        });
    });

</script>