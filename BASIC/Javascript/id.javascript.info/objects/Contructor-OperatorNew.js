// NOTE - Konstruktor

/**
 * * fungsi konstruktor biasanya menggunakan huruf kapital sebagai awalan
 * * dieksekusi menggunakan operator new
 */

function User(name) {
    // this = {} // secara implisit ketika membuat konstruktor
    this.nama = name;
    this.isAdmin = false
}

let user = new User('Aditya');
console.log(user.nama);
console.log(user.isAdmin);

console.log('====================================');
// NOTE - Constructor mode target : new.target
// ? sintaks ini jarang digunakan

/**
 * * Di dalam sebuah fungsi, kita dapat memeriksa apakah fungsi tersebut dipanggil 
 * * -> dengan atau tanpa new, dengan cara menggunakan sebuah properti khusus new.target.
 */

function User2() {
    return new.target;
}
console.log(`tanpa new : ${User2()}`); 
console.log(`dengan new : ${new User2()}`);

function User3() {
    console.log(new.target);
}
User3() // undefined
new User3() // [Function: User3]

console.log('====================================');

// NOTE - hasil return dari konstruktor
/**
 * * [1] Jika return dipanggil dengan sebuah objek, maka objek tersebut dikembalikan sebagai ganti this.
 * * [2] Jika return dipanggil dengan sebuah primitive, panggilan tersebut diabaikan.
 * 
 * ? dengan kata lain, return dengan sebuah objek mengembalikan objek itu, 
 * ? -> dalam  kasus lainnya this dikembalikan.
 */

function BigUser() {
    this.name = 'John';
    return {name : 'Godzilla'} // ? ini direturn
}
console.log(new BigUser().name); // ? Godzilla, mendapatkan objeknya

function SmallUser() {
    this.name = "John";
    return; // <-- mengembalikan this
}
console.log(new SmallUser().name);  // John

console.log('====================================');

// NOTE - method dalam konstruktor
function User4(nama) {
    this.nama = nama;
    this.sayHi = function() {
        console.log(`Hallo ${this.nama}`);
    }
}

let userr = new User4('Aditya Rizky');
userr.sayHi()

