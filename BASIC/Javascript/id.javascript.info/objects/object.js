// NOTE - Objek
var user1 = new Object(); // ? syntax "Konstruktor Objek"
let user = {}; // ? syntax "Literal Objek"

user = {
    nama: "John",
    age: 30
}
console.log(`Nama: ${user.nama}`);
// * juga bisa membuat value baru dengan cara
user.isSchool = true;
console.log(`isSchool: ${user.isSchool}`);
console.log('====================================');

// NOTE - Square Brackets
let buah = {};
buah["nama buah"] = "Pisang";
console.log(buah["nama buah"]);

var key1 = "nama buah";
console.log(`Dapat buah: ${buah[key1]}`); // * bisa juga seperti ini

delete (buah["nama buah"]);
console.log('====================================');

// NOTE - ShortHand Nilai Property
function makeUser(nama, age) {
    return {
        nama: nama, // ini contoh jika normalnya
        age, // ? karena key dan params sama langsung tulis satu  kali saja
        // ! untuk key dan params dengan teks yang sama,
        // ! kita bisa langsung menuliskannya satu kali saja, ingat harus sama
        // .. dan properti lainnya
    };
}

let user2 = makeUser("John", 30); // * aman tanpa error
console.log(user2); // ? {nama: "John", age: 30}
console.log('====================================');

// NOTE - Batasan nama Property
/**
 * * penamaan properti tidak memiliki batasan bahkan untuk kata seperti for, if, return, angka
 */
let cobaNama = {
    if: 'halo',
    return: 'halo',
    0: 'halo', // sama seperti "0"
}; // ini tidak akan error

// penamaan tidak bisa kepada keyword __proto__
let objCoba = {}
objCoba.__proto__ = 'halo';
console.log(`__proto__: ${objCoba.__proto__}`); // 'halo' tidak akan muncul
console.log('====================================');

// NOTE - Test keberadaan properti operator "in"
let user3 = {}
/**
 * * di javascript ketika membaca sebuah properti yang tidak ada maka akan dikembalikan
 * * -> sebagai 'undefined'
 */
console.log(user3.nama == undefined); // true
user.nama = 'Aditya'
// ? ada sebuah operator spesial "in" untuk mengecek exsistensi sebuah properti
// * "key" in object
console.log('nama' in user3); // true
console.log('age' in user3); // false

// ? in juga digunakan untuk melakukan pengulangan
let array1 = ['Aditya', 'Rizky', 'Febryanto']
for (var index in array1) {
    console.log(array1[index]);
}
let object1 = { nama: 'Aditya', age: 20 }
object1.isSchool = true;
for (var key in object1) {
    console.log(key); // nama, age, isSchool
    console.log(object1[key]); // mengembalikan valuenya
}
console.log('====================================');






