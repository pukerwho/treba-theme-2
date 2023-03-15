// Open mobile menu
let menuToggleOpen = document.querySelector(".menu-open-js");
let menuToggleClose = document.querySelector(".menu-close-js");
let mobileMenu = document.querySelector(".mobile-menu");
if (menuToggleOpen) {
  menuToggleOpen.addEventListener("click", () => {
    document.body.classList.add("overflow-hidden");
    mobileMenu.classList.remove("hidden");
  });
}
if (menuToggleClose) {
  menuToggleClose.addEventListener("click", () => {
    document.body.classList.remove("overflow-hidden");
    mobileMenu.classList.add("hidden");
  });
}

// Active item
let bodyClass = document.querySelector("body").className;
let menuItems = document.querySelectorAll(".menu-item");
if (menuItems) {
  for (menuItem of menuItems) {
    let menuItemsClassArchive = menuItem.dataset.classArchive;
    let menuItemsClassSingle = menuItem.dataset.classSingle;
    let menuItemsClassTax = menuItem.dataset.classTax;
    if (
      bodyClass.includes(menuItemsClassArchive) ||
      bodyClass.includes(menuItemsClassSingle) ||
      bodyClass.includes(menuItemsClassTax)
    ) {
      console.log("yes");
      menuItem.classList.add("bg-white", "dark:bg-zinc-600");
    }
  }
}
