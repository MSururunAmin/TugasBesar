document.addEventListener("DOMContentLoaded", function () {
  // Add event listener to navigation links
  const navLinks = document.querySelectorAll("nav ul li a");
  navLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      loadContent(targetId);
    });
  });

  // Function to load content dynamically
  function loadContent(sectionId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", sectionId + ".html", true);
    xhr.onload = function () {
      if (this.status === 200) {
        document.querySelector("main").innerHTML = this.responseText;
      } else {
        document.querySelector("main").innerHTML = "<p>Content not found</p>";
      }
    };
    xhr.send();
  }
});
