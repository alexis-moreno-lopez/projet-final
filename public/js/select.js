
function redirectToPage() {
  var selectElement = document.getElementById("pet-select");
  var selectedValue = selectElement.value;
  if (selectedValue === "recette") {
    window.location.href = "/recette";
  } else if (selectedValue === "coach") {
    window.location.href = "/coach";
  }else if (selectedValue === "profil") {
  window.location.href = "/profil";
  }else if (selectedValue === "seul") {
  window.location.href = "/coachprofil";
}
}

