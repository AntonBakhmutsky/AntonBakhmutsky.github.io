class Product {
  constructor(title, image, desc, price) {
    this.title = title;
    this.imageUrl = image;
    this.description = desc;
    this.price = price;
  }
}

class Cart {
  items = [];

  addProduct(product) {
    this.items.push(product);
    this.totalOutput.innerHTML = `<h2>Total:\$${1}</h2>`;
  }

  render() {
    const cartEl = document.createElement('section');
    cartEl.innerHTML = `
      <h2>Total:\$${0}</h2>
      <button>Order now!</button>
    `;
    cartEl.className = 'cart';
    this.totalOutput = cartEl.querySelector('h2');
    return cartEl;
  }
}

class ProductItem {
  constructor(product) {
    this.product = product;
  }

  addToCart() {
    App.addProductToCart(this.product);
  }

  render() {
    const prodEl = document.createElement('li');
    prodEl.className = 'product-item'
    prodEl.innerHTML = `
        <div>
          <img src="${this.product.imageUrl}" alt="${this.product.title}">
          <div class="product-item__content">
            <h2>${this.product.title}</h2>
            <h3>\$${this.product.price}</h3>
            <p>${this.product.description}</p>
            <button>Add to cart</button>
          </div>
        </div>
      `;
    const addCartButton = prodEl.querySelector('button');
    addCartButton.addEventListener('click', this.addToCart.bind(this))
    return prodEl;
  }
}

class ProductList {
  products = [
    new Product(
      'A pillow',
      'https://hnsfpau.imgix.net/5/images/detailed/181/INCREDI_PILLOW_STACK.jpg?fit=fill&bg=0FFF&w=1500&h=1000&auto=format,compress',
      19.99,
      'A soft pillow'
    ),
    new Product(
      'A Carpet',
      'https://5.imimg.com/data5/UM/HW/AH/SELLER-10198195/room-carpet-500x500.jpg',
      89.99,
      'A carpet which you might like -or not.'
    )
  ];

  constructor() {}

  render() {
    const prodList = document.createElement('ul');
    prodList.className = 'product-list';
    for (const prod of this.products) {
      const productItem = new ProductItem(prod);
      const prodEl = productItem.render();
      prodList.append(prodEl);
    }
    return prodList;
  }
}

class Shop {
  render() {
    const renderHook = document.querySelector('#app');

    this.cart = new Cart();
    const cartEl =  this.cart.render();
    const productList = new ProductList();
    const productListEl =  productList.render();

    renderHook.append(cartEl);
    renderHook.append(productListEl);
  }
}

class App {
  static cart;

  static init() {
    const shop = new Shop();
    shop.render();
    this.cart = shop.cart;
  }

  static addProductToCart(product) {
    this.cart.addProduct(product);
  }
}

App.init();

