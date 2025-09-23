const brand = document.getElementById('brandName');

brand.addEventListener('mouseenter', () => {
  brand.classList.add('animate');
});

brand.addEventListener('mouseleave', () => {
  brand.classList.remove('animate');
});
