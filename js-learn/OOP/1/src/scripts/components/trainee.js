class Product {
  constructor(title, image, desc, price) {
    this.title = title;
    this.imageUrl = image;
    this.description = desc;
    this.price = price;
  }
}

class ElementAttribute {
  constructor(attrName, attrValue) {
    this.name = attrName;
    this.value = attrValue;
  }
}

class Component {
  constructor(renderHookSelector, shouldRender = true) {
    this.hookSelector = renderHookSelector;
    if (shouldRender) {
      this.render();
    }
  }

  render() {
  }

  createRootElement(tag, cssClasses, attributes) {
    const rootElement = document.createElement(tag);
    if (cssClasses) {
      rootElement.className = cssClasses;
    }
    if (attributes && attributes.length > 0) {
      for (const attr of attributes) {
        rootElement.setAttribute(attr.name, attr.value);
      }
    }
    document.querySelector(this.hookSelector).append(rootElement);
    return rootElement;
  }
}

class Cart extends Component {
  items = [];

  set cartItems(value) {
    this.items = value;
    this.totalOutput.innerHTML = `<h2>Total:\$${this.totalAmount.toFixed(2)}</h2>`;
  }

  get totalAmount() {
    return this.items.reduce((prevValue, currentItem) => prevValue + currentItem.price, 0);
  }

  constructor(renderHookSelector) {
    super(renderHookSelector, false);
    this.orderProduct = () => {
      console.log('Ordering...');
      console.log(this.items);
    }
    this.render();
  }

  addProduct(product) {
    const updatedItems = [...this.items];
    updatedItems.push(product);
    this.cartItems = updatedItems;
  }

  render() {
    const cartEl = this.createRootElement('section', 'cart');
    cartEl.innerHTML = `
      <h2>Total:\$${0}</h2>
      <button>Order now!</button>
    `;
    const orderButton = cartEl.querySelector('button');
    // orderButton.addEventListener('click', () => this.orderProduct());
    orderButton.addEventListener('click', this.orderProduct);
    this.totalOutput = cartEl.querySelector('h2');
  }
}

class ProductItem extends Component {
  constructor(product, renderHookSelector) {
    super(renderHookSelector, false);
    this.product = product;
    this.render();
  }

  addToCart() {
    App.addProductToCart(this.product);
  }

  render() {
    const prodEl = this.createRootElement('li', 'product-item');
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
  }
}

class ProductList extends Component {
  products = [];

  constructor(renderHookSelector) {
    super(renderHookSelector);
    this.fetchProducts();
  }

  fetchProducts() {
    this.products = [
      new Product(
        'A pillow',
        'https://hnsfpau.imgix.net/5/images/detailed/181/INCREDI_PILLOW_STACK.jpg?fit=fill&bg=0FFF&w=1500&h=1000&auto=format,compress',
        'A soft pillow',
        19.99
      ),
      new Product(
        'A Carpet',
        'https://5.imimg.com/data5/UM/HW/AH/SELLER-10198195/room-carpet-500x500.jpg',
        'A carpet which you might like -or not.',
        89.99
      )
    ];
    this.renderProducts();
  }

  renderProducts() {
    for (const prod of this.products) {
      new ProductItem(prod, '.product-list');
    }
  }

  render() {
    this.createRootElement('ul', 'product-list');
    if (this.products && this.products.length > 0) {
      this.renderProducts();
    }
  }
}

class Shop {
  constructor() {
    this.render();
  }

  render() {
    this.cart = new Cart('#app');
    new ProductList('#app');
  }
}

class App {
  static cart;

  static init() {
    const shop = new Shop();
    this.cart = shop.cart;
  }

  static addProductToCart(product) {
    this.cart.addProduct(product);
  }
}

App.init();

