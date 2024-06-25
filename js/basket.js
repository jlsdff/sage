
if(document.querySelector('#num_rows')) {
  document.querySelector('#basket_table').classList.add('hidden');
  document.querySelector('#no_item').classList.remove('hidden');
}

const itemCheckbox = document.querySelectorAll('input[data-checkbox]');

// If one or more checkboxes are checked, make checkout_button disabled false
itemCheckbox.forEach(element => {
  element.addEventListener('change', () => {
    const checkedItems = document.querySelectorAll('input[data-checkbox]:checked');
    const checkoutButton = document.querySelector('#checkout_button');
    checkoutButton.disabled = checkedItems.length === 0;
  });
});




document.querySelectorAll("input[data-checkbox]").forEach(element => {
  
});

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
