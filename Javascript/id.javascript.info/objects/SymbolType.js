// NOTE - Symobol Type

/**
 * ? Simbol-Simbol
 * 
 * * Sebuah “simbol” merepresentasikan sebuah pengidentifikasi yang unik.
 * * Nilai dari tipe ini dapat dibuat menggunakan Symbol():
 */
let id = Symbol()
// ?kita bisa memberikan nama ke simbol
let id2 = Symbol('id')
console.log(id)
console.log(id2)

/**
 * * Symbol pasti unik,bahkan jika kita memberikan deskripsi yang sama
 * * kecuali kita menyamakan deskripsinya
 */

let nama1 = Symbol('nama')
let nama2 = Symbol('nama')
console.log(nama1 == nama2); // false
console.log(nama1.description == nama2.description); // true

console.log('====================================');

// NOTE - Properti "tersembunyi" (Hidden)

/**
 * * Simbol memungkinkan kita untuk membuat properti-properti yang “tersembunyi” (hidden) 
 * * -> dari sebuah objek, yang mana tidak akan ada bagian lain dari kode yang bisa mengakses 
 * * -> atau meng-overwrite tanpa sengaja.
 */

let user = { nama: 'Aditya' }
let id3 = Symbol('id')
user[id3] = 1;
console.log(user[id]); // ? hanya diakses menggunakan symbol

// ? Simbol didalam objek literal, ditulis menggunakan []
let id4 = Symbol('id')
let user2 = {
    nama: 'Aditya',
    [id4]: 1234
}

/**
 * ? simbol aakan diabaikan jika dilakukan for..in,
 * ? hanya bisa diakses menggunakan simbol yang digunakan key
 */

for(let key in user2) {
    console.log(key); // ? hanya nama,
    // ? [id4], hanya bisa diakses menggunakan user2[id4]
}
//? Object.assign akan menyalin semuanya, termasuk symbol

console.log('====================================');

// NOTE - Symbol Global

// * membaca dari catatan global
let id5 = Symbol.for("id"); // jika simbol tidak ada, simbol tersebut akan dibuat

// * baca simbol tersebut lagi (mungkin dari bagian lain dari kode)
let idAgain = Symbol.for("id"); // ini akan mereference symbol yang telah dibuat sebelumyna
// * simbol yang sama
console.log(id === idAgain); // true

// ? Symbol.KeyFor

/**
 * * Untuk simbol-simbol global, tidak hanya Symbol.for(key) yang mengembalikan sebuah simbol 
 * * -> berdasarkan nama, tetapi ada sebuah panggilan sebaliknya: Symbol.keyFor(sym), 
 * * -> sintaks tersebut melakukan hal sebaliknya tadi: mengembalikan sebuah nama berdasarkan 
 * * -> sebuah simbol global.
 */

let sym = Symbol.for('nama')
let sym2 = Symbol.for('id')

console.log(Symbol.keyFor(sym)); // 'nama'
console.log(Symbol.keyFor(sym2)); // 'id'

// ? keyFor hanya bekerja untuk symbol global,
// mendapatkan simbol bersasarkan nama
let globalSymbol = Symbol.for("name");
let localSymbol = Symbol("name");

console.log( Symbol.keyFor(globalSymbol) ); // name, simbol global
console.log( Symbol.keyFor(localSymbol) ); // undefined, bukan simbol global

console.log(localSymbol.description); // name

console.log('====================================');

// NOTE - Symbol-symbol Sistem
/**
 * * Terdapat banyak simbol-simbol “sistem” yang JavaScript gunakan secara internal, 
 * * -> dan kita bisa menggunakan simbol-simbol sistem tersebut untuk mengatur dengan baik 
 * * -> berbagai aspek dari objek kita.
 * 
 * ? Dokumentasi di [https://tc39.github.io/ecma262/#sec-well-known-symbols]
 * * Contoh beberapa
 * * [1] Symbol.hasInstance
* * [2] Symbol.isConcatSpreadable
* * [3] Symbol.iterator
* * [4] Symbol.toPrimitive
* * dll...
 */

