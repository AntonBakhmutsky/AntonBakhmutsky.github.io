const course = {
  title: 'JavaScript - the Complete Guide',
  rating: 5
}


// console.log(Object.getPrototypeOf(course))

Object.setPrototypeOf(course, {
  printRating: function () {
    console.log(`${this.rating}/5`)
  }
});
course.printRating()

const student = Object.create({
  printProgress: function() {
    console.log(this.progress)
  }
})

student.name = 'Max';

Object.defineProperty(student, 'progress', {
  configurable: true,
  enumerable: true,
  value: 0.8,
  writable: true
});

console.log(student)
