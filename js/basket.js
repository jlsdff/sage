
const items = document.querySelectorAll('.__item');

items.forEach(element => {
  // console.log(element);
  const quantity = +element.querySelector('.__product_quantity').textContent;
  const price = +element.querySelector('.__product_price').textContent.replace('₱', '');
  const totalPrice = `₱${quantity * price}`;
  console.log(quantity)
  console.log(price)
  console.log(totalPrice)
  console.log("\n")
  element.querySelector('.__total_price').textContent = totalPrice;
});
