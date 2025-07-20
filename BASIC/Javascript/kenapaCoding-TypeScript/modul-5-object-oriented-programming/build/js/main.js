"use strict";
// @======================== Object Oriented Programming
/**
 * *ts memperluas kemampuan js dengan menambahkan fitur" oop seperti class, inheritance, modifiers (public, private, protected),
 * *-> interfaces, dan abstract class. dengan oop pengembangan aplikasi menjadi lebih terstruktur, modular dan mudah dikelola
 * *
 * *->
 */
// $Class dan Constructor
/**
 * *class adalah blueprint untuk membuat objek, didalam class kita bisa mendefinisikan properti dan metode, constructor adalah
 * *-> method khusus yang digunakan untuk menginisialisasi objek baru ketika class diinstansiasi
 */
class Product {
    constructor(name, price) {
        this.name = name;
        this.price = price;
    }
    displayProduct() {
        console.log(`Product: ${this.name}, Price: ${this.price}`);
    }
}
const product1 = new Product("Apple", 5);
product1.displayProduct();
// @======================== Inheritance
/**
 * *inheritance memungkinkan kita membuat class baru yang mewarisi properti dan method dari class lain (parentnya)
 * *-> class yang mewarisi disebut subclass, dan class yang diwarisi disebut superclass
 */
class Electronic extends Product {
    constructor(name, price, warranty) {
        super(name, price);
        this.warranty = warranty;
    }
    displayProduct() {
        super.displayProduct();
        console.log(`Warranty: ${this.warranty} years`);
    }
}
const electronic1 = new Electronic("Smartphone", 500, 2);
electronic1.displayProduct();
console.log(electronic1.warranty);
// @======================== Public, Private, Protected dan Readonly Modifiers
/**
 * *modifiers digunakan untuk mengatur visibilitas properti dan metode dalam class, typescript menyediakan beberapa modifier
 * *# public
 * *# private
 * *# protected
 * *# readonly
 */
// $Public (default), dapat diakses dari mana saja
// $Private, hanya bisa diakses di dalam class itu sendiri
// $protected, serupa dengan private, tetapi properti/method dapat diakses oleh class turunan
// $readonly, hanya bisa diinisialisasi saat deklarasi atau didalam constructor, setelah itu tidak bisa diubah
class ExampleOne {
    constructor(name, id) {
        this.umur = 21;
        this.version = 1.1;
        this.name = name;
        this.id = id;
    }
    test() {
        console.log("ini cuman test: ", this.id);
    }
    testDua() {
        console.log("Version: ", this.version);
    }
}
class ExampleTwo extends ExampleOne {
    constructor(name, id) {
        super(name, id);
    }
    testOne() {
        console.log("Public: ", this.name);
        //console.log("Private: ", this.id); //! Error
        console.log("Protected: ", this.umur);
        super.testDua();
        // super.test() //! Error, karena private, dan ini class turunan
    }
}
const exOne = new ExampleOne("tes1", 123);
console.log(exOne.name);
// console.log(exOne.id); // !ini error
// @======================== Shothand Initialization
/**
 * *typescript memungkinkan shorthand untuk menginisialisasi properti langsung dari parameter konstruktor tanpa mendeklarasikan
 * *-> properti di luar konstruktor
 */
class TestUser {
    constructor(name, age) {
        this.name = name;
        this.age = age;
    }
}
const userOne = new TestUser("Alice", 30);
// @======================== Polymorphism
/**
 * *polymorphism memungkinkan method yang sama digunakan dengan cara berbeda-beda pada kelas yang berbeda-beda, polimorfisme
 * *-> bisa dicapai melalui method overriding (mengubah implementasi metode dari superclass di subclass)
 */
class Animal {
    makeSound() {
        console.log("Some generic animal sound");
    }
}
class Dog extends Animal {
    makeSound() {
        console.log("Bark");
    }
}
// @======================== Static method dan properties
/**
 * *class dapat memiliki metode dan properti statis yang tidak terikat pada instance, tetapi pada kelas itu sendiri
 */
class Calculator {
    static calculateArea(radius) {
        return Calculator.pi * radius * radius;
    }
}
Calculator.pi = 3.14;
console.log(Calculator.calculateArea(21));
// @======================== Getters dan Setters
/**
 * *getters dan setters adalah metode khusus yang digunakan untuk mengakses dan memodifikasi properti secara terkendali,
 * *-> mereka digunakan untuk menyembunyikan detail implementasi
 * *
 */
class Person {
    constructor(age) {
        this._age = age;
    }
    // ?Getter untuk membaca nilai _age
    get age() {
        return `${this._age} years old`;
    }
    // ?setter untuk mengubah nilai _age
    set age(newAge) {
        if (newAge > 0) {
            this._age = newAge;
        }
        else {
            console.error("Invalid Age");
        }
    }
}
// ?untuk mengambil/mengatur nilai _age, bisa menggunakan (setter/getter) .age
const personOne = new Person(21);
console.log(personOne.age); // ?"output: 21 years old"
personOne.age = 22;
console.log(personOne.age); // ?"output: 22  years old"
personOne.age = -5; // ?"output: invalid age"
console.log(personOne.age); // ?"output: 22  years old"
// @======================== Abstract Class
/**
 * *abstract class adalah class yang tidak bisa diinstansiasi langsung. abstract class biasanya digunakan sebagai template
 * *-> untuk class turunan. class turunan harus mengimplementasikan metode abstrak yang didefinisikan di abstract class.
 */
class AnotherAnimal {
    move() {
        console.log("Moving...");
    }
}
class AnotherDog extends AnotherAnimal {
    makeSound() {
        console.log("Bark... !!");
    }
}
const dogTwo = new AnotherDog();
dogTwo.makeSound();
dogTwo.move();
const user1 = {
    name: "Aditya",
    age: 21,
    isAdmin: true,
    greet() { return `halo ${this.name}`; }
};
const personThree = {
    name: "Bob",
    age: 40,
};
const empOne = {
    name: "Aditya",
    age: 22,
    employeeId: 324
};
let scoresOne = {
    Aditya: 100,
    Rizky: 98,
    Febryanto: 99
};
console.log(scoresOne.Aditya);
let studentPhone = {
    101: 84756473872,
    102: 12837192831,
};
console.log(studentPhone[101]);
const add = (a, b) => a + b;
const orang = {
    name: "Aditya",
    age: 21
};
