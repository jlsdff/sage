const quantity = document.querySelector("#quantity");
const quantityInput = document.querySelector("#quantity-input");
const toaster = document.querySelector("#toaster");

if(toaster){
  console.log(toaster)
  toaster.classList.remove('-translate-x-full', 'opacity-0')
  setTimeout(() => {
    toaster.classList.add('-translate-x-full', 'opacity-0')
  }, 2000)
}

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
