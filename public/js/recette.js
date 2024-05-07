document.addEventListener('DOMContentLoaded', function() {
    const toggleItems = document.querySelectorAll('.toggle-table');
    console.log(toggleItems);
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
            console.log(handPointDownIcon);
        });
    });


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