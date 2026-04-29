document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  const categoryFilter = document.getElementById("categoryFilter");
  const productGrid = document.getElementById("productGrid");

  if (!productGrid) {
    console.error("productGrid element not found. Make sure #productGrid exists.");
    return;
  }

  // 🔍 FILTER + SEARCH
  function filterProducts() {
    const searchText = (searchInput?.value || "").trim().toLowerCase();
    const category = (categoryFilter?.value || "all").trim().toLowerCase();

    const productCards = productGrid.querySelectorAll(".product-card");

    productCards.forEach(card => {
      const titleEl = card.querySelector("h3"); 
      const title = titleEl ? titleEl.textContent.trim().toLowerCase() : "";
      const cardCategory = (card.dataset.category || "").trim().toLowerCase();

      const matchesSearch = searchText === "" || title.includes(searchText);
      const matchesCategory = category === "all" || category === cardCategory;

      if (matchesSearch && matchesCategory) {
        card.style.display = "";
        card.classList.remove("hidden-by-filter");
      } else {
        card.style.display = "none";
        card.classList.add("hidden-by-filter");
      }
    });
  }

  if (searchInput) searchInput.addEventListener("input", filterProducts);
  if (categoryFilter) categoryFilter.addEventListener("change", filterProducts);

  filterProducts();

  //  ADD TO CART FUNCTIONALITY
  productGrid.addEventListener("click", (e) => {
    const btn = e.target.closest(".add-to-cart");
    if (!btn) return;

    const card = btn.closest(".product-card");
    if (!card) return;

    const name = card.querySelector("h3")?.textContent?.trim() || "Unknown";
    const priceEl = card.querySelector(".price");
    const priceText = priceEl?.dataset.price || priceEl?.textContent?.replace(/[^0-9.]/g, "") || "0";
    const price = parseFloat(priceText);

    const image = card.querySelector("img")?.src || "";

    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const existing = cart.find(item => item.name === name);

    if (existing) {
      existing.quantity += 1;
    } else {
      cart.push({ name, price, image, quantity: 1 });
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    alert(`${name} added to cart.`);
    console.log(`${name} added to cart.`, cart);
  });
});



// cart.js
document.addEventListener("DOMContentLoaded", () => {
  const cartContainer = document.getElementById("cartContainer");
  const cartTotal = document.getElementById("cartTotal");

  // Load cart from localStorage
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  function renderCart() {
    cartContainer.innerHTML = "";

    if (cart.length === 0) {
      cartContainer.innerHTML = "<p>Your cart is empty.</p>";
      cartTotal.textContent = "0.00";
      return;
    }

    let total = 0;

    cart.forEach((item, index) => {
      const subtotal = item.price * item.quantity;
      total += subtotal;

      const itemHTML = `
        <div class="cart-item" data-index="${index}">
          <img src="${item.image}" alt="${item.name}">
          <div class="cart-details">
            <h3>${item.name}</h3>
            <p>Price: $${item.price.toFixed(2)}</p>
          </div>
          <div class="cart-actions">
            <input type="number" value="${item.quantity}" min="1" />
            <button class="remove-btn">Remove</button>
          </div>
        </div>
      `;
      cartContainer.insertAdjacentHTML("beforeend", itemHTML);
    });

    cartTotal.textContent = total.toFixed(2);
  }

  // Update quantity
  cartContainer.addEventListener("change", (e) => {
    if (e.target.type === "number") {
      const index = e.target.closest(".cart-item").dataset.index;
      cart[index].quantity = parseInt(e.target.value);
      localStorage.setItem("cart", JSON.stringify(cart));
      renderCart();
    }
  });

  // Remove item
  cartContainer.addEventListener("click", (e) => {
    if (e.target.classList.contains("remove-btn")) {
      const index = e.target.closest(".cart-item").dataset.index;
      cart.splice(index, 1);
      localStorage.setItem("cart", JSON.stringify(cart));
      renderCart();
    }
  });

  renderCart();
});



