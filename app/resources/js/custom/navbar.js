/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Thu Oct 12 2023 23:17:47 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract This file stores all navbar configuration properties
 */

const navbar = {
  toggler: document.querySelector(".blog__navbar .nav-brand > div:last-child"),
  menuItems: document.querySelector(".blog__navbar ul"),
};

navbar.toggler.addEventListener("click", function () {
  let menuItems = window.getComputedStyle(navbar.menuItems);
  if (menuItems.display === "none") {
    navbar.menuItems.style.display = "block";
  } else {
    navbar.menuItems.style.display = "none";
  }
});
