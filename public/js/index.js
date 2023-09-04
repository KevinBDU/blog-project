document.addEventListener("DOMContentLoaded", function () {
  const toggler = document.querySelector(".toggler");
  const nav = document.querySelector("nav");

  toggler.addEventListener("click", function () {
    if (nav.style.display === "none" || nav.style.display === "") {
      nav.style.display = "block";
    } else {
      nav.style.display = "none";
    }
  });
});

const searchForm = document.getElementById("search-article");
searchForm.addEventListener("submit", function (e) {
  e.preventDefault();
  e.stopPropagation();
  const userSearch = this.elements["search-value"].value;
  const urlEncoded = encodeURI(`${BASE_URL}?userSearch=${userSearch}`);
  window.location = urlEncoded;
});
