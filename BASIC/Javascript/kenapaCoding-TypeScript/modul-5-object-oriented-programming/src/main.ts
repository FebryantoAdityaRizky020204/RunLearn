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
    name: string;
    price: number;

    constructor(name: string, price: number){
        this.name = name
        this.price = price
    }

    displayProduct(): void {
        console.log(`Product: ${this.name}, Price: ${this.price}`);
    }
}

const product1 = new Product("Apple", 5)
product1.displayProduct()

// @======================== Inheritance
/**
 * *inheritance memungkinkan kita membuat class baru yang mewarisi properti dan method dari class lain (parentnya)
 * *-> class yang mewarisi disebut subclass, dan class yang diwarisi disebut superclass
 */

class Electronic extends Product {
    warranty: number;
    constructor(name: string, price: number, warranty: number){
        super(name, price)
        this.warranty = warranty
    }

    displayProduct(): void {
        super.displayProduct()
        console.log(`Warranty: ${this.warranty} years`);
    }
}

const electronic1 = new Electronic("Smartphone", 500, 2)
electronic1.displayProduct()
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
    public name: string;
    private id: number;
    protected umur: number = 21;
    readonly version: number = 1.1;

    constructor(name: string, id: number){
        this.name = name
        this.id = id
    }

    private test(): void{
        console.log("ini cuman test: ", this.id);
    }

    protected testDua(): void {
        console.log("Version: ", this.version);
    }
}

class ExampleTwo extends ExampleOne {
    constructor(name: string, id: number){
        super(name, id)
    }

    public testOne(){
        console.log("Public: ", this.name);
        //console.log("Private: ", this.id); //! Error
        console.log("Protected: ", this.umur);
        super.testDua()
        // super.test() //! Error, karena private, dan ini class turunan
    }
}

const exOne = new ExampleOne("tes1", 123)
console.log(exOne.name);
// console.log(exOne.id); // !ini error



// @======================== Shothand Initialization
/**
 * *typescript memungkinkan shorthand untuk menginisialisasi properti langsung dari parameter konstruktor tanpa mendeklarasikan
 * *-> properti di luar konstruktor
 */
class TestUser {
    constructor(public name: string, private age: number){}
}
const userOne = new TestUser("Alice", 30)

// @======================== Polymorphism
/**
 * *polymorphism memungkinkan method yang sama digunakan dengan cara berbeda-beda pada kelas yang berbeda-beda, polimorfisme
 * *-> bisa dicapai melalui method overriding (mengubah implementasi metode dari superclass di subclass)
 */

class Animal {
    makeSound(){
        console.log("Some generic animal sound");
    }
}

class Dog extends Animal {
    makeSound(): void {
        console.log("Bark");
    }
}


// @======================== Static method dan properties
/**
 * *class dapat memiliki metode dan properti statis yang tidak terikat pada instance, tetapi pada kelas itu sendiri
 */
class Calculator{
    static pi: number = 3.14;
    static calculateArea(radius: number): number {
        return Calculator.pi * radius * radius;
    }
}

console.log(Calculator.calculateArea(21));

// @======================== Getters dan Setters
/**
 * *getters dan setters adalah metode khusus yang digunakan untuk mengakses dan memodifikasi properti secara terkendali,
 * *-> mereka digunakan untuk menyembunyikan detail implementasi
 * *
 */

class Person {
    private _age: number;
    constructor(age: number){
        this._age = age
    }

    // ?Getter untuk membaca nilai _age
    get age(): string{
        return `${this._age} years old`
    }

    // ?setter untuk mengubah nilai _age
    set age(newAge: number){
        if(newAge > 0){
            this._age = newAge
        } else {
            console.error("Invalid Age");
        }
    }
}

// ?untuk mengambil/mengatur nilai _age, bisa menggunakan (setter/getter) .age
const personOne = new Person(21)
console.log(personOne.age);// ?"output: 21 years old"
personOne.age = 22
console.log(personOne.age); // ?"output: 22  years old"
personOne.age = -5 // ?"output: invalid age"
console.log(personOne.age); // ?"output: 22  years old"

// @======================== Abstract Class
/**
 * *abstract class adalah class yang tidak bisa diinstansiasi langsung. abstract class biasanya digunakan sebagai template
 * *-> untuk class turunan. class turunan harus mengimplementasikan metode abstrak yang didefinisikan di abstract class.
 */
abstract class AnotherAnimal {
    abstract makeSound(): void; // $abstract method

    move(): void {
        console.log("Moving...");
    }
}

class AnotherDog extends AnotherAnimal {
    makeSound(): void {
        console.log("Bark... !!");
    }
}

const dogTwo = new AnotherDog()
dogTwo.makeSound()
dogTwo.move()


// @======================== Interface di typescript
/**
 * *dalam ts, interface digunakan untuk mendefinisikan bentuk (shape) dari objek, interface mendeskripsikan properti dan tipe dari
 * *-> suatu objek, serta bisa mencakup method, dengan menggunakan interface, kita dapat memastikan bahwa objek memiliki struktur
 * *-> tertentu.
 */

// $contoh interface yang mendefinisikan struktur dari objek User
interface User {
    name: string,
    age: number,
    isAdmin: boolean,
    email?: string // $opsional,
    greet(): string
}

const user1: User = {
    name: "Aditya",
    age: 21,
    isAdmin: true,
    greet() {return `halo ${this.name}`}
}

// $menggabungkan interface (interface merging)
/**
 * *ts memungkinkan penggabungan interface dengan nama yang sama, properti dari semua deklarasi interface yang memiliki nama 
 * *-> yang sama akan digabungkan
 */
interface PersonThree {
    name: string;
}

interface PersonThree {
    age: number;
}

const personThree: PersonThree = {
    name: "Bob",
    age: 40,
}


// $Pewarisan Interface
interface Employee extends PersonThree {
    employeeId: number;
}

const empOne: Employee = {
    name: "Aditya",
    age: 22,
    employeeId: 324
}


// @======================== Index Signatures
/**
 * *index signatures memungkinkan pembuatan objek yang memiliki properti dinamis
 * *
 */
interface StudentScores {
    [studentName: string]: number
}

let scoresOne: StudentScores = {
    Aditya: 100,
    Rizky: 98,
    Febryanto: 99
}

console.log(scoresOne.Aditya);

interface StudentNumPhone {
    [studentId: number]: number
}

let studentPhone: StudentNumPhone = {
    101: 84756473872,
    102: 12837192831,
}
console.log(studentPhone[101]);


// $interface untuk function types
interface Add {
    (a: number, b: number):number
}

const add: Add = (a,b) => a + b

// @======================== Interface VS [OPTIONAL Type Aliases]

// *........... udah dibahas diatas, buka di doc typescript

type PersonX = {
    name: string
}

type AgeX = {
    age: number
}

type AnotherX = AgeX & { 
    nama: string
}

const orang: PersonX & AgeX = {
    name: "Aditya",
    age: 21
}

