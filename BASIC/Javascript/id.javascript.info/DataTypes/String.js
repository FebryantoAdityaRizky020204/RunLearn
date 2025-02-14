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

// NOTE - String Length

let stringg = 'Ini adalah string'
stringg.length // ? mengembalikan panjang/jumlah karakter string

// NOTE - Mengakses karakter di dalam string
console.log('====================================');

/**
 * ? untuk mengakses di posisi tertentu bisa menggunakan string[n]
 * ? atau dengan method string.charAt(n), karakter dimulai dari 0
 */

console.log(stringg[2]); // i
console.log(stringg.charAt(2)); // i

/**
 * * karakter string ke-n tidak bisa diubah
 * ? stringg[0] = 'H', akan menyebabkan error
 */


// NOTE - mengganti case
console.log('====================================');
console.log(stringg.toLowerCase()) // ? mengubah string menjadi huruf kecil
console.log(stringg.toUpperCase()) // ? mengubah string menjadi huruf besar

// NOTE - Mencari substring
console.log('====================================');

/**
 * ? Cara yang pertama yaitu str.indexOf(substr, pos).
 * * Method ini mencari substr di dalam str, mulai dari posisi pos yang diberikan, 
 * * -> dan mengembalikan posisi dimana substring ditemukan atau -1 jika tidak ditemukan.
 * 
 * ? Ada juga method yang hampir sama str.lastIndexOf(substr, position) 
 * * yang mencari dari akhir sebuah string sampai ke awalnya.
 * 
 * * lebih lengkap di [https://id.javascript.info/string#mencari-substring]
 */

let teks = 'Halo semua'
let pos = teks.indexOf('semua') // ? mengembalikan posisi dimana substring ditemukan
console.log(pos); // ? 5


/**
 * ? includes, startsWith, endsWith
 * 
 * * sudah bisa dipahami dari nama methodnya
 */

console.log(teks.includes('semua')); // ? true
console.log(teks.startsWith('Halos')); // ? false
console.log(teks.endsWith('semua')); // ? true

// NOTE - mengambil substring
console.log('====================================');
/**
 * ? Ada 3 cara untuk mengambil sebuah substring di Javascript: substring, substr dan slice.
 * * slice(start, end), dari start sampai end (tidak termasuk end)
 * * substring(start, end), antara start dan end
 * * substr(start, length), dari start ambil length karakter
 */

let teks2 = 'Halo semua'
console.log(teks2.slice(3, 5)); // ? o
console.log(teks2.substring(1, 5)); // ? alo
console.log(teks2.substr(1, 5)); // ? alo s

// NOTE - Membandingkan String
console.log('====================================');
// ? Saya pun bingung, baca disini [https://id.javascript.info/string#membandingkan-string]
/**
 * * Semua string menggunakan encoding UTF-16. Yaitu: setiap karakter memiliki masing-masing 
 * * -> kode numerik. Ada method spesial yang memperbolehkan kita untuk mengambil karakter dari 
 * * -> kode dan sebaliknya.
 */

// ? Method str.codePointAt(pos), Mengembalikan kode untuk karakter pada posisi n:
console.log("z".codePointAt(0)); // ? 122
console.log("Z".codePointAt(0)); // ? 90

// ? Method String.fromCodePoint(code), Membuat sebuah karakter berdasarkan code numeriknya
console.log(String.fromCodePoint(90)); // ? Z
console.log(String.fromCodePoint(122)); // ? z

/**
 * ? Kita juga dapat membuat karakter unicode dengan kode mereka menggunakan \u 
 * ? -> yang diikuti oleh kode heksadesimal:
 */
console.log('\u005a'); // ? Z


// ? Cara membandingkan string yang benar
/**
 * * Method str.localeCompare(str2) mengembalikan sebuah interger yang menandakan apakah str
 * * -> lebih kecil, sama dengan atau lebih besar dari str2 menurut peraturan-peraturan bahasa:
 * * [1] Mengembalikan nilai negatif jika str lebih kecil dibandingkan str2
 * * [2] Mengembalikan nilai positif jika str lebih besar dibandingkan str2
 * * [3] Mengembalikan 0 apabila mereka sama.
 */
console.log("A".localeCompare("B")); // ? -1  
console.log("B".localeCompare("A")); // ? 1

// ? Masih ada beberapa topik aneh, [https://id.javascript.info/string#bagian-internal-dari-unicode]