
const items = document.querySelectorAll('.__item');


items.forEach(element => {
  console.log(element);
  const quantity = +element.querySelector('span').textContent;
  const price = +element.querySelector('.__product_price').textContent.replace('₱', '');
  const totalPrice = `₱${quantity * price}`;
  element.querySelector('.__total_price').textContent = totalPrice;
});
