// Get elements
const cartButton = document.querySelector('.cart-button');
const cartBadge = document.querySelector('.cart-badge');
const modal = document.querySelector('.modal');
const modalClose = document.querySelector('.close');
const buyButton = document.querySelector('.buy-btn');
const cartItemsList = document.querySelector('.cart-items');
const cartTotal = document.querySelector('.cart-total');
const itemsGrid = document.querySelector('.items-grid');
const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
const sortSelect = document.getElementById('sortSelect');




let items = [
  {
    id: 1,
    name: 'Apple',
    price: 0.99,
    image: 'apple.jpg', 
  },
  {
    id: 2,
    name: 'Banana',
    price: 10,
    image: 'banana.jpg', 
  },
  {
    id: 3,
    name: 'Orange',
    price: 4,
    image: 'orange.jpg', 
  },
  {
    id: 4,
    name: 'Plum',
    price: 6,
    image: 'plum.jpg', 
  },
];

let cart = [];

// An example function that creates HTML elements using the DOM.
function fillItemsGrid() {
  for (const item of items) {
    let itemElement = document.createElement('div');
    itemElement.classList.add('item');
    itemElement.innerHTML = `
        <div class="item-image-wrapper">
          <img src="./images/${item.image}" alt="${item.name}" class="item-image">
        </div>
        <h2>${item.name}</h2>
        <p>$${item.price}</p>
        <button class="add-to-cart-btn" data-id="${item.id}">Add to cart</button>
    `;
    itemsGrid.appendChild(itemElement);
  }

  // Add event listeners to "Add to cart" buttons
  const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
  addToCartButtons.forEach((button) => {
    button.addEventListener('click', addToCart);
  });

  items.sort((a, b) => a.name.localeCompare(b.name));
  renderFilteredItems(items);
}

// Function to add item to the cart
function addToCart(event) {
  const itemId = event.target.dataset.id;
  const selectedItem = items.find((item) => item.id.toString() === itemId);

  if (selectedItem) {
    cart.push(selectedItem);
    updateCart();
  }
}

function updateCart() {
  cartItemsList.innerHTML = '';
  let totalPrice = 0;

  const itemQuantityMap = new Map();

  for (const item of cart) {
    const itemId = item.id;
    const existingItem = itemQuantityMap.get(itemId);

    if (existingItem) {
      existingItem.quantity++;
    } else {
      itemQuantityMap.set(itemId, { ...item, quantity: 1 });
    }

    totalPrice += item.price;
  }

  for (const [itemId, item] of itemQuantityMap) {
    let cartItemElement = document.createElement('div');
    cartItemElement.classList.add('cart-item');
    cartItemElement.innerHTML = `
      <img src="images/${item.image}" alt="${item.name}">
      <h2>${item.name}</h2>
      <p>$${item.price} x ${item.quantity}</p>
      <button class="remove-from-cart-btn" data-id="${itemId}">Remove</button>
    `;
    cartItemsList.appendChild(cartItemElement);
  }

  cartTotal.textContent = `$${totalPrice.toFixed(2)}`;

  // Add event listeners to "Remove" buttons
  const removeFromCartButtons = document.querySelectorAll('.remove-from-cart-btn');
  removeFromCartButtons.forEach((button) => {
    button.addEventListener('click', removeFromCart);
  });

  // Update the cart badge
  cartBadge.textContent = itemQuantityMap.size;
  updateCartViewButton();
}


// Function to remove item from the cart
function removeFromCart(event) {
  const itemId = event.target.dataset.id;
  const itemIndex = cart.findIndex((item) => item.id.toString() === itemId);

  if (itemIndex !== -1) {
    cart.splice(itemIndex, 1);
    updateCart();
  }
}

function buyItems() {
  if (cart.length === 0) {
    alert('Your cart is empty. Please add items before purchasing.');
    return;
  }

  // Simulate purchase process
  alert('Purchase successful! Thank you for your order.');

  // Empty the cart
  cart = [];
  updateCart();
  updateCartViewButton();
  // Close the modal
  toggleModal();
}

// Adding the .show-modal class to an element will make it visible
// because it has the CSS property display: block; (which overrides display: none;)
// See the CSS file for more details.
function toggleModal() {
  modal.classList.toggle('show-modal');
  buyButton.addEventListener('click', buyItems);
}

function updateCartViewButton() {
  const cartViewButton = document.getElementById('cartViewButton');
  cartViewButton.innerHTML = `Cart <span class="cart-badge">${cart.length}</span>`;
}

function renderFilteredItems(filteredItems) {
  itemsGrid.innerHTML = '';

  for (const item of filteredItems) {
    let itemElement = document.createElement('div');
    itemElement.classList.add('item');
    itemElement.innerHTML = `
        <img src="./images/${item.image}" alt="${item.name}">
        <h2>${item.name}</h2>
        <p>$${item.price}</p>
        <button class="add-to-cart-btn" data-id="${item.id}">Add to cart</button>
    `;
    itemsGrid.appendChild(itemElement);
  }

  // Add event listeners to "Add to cart" buttons
  const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
  addToCartButtons.forEach((button) => {
    button.addEventListener('click', addToCart);
  });
}

function sortItems() {
  const sortSelect = document.getElementById('sortSelect');
  const sortOption = sortSelect.value;

  let sortedItems;
  if (sortOption === 'name') {
    sortedItems = items.sort((a, b) => a.name.localeCompare(b.name));
  } else if (sortOption === 'price') {
    sortedItems = items.sort((a, b) => a.price - b.price);
  } 
  renderFilteredItems(sortedItems);
}

// Call fillItemsGrid function when page loads
fillItemsGrid();
renderFilteredItems(items);

// Example of DOM methods for adding event handling
cartButton.addEventListener('click', toggleModal);
modalClose.addEventListener('click', toggleModal);
sortSelect.addEventListener('change', sortItems);


