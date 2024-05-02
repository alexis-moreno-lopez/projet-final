document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".recette");
    const modal = document.getElementById("myModal");
    const closeButton = document.querySelector("#btn-close");
    

    buttons.forEach(button => {
        button.addEventListener("click", () => {
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
