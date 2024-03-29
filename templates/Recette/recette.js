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




document.addEventListener('DOMContentLoaded', function() {
    const toggleItems = document.querySelectorAll('.toggle-table');

    toggleItems.forEach(function(item) {
        item.addEventListener('click', function() {
            const sublistItems = this.parentElement.querySelectorAll('li:not(.toggle-table)');
            sublistItems.forEach(function(subitem) {
                subitem.classList.toggle('hidden');
            });

            const handPointerIcon = this.querySelector('.fa-hand-pointer');
            const handPointDownIcon = this.querySelector('.fa-hand-point-down');
            handPointerIcon.classList.toggle('hidden');
            handPointDownIcon.classList.toggle('hidden');
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var scrollToTopBtn = document.querySelector('.scroll-to-top');
  
    window.addEventListener('scroll', function() {
      if (window.scrollY > 300) {
        scrollToTopBtn.style.display = 'block';
      } else {
        scrollToTopBtn.style.display = 'none';
      }
    });
  
    scrollToTopBtn.addEventListener('click', function() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  });