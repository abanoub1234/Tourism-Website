const addToCartButton = document.getElementById('addToCartButton');
const confirmationDialog = document.getElementById('confirmationDialog');
const confirmAddToCartButton = document.getElementById('confirmAddToCart');
const cancelAddToCartButton = document.getElementById('cancelAddToCart');

addToCartButton.addEventListener('click', () => {
    confirmationDialog.showModal();
});

confirmAddToCartButton.addEventListener('click', () => {
    confirmationDialog.close();
});

cancelAddToCartButton.addEventListener('click', () => {
    confirmationDialog.close();
});