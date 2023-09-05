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
  e.preventDefault(); // Empêche le comportement par défaut du formulaire (rechargement de la page).
  e.stopPropagation(); // Empêche la propagation de l'événement à d'autres éléments.
  const userSearch = this.elements["search-value"].value;
  const urlEncoded = encodeURI(`${BASE_URL}?userSearch=${userSearch}`);
  window.location = urlEncoded;
});
