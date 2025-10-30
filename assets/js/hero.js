document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("menuToggle");
  const menu = document.getElementById("mobileMenu");
  const icon = document.getElementById("menuIcon");

  if (toggle && menu && icon) {
    toggle.addEventListener("click", () => {
      menu.classList.toggle("show");

     
      const isOpen = menu.classList.contains("show");
      icon.setAttribute(
        "d",
        isOpen ? "M6 18L18 6M6 6l12 12" : "M4 6h16M4 12h16M4 18h16"
      );
    });
  }
});
