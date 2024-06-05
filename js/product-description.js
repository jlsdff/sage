const quantity = document.querySelector("#quantity");
const quantityInput = document.querySelector("#quantity-input");

document.querySelector("#increment").addEventListener("click", () => {
  quantity.innerHTML = +quantity.innerHTML + 1;
  quantityInput.value = +quantity.innerHTML;
});

document.querySelector("#decrement").addEventListener("click", () => {
  if (+quantity.innerHTML > 1) {
    quantity.innerHTML = +quantity.innerHTML - 1;
    quantityInput.value = +quantity.innerHTML;
  }
});

document.querySelector("#like_checkbox").addEventListener("click", () => {
  console.log("Like");
});
