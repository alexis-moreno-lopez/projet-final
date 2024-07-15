document.addEventListener("DOMContentLoaded", function() {
  const buttons = document.querySelectorAll(".bouton");
  const modal = document.getElementById("myModal");
  const closeButton = document.querySelector("#btn-close");
  const modalTitle = document.querySelector("#modal-title");
  const modalImage = document.querySelector("#modal-image");
  const modalDescription = document.querySelector("#modal-description .text");
  const modalTime = document.querySelector("#modal-time");
  const modalText = document.querySelector("#modal-text");
  const modalIngredient = document.querySelector("#modal-ingredient");

  buttons.forEach(button => {
    button.addEventListener("click", () => {
      const name = button.dataset.name;
      const picture = button.dataset.picture;
      const description = button.dataset.description;
      const time = button.dataset.time;
      const text = button.dataset.text;
      const ingredient = button.dataset.ingredient;

      modalTitle.textContent = name;
      modalImage.src = picture;
      modalDescription.textContent = description;
      modalTime.textContent = time;
      modalText.textContent = text;
      modalIngredient.textContent = ingredient;

      modal.classList.remove("d-none");
      modal.classList.add("d-flex");
    });
  });

  closeButton.addEventListener("click", () => {
    modal.classList.remove("d-flex");
    modal.classList.add("d-none");
  });
});