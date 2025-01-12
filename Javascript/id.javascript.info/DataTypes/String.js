// NOTE - String

/**
 * * Di Javascript, data teks disimpan sebagai string. Tidak ada tipe data sendiri 
 * * -> untuk satu buah karakter.
 * 
 * * UTF-16 selalu digunakan sebagai format internal string, hal tersebut tidak terikat dengan 
 * * ->jenis encoding yang digunakan oleh halaman.
 */

let singleQuoted = 'Halo Semua';
let doubleQuoted = "Halo lagi semua"
let backticks = `Pesan ${singleQuoted}`

/** 
 * ? Kelebihan backtick yang lain yaitu backtick memperbolehkan sebuah string untuk terdiri 
 * ? -> lebih dari satu baris:
*/

let nama = `nama:
* Aditya
* Rizky
* Febryanto`
console.log(nama);

console.log('====================================');
// NOTE - Karakter Spesial

/**
 * ? Beberapa karakter spesial yaitu
 * * \n, untuk baris baru
 * * \t, untuk tab
 * * dll, bisa dilihat di [https://id.javascript.info/string#karakter-spesial]
 */

let nama2 = "nama: \n * Aditya \n * Rizky \n * Febryanto"
console.log(nama2);

