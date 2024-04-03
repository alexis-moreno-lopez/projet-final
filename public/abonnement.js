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