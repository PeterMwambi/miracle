const slider = {
  body: document.querySelector(".dpz__slider"),
  active: document.querySelector(".dpz__slider ul li div h6.active"),
  pointer: document.querySelectorAll(".dpz__slider ul li div h6"),
  pointerBody: document.querySelector(".dpz__slider ul li div"),
};

function animateSlider() {
  setTimeout(() => {
    for (let x = 0; x <= slider.pointer.length; x++) {
      if (typeof slider.pointer[x] !== "undefined") {
        if (slider.pointer[x].classList.contains("active")) {
          slider.pointer[x].classList.remove("active");
          slider.pointer[x].style.backgroundColor =
            "rgba(174, 174, 174, 0.784)";
          var next = x + 1;
        } else {
          // clearInterval(1);
          if (typeof slider.pointer[next] !== "undefined") {
            slider.pointer[next].classList.add("active");
            if (slider.pointer[next].classList.contains("active")) {
              slider.pointer[next].getAttribute("data-item");
            }
          }
        }
      }
    }
  }, 5000);
}

animateSlider();

// slider.pointer.forEach((item) => {
//   if (item.classList.contains("active")) {
//     setTimeout(() => {
//       item.classList.remove("active");
//     }, 5000);
//   }
//   let data = [];
//   data.push(item);
//   data.forEach(function (item) {
//     item.classList.add("active");
//   });
// });

// for (x = 0; x <= slider.pointer.length; x++) {
//   if (typeof slider.pointer[x] !== "undefined") {
//     var items = slider.pointer[x].getAttribute("data-item");
//     var array = [];
//     array.push(slider.pointer[x]);
//     console.log(array);
//   }
// }
