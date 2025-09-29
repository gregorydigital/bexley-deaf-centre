export default function initMobileNav() {

   const menuToggle = document.querySelector(".menu-toggle");
   const mainNav = document.querySelector(".main-nav-container");
   const parents = mainNav.querySelectorAll('.menu-item-has-children');

   menuToggle.addEventListener("click", function() {
      mainNav.classList.toggle("active");
      menuToggle.classList.toggle("open");
      document.documentElement.classList.toggle("no-scroll");
   });

   parents.forEach(parent => {

      const link = parent.firstElementChild

      link.addEventListener('click', function(e) {

         e.preventDefault()

         parents.forEach(i => {
            if (i !== parent) {
               i.classList.remove("open");
            }
         });

         parent.classList.toggle('open');
      })
   });

   document.addEventListener("click", function (e) {
      if (!e.target.closest(".menu-item-has-children")) {
         parents.forEach(item => item.classList.remove("open"));
      }
   });

   const mediaQuery = window.matchMedia("(min-width: 768px)");

   function handleScreenChange(e) {
      if (e.matches) {
         mainNav.classList.remove("active");
         menuToggle.classList.remove("open");
         document.documentElement.classList.remove("no-scroll");
      }
   }

   handleScreenChange(mediaQuery);

   mediaQuery.addEventListener("change", handleScreenChange);
}