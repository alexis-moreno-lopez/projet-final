console.log('test');
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
  document.addEventListener('DOMContentLoaded', function() {
    var toggleButton = document.getElementById('toggleFormButton');
    var form = document.getElementById('recipeForm');
    toggleButton.addEventListener('click', function() {
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
            toggleButton.classList.remove('fa-chevron-down');
            toggleButton.classList.add('fa-chevron-up');
        } else {
            form.style.display = 'none';
            toggleButton.classList.remove('fa-chevron-up');
            toggleButton.classList.add('fa-chevron-down');
        }
    });
});