const initialFlowers = [
    {
        name: "Mixed Bouquet",
        price: "$25.00",
        image: "buqeta1.jpg",
        description: "A vibrant bouquet of mixed flowers."
    },
    {
        name: "White Daisies",
        price: "$15.00",
        image: "daisy.jpg",
        description: "Simple and elegant white daisies."
    },
    {
        name: "Red Roses",
        price: "$30.00",
        image: "roses.jpeg",
        description: "Classic red roses with a romantic touch."
    },
    {
        name: "Pink Tulips",
        price: "$20.00",
        image: "tulips.jpg",
        description: "Delicate pink tulips perfect for any occasion."
    }
    ,{
        name: "Pink Tulips1",
        price: "$20.00",
        image: "tulips.jpg",
        description: "Delicate pink tulips perfect for any occasion."
    },
];

let flowers = [...initialFlowers];
let flowerWishlist = JSON.parse(localStorage.getItem('flowerWishlist')) || [];
let favoriteFlowers = JSON.parse(localStorage.getItem('favoriteFlowers')) || [];


function loadShopFlowers() {
    const container = document.getElementById('flower-list');
    container.innerHTML = flowers.map(flower => `
        <div class="flower-item">
            <img src="${flower.image}" alt="${flower.name}" class="flower-image">
            <p class="price">${flower.price}</p>
            <p class="description">${flower.description}</p>
            <div class="button-container">
                <button class="add-to-wishlist-btn"
                        data-flower-name="${flower.name}"
                        data-flower-price="${flower.price}"
                        data-flower-image="${flower.image}"
                        data-flower-description="${flower.description}">
                    Add to Wishlist
                </button>
                <button class="favorite-btn" 
                        data-flower-name="${flower.name}">
                    ♡
                </button>
            </div>
        </div>
    `).join('');
}

// Function to load flowers into the home gallery
function loadHomeGalleryFlowers() {
    const flowerGalleryContainer = document.querySelector('.flower-gallery');
    flowerGalleryContainer.innerHTML = '';
    
    flowers.forEach(flower => {
        flowerGalleryContainer.innerHTML += `
            <img src="${flower.image}" alt="${flower.name}" class="flower-image">
        `;
    });
}


function addToWishlist(flowerData) {
    const isDuplicate = flowerWishlist.some(item => item.name === flowerData.name);

    if (!isDuplicate) {
        flowerWishlist.push(flowerData);
        localStorage.setItem('flowerWishlist', JSON.stringify(flowerWishlist));
        updateWishlistDisplay();
        showConfirmation(`${flowerData.name} added to your wishlist!`);
    } else {
        showConfirmation(`${flowerData.name} is already in your wishlist!`, true);
    }
}

function toggleFavorite(flowerName, buttonElement) {
    const existingFlower = flowers.find(f => f.name === flowerName);
    if (!existingFlower) return;

    const index = favoriteFlowers.findIndex(fav => fav.name === flowerName);

    if (index === -1) {
        favoriteFlowers.push(existingFlower);
        buttonElement.classList.add('favorited');
        buttonElement.innerHTML = '&#x2764;';
        showConfirmation(`${flowerName} added to favorites!`);
    } else {
        favoriteFlowers.splice(index, 1);
        buttonElement.classList.remove('favorited');
        buttonElement.innerHTML = '&#x2661;';
        showConfirmation(`${flowerName} removed from favorites.`);
    }
    localStorage.setItem('favoriteFlowers', JSON.stringify(favoriteFlowers));
}

function updateWishlistDisplay() {
    const wishlistContainer = document.getElementById('flowerWishlist');

    if (flowerWishlist.length === 0) {
        wishlistContainer.innerHTML = '<li>No flowers on your wishlist yet!</li>';
        return;
    }

    wishlistContainer.innerHTML = flowerWishlist.map(flower => `
        <li class="wishlist-item">
            <img src="${flower.image}" alt="${flower.name}" class="wishlist-image">
            <div>
                <strong>${flower.name}</strong>
                <p>Price: ${flower.price}</p>
                <button class="remove-btn" data-name="${flower.name}">Remove</button>
            </div>
        </li>
    `).join('');

    document.querySelectorAll('.remove-btn').forEach(button => {
        button.addEventListener('click', function() {
            const flowerName = this.dataset.name;
            flowerWishlist = flowerWishlist.filter(item => item.name !== flowerName);
            localStorage.setItem('flowerWishlist', JSON.stringify(flowerWishlist));
            updateWishlistDisplay();
            showConfirmation(`${flowerName} removed from wishlist!`);
        });
    });
}
// Function to show confirmation messages
function showConfirmation(message, isError = false) {
    const confirmation = document.createElement('div');
    confirmation.className = `confirmation ${isError ? 'error' : ''}`;
    confirmation.textContent = message;
    document.body.appendChild(confirmation);

    setTimeout(() => confirmation.style.opacity = '1', 10);
    setTimeout(() => {
        confirmation.style.opacity = '0';
        setTimeout(() => confirmation.remove(), 500);
    }, 3000);
}

document.getElementById('clearWishlistBtn').addEventListener('click', function() {
    if (flowerWishlist.length > 0 && confirm('Are you sure you want to clear your wishlist?')) {
        flowerWishlist = [];
        localStorage.removeItem('flowerWishlist');
        updateWishlistDisplay();
        showConfirmation('Wishlist cleared!');
    }
});

document.addEventListener('click', function(event) {
    if (event.target.classList.contains('add-to-wishlist-btn')) {
        const button = event.target;
        const flowerData = {
            name: button.dataset.flowerName,
            price: button.dataset.flowerPrice,
            image: button.dataset.flowerImage,
            description: button.dataset.flowerDescription
        };
        addToWishlist(flowerData);
    } else if (event.target.classList.contains('favorite-btn')) {
        const button = event.target;
        const flowerName = button.dataset.flowerName;
        toggleFavorite(flowerName, button);
    }
    
});

document.addEventListener('DOMContentLoaded', function() {
    loadShopFlowers();
    loadHomeGalleryFlowers();
    updateWishlistDisplay();

});








