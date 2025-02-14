// NOTE - ANGKA

/**
 * ? ada dua tipe angka dalam javascript
 * * angka reguler, dan bigInt
 */

// ?Penulisan Angka 
let angka = 1000000000
angka = 1000_000_000 // * sama saja, _ digunakan untuk memudahkan membaca angka

let miliar = 1e9 // 1 dan 9buah angka 0
console.log(7.3e9); // 7.3 miliar, 7300_000_000

// ? 1.23e6 = 1.23 * 1000_000 = 123000

let ms = 0.000001
ms = 1e-6 // ? sama saja, 1 berada di 6 angka di belakang koma

// ? Hexadecimal
// * 0xff = 255

// NOTE - toString

/**
 * ? Metode num.toString(base) mengembalikan representasi string dari num di sistem numeral 
 * ? -> dengan base yang diberikan.
 * 
 * ? base bisa bervariasi dari 2 hingga 36. Defaultnya 10.
 * 
 * * Umumnya
 * * [1] base=16 dipakai untuk warna hex, character encoding dll, digit bisa 0..9 atau A..F.
 * * [2] base=2 paling banyak untuk mendebug operasi bitwise, digit bisa 0 atau 1.
 * * [3] base=36 ini maximum,
 * 
 * ? terserah mau base berapa
 * 
 */

let num = 16
console.log(`Base 2: ${num.toString(2)}`);
console.log(num.toString(2));
console.log(16..toString(2)); // ? sama saja, harus menggunakan
                            // ? -> dua titik(..), jika ingin langusng konversi dari angka
                            
// NOTE - Pembulatan

// ? Pembulatan ke bawah
console.log(Math.floor(7.3)); // 7
// ? Pembulatan ke atas
console.log(Math.ceil(7.3)); // 8
// ? Pembulatan ke tengah, atau angka terdekat
console.log(Math.round(7.3)); // 7
// ? menghapus angka setelah koma, tidak didukung internet explorer
console.log(Math.trunc(3.1)) // 3

// ? Pembulatan ke n-digit setelah koma, misal 1.232 menjadi 1.23
console.log(1.238.toFixed(2)); // ? 1.24, membulatkan angka menjadi n toFixed(n) setelah koma, .round
console.log(1.23.toFixed(5)); // ? 1.23000, jika angka tidak cukup, maka ditambahkan ...0

// ? parseInt dan parseFloat 
console.log(parseInt('123px')); // 123
console.log(parseFloat('12.3em')); // 12.3

// NOTE - Fungsi Math lainnya

// ? Angka Random
Math.random() // ? mengembalikan angka 0 hingga 1 (tidak termasuk 1)
Math.max(21, 34, 5, 43, 2) // ? Mengembalikan argumen terbesar , 43
Math.min(21, 34, 5, 43, 2) // ? Mengembalikan argumen terkecil , 2
Math.pow(2, 10) // ? 2 pangkat 10 = 1024

console.log(Math.max(21, 34, 5, 43, 2));