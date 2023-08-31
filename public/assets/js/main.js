/*Show menu*/
const navMenu = document.getElementById("nav-menu");
const navToggle = document.getElementById("nav-toggle");
const navClose = document.getElementById("nav-close");

if (navToggle) {
    navToggle.addEventListener("click", () => {
        navMenu.classList.add("show-menu");
    });
}
if (navClose) {
    navClose.addEventListener("click", () => {
        navMenu.classList.remove("show-menu");
    });
}

/*Remuve mobile menu*/
const navLink = document.querySelectorAll(".nav__link");

function linkAction() {
    const navMenu = document.getElementById("nav-menu")
    navMenu.classList.remove("show-menu")
}
navLink.forEach(n => n.addEventListener("click", linkAction));

/*Change background header*/
function scrollHeader() {
    const header = document.getElementById("header")
    if (this.scrollY >= 50) header.classList.add("scroll-header");
    else header.classList.remove("scroll-header");
}
window.addEventListener("scroll", scrollHeader);

/*Testimonial swiper*/
let testimonialSwiper = new Swiper(".testimonial-swiper", {
    spaceBetween: 30,
    loop: "true",

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

/*New swiper*/
let newSwiper = new Swiper(".new-swiper", {
    spaceBetween: 24,
    loop: "true",

    breakpoints: {
        576: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        1024: {
            slidesPerView: 4,
        }
    }
});

const sections = document.querySelectorAll("section[id]");

function scrollActive() {
    const scrollY = window.pageYOffset;

    sections.forEach(current => {
        const sectionHeight = current.offsetHeight;
        const sectionTop = current.offsetTop - 58;
        const sectionId = current.getAttribute("id");

        const link = document.querySelector(".nav__menu a[href*='" + sectionId + "']");
        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            link.classList.add("active-link");
        } else {
            link.classList.remove("active-link");
        }
    });
}

window.addEventListener("scroll", scrollActive);


/*Show scroll up*/
function scrollUp() {
    const scrollUp = document.getElementById("scroll-up");
    if (this.scrollY >= 400) scrollUp.classList.add("show-scroll");
    else scrollUp.classList.remove("show-scroll");
}
window.addEventListener("scroll", scrollUp);

/*Show cart*/
const showCart = document.getElementById("cart");
const cartShop = document.getElementById("cart-shop");
const cartClose = document.getElementById("cart-close");

if (cartShop) {
    cartShop.addEventListener("click", () => {
        showCart.classList.add("show-cart");
    });
}
if (cartClose) {
    cartClose.addEventListener("click", () => {
        showCart.classList.remove("show-cart");
    });
}

/*Dark light theme*/
const themeButton = document.getElementById("theme-button");
const darkTheme = "dark-theme";
const iconTheme = "bx-sun"
const selectedTheme = localStorage.getItem("selected-theme");
const selectedIcon = localStorage.getItem("selected-icon");

const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? "dark" : "light";
const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? "bx bx-moon" : "bx bx-sun";

if (selectedTheme) {
    document.body.classList[selectedTheme === "dark" ? "add" : "remove"](darkTheme);
    themeButton.classList[selectedIcon === "bx bx-moon" ? "add" : "remove"](iconTheme);
}

themeButton.addEventListener("click", () => {
    document.body.classList.toggle(darkTheme);
    themeButton.classList.toggle(iconTheme);
    localStorage.setItem("selected-theme", getCurrentTheme());
    localStorage.setItem("selected-icon", getCurrentIcon());
})

/*Display products*/
const productsEl = document.querySelector(".products__container");
const featuredEl = document.querySelector(".featured__container");
const newArrivalsEl = document.querySelector(".new__products__container");
const cartItemsEl = document.querySelector(".cart__container");
const totalPriceEl = document.querySelector(".cart__prices-total");
const totalItemsEl = document.querySelector(".cart__prices-item");
const totalItemsInCartEl = document.querySelector(".total-items-cart");

function renderProducts() {
    products.forEach((product) => {
        productsEl.innerHTML += `
        <article class="products__card">
        <a href="product/${product.id}">
                <img src="${product.img}" alt="" class="products__img">
                <h3 class="products__title">${product.title}</h3>
                <span class="products__price">${product.price}</span>
                </a>
                <button class="products__button" onclick="addToCart(${product.id})">
                    <i class='bx bx-shopping-bag add-cart'></i>
                </button>
            </article>
        `;
    })
}
try {
    renderProducts();
} catch (error) {

}

function renderFeaturedProducts() {
    featured.forEach((featured) => {
        featuredEl.innerHTML += `
            <article class="featured__card">
                <span class="featured__tag">Sale</span>
                <img src="${featured.img}" alt="" class="featured__img">
                <div class="featured__data">
                    <h3 class="featured__title">${featured.title}</h3>
                    <span class="featured__price">${featured.price}</span>
                </div>
                <div class="featured__button">
                    <a href="product/${featured.id}" class="featured__button button button--gray button--small">Discover</a>
                    <button class="button featured__button" onclick="addToCart(${featured.id})">ADD TO CART</button>
                </div>
            </article>
        `;
    })
}
try {
    renderFeaturedProducts();
} catch (error) {}

function renderArrivalProducts() {
    newArrivals.forEach((newArrivals) => {
        newArrivalsEl.innerHTML += `
            <article class="new__card swiper-slide">
                <span class="new__tag">New</span>
                <img src="${newArrivals.img}" alt="" class="new__img">
                <div class="new__data">
                    <h3 class="new__title">${newArrivals.title}</h3>
                    <span class="new__price">$${newArrivals.price}</span>
                </div>
                <div >
                    <a href="product/${newArrivals.id}" class="new__button button button--gray button--small">Discover</a>
                    <button class="button new__button" onclick="addToCart(${newArrivals.id})">ADD TO CART</button>
                </div>
            </article>
        `;
    })
}
try {
    renderArrivalProducts();
} catch (error) {}

/*Cart functions*/
let cart = JSON.parse(localStorage.getItem("CART"+logedInUser)) || [];
updateCart();

function addToCart(id) {

    if (cart.some((item) => item.id === id)) {
        changeNumberOfUnits("plus", id)
    } else {
        const item = products.find((product) => product.id === id)
        const featItem = featured.find((feat) => feat.id === id)
        const newItem = newArrivals.find((newArr) => newArr.id === id)
        const homeItem = home.find((homeProd) => homeProd.id === id)
        cart.push({
            ...item,
            ...featItem,
            ...newItem,
            ...homeItem,
            numberOfUnits: 1,
        });
    }
    updateCart();
}

function updateCart() {
    renderCartItems();
    renderSubtotal();

    localStorage.setItem("CART"+logedInUser, JSON.stringify(cart));
}

function renderSubtotal() {
    let totalPrice = 0,
        totalItems = 0;
    cart.forEach((item) => {
        totalPrice += item.price * item.numberOfUnits;
        totalItems += item.numberOfUnits;
    })

    totalPriceEl.innerHTML = `$ ${totalPrice.toFixed(2)}`;
    totalItemsEl.innerHTML = `${totalItems}`;
    totalItemsInCartEl.innerHTML = totalItems;
}

function renderCartItems() {
    cartItemsEl.innerHTML = "";
    cart.forEach((item) => {
        cartItemsEl.innerHTML += `
        <article class="cart__card">
        <div class="cart__box">
            <img src="${item.img}" alt="" class="cart__img">
        </div>
        <div class="cart__details">
            <h3 class="cart__title">${item.title}</h3>
            <span class="cart__price">$ ${item.price}</span>
            <div class="cart__amount">
                <div class="cart__amount-content">
                    <span class="cart__amount-box" onclick="changeNumberOfUnits('minus', ${item.id})">
                        <i class='bx bx-minus'></i>
                    </span>
                    <span class="cart__amount-number">${item.numberOfUnits}</span>
                    <span class="cart__amount-box" onclick="changeNumberOfUnits('plus', ${item.id})">
                        <i class='bx bx-plus'></i>
                    </span>
                </div>
                <i class="bx bx-trash-alt cart__amount-trash" onclick="removeItemFromCart(${item.id})"></i>
            </div>
        </div>
        </article>
        `;
    })
}

function removeItemFromCart(id) {
    cart = cart.filter((item) => item.id !== id);

    updateCart();
}

function changeNumberOfUnits(action, id) {
    cart = cart.map((item) => {
        let numberOfUnits = item.numberOfUnits;
        if (item.id === id) {
            if (action === "minus" && numberOfUnits > 1) {
                numberOfUnits--;
            } else if (action === "plus" && numberOfUnits < item.instock) {
                numberOfUnits++;
            }
        }
        return {
            ...item,
            numberOfUnits,
        };
    })

    updateCart();
}
/* spwier to show product */
var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
});
// // // // //
function updateCartHTML() {
    // Get the container element to fill
    var container = document.querySelector('.col-25 .container');
    var totalPriceElement = document.querySelector('.price b');
    let totalElemts = 0;
    // Loop through the cart data and generate HTML for each item
    for (var i = 0; i < cart.length; i++) {
        var item = cart[i];
        totalElemts += 1 * item.numberOfUnits;
        var itemHTML = `<p><a href="#">${item.title}</a> <span class="price">${item.numberOfUnits} x $${item.price}</span></p>`;
        container.insertAdjacentHTML('beforeend', itemHTML);
    }
    // Calculate and add the total price
    var totalPrice = cart.reduce((total, item) => total + item.price * item.numberOfUnits, 0);
    var totalHTML = `<hr><p>Total <span class="price"><b>$${totalPrice}</b></span></p>`;
    container.insertAdjacentHTML('beforeend', totalHTML);
    totalPriceElement.textContent = totalElemts;
}

// sending data to route('cart') Post
function sendCart() {
    fetch('http://shop.test/cart', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(cart),
        })
        .then(response => {
            if (!response.ok) {
                cart = [];
                updateCart();
                window.location.href = "http://shop.test";
            }
            return response.text();
        })
        .then(data => {
            if (data.startsWith("cart has ben added:")){
                cart = [];
                updateCart();
                window.location.href = "http://shop.test/checkout/" + data.replace("cart has ben added:",'')
            }else{
                // window.location.href = "http://shop.test";
            }
        })
        .catch(error => {
            console.error("An error occurred:", error);
        });

}
