document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".bouton");
    const modal = document.getElementById("myModal");
    const closeButton = document.querySelector("#btn-close");
    const modalTitle = document.querySelector("#myModal h3");
    const modalImage = document.querySelector("#myModal img");
    const modalDescription = document.querySelector("#myModal .descriptif");
    const modalTime = document.querySelector("#myModal .espace p");
    const modalText = document.querySelector("#myModal .text");
    const modalIngredient = document.querySelector("#myModal .ingredient");

    console.log('test');

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

    // Ajouter un écouteur d'événement pour fermer la modal en cliquant en dehors de celle-ci
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.classList.remove("d-flex");
            modal.classList.add("d-none");
        }
    });
});
 