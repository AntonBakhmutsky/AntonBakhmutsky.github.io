class Course {
  #price;

  constructor(title, length, price) {
    this.title = title;
    this.length = length;
    this.price = price;
  }

  set price(val) {
    if (val < 0) {
      throw 'Invalid value!';
    }
    this.#price = val;
  }

  get price() {
    return `${this.#price}$`;
  }

  calculateAmountPaid() {
    console.log(this.length / this.#price);
  }

  showSummary() {
    console.log(this.title);
    console.log(`Length...................${this.length} hours`);
    console.log(`Price.........................${this.price}`);
  }
}

const mathematics = new Course('Math Course', 48, 70);
const language = new Course('English Language course', 60, 90);

console.log(mathematics);
console.log(language);

mathematics.calculateAmountPaid();
mathematics.showSummary();
console.log('--------------------------------------------------------');
console.log('--------------------------------------------------------');
language.calculateAmountPaid();
language.showSummary();

class PracticalCourse extends Course {
  constructor(title, length, price, num) {
    super(title, length, price, num);
    this.numOfExercises = num;
  }
}

class TheoreticalCourse extends Course {
  constructor(title, length, price) {
    super(title, length, price);
  }

  publish() {
    console.log('Something');
  }
}
