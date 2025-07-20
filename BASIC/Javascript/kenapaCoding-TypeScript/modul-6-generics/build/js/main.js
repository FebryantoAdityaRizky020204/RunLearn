"use strict";
// @======================== Generics
/**
 * *generics adalah fitur di ts yang memungkinkan kita membuat komponen yang berkerja dengan tipe data, sambil tetap menjaga
 * *-> tipe statis yang kuat, dengan generics, kita dapat menulis kode yang lebih fleksibel, dapat digunakan kembali, dan aman
 * *-> secara tipe, tanpa kehilangan informasi tipe
 * *->
 * *generics sering digunakan pada fungsi, class, dan interface untuk memastikan tipe tetap konsisten, bahkan ketika komponen
 * *-> dipakai untuk berbagai tipe data
 */
/**
 * $ mengapa menggunakan generics
 * * # konsistensi tipe: generics menjaga agar tipe tetap konsisten di seluruh aplikasi
 * * # kode fleksibel dan reusable: fungsi atau class dapat digunakan dengan tipe data yang berbeda tanpa mengorbankan
 * *   -> keamanan tipe.
 * * # memperkuat tipe statis: ts dapat memberikan lebih banyak bantuan tipe selama pengembangan dengan generics
 */
// @======================== Fungsi dengan GENERICS
/**
 *
 * * fungsi dengan generics memungkinkan kita untuk membuat fungsi yang bekerja dengan berbagai tipe data yang tetap aman
 * * -> secara tipe
 */
function identity(value) {
    return value;
}
// ?menggunakan fungsi dengan tipe return
let result1 = identity("Hello Typescript");
console.log(result1);
// ?menggunakan fungsi dengan tipe number
let result2 = identity(123);
console.log(result2);
/**
 * *pada contoh diatas, T adalah placeholder untuk tipe yang akan ditentukan saat fungsi dipanggil. ts akan menyimpulkan
 * *-> tipe berdasarkan argumen yang diberikan jika tidak ditentukan secara eksplisit.
 * *
 */
// @======================== GENERICS pada class
class Box {
    constructor(content) {
        this.content = content;
    }
    getContent() {
        return this.content;
    }
}
// $menggunakan box dengan tipe data number
let numberBox = new Box(123);
console.log(numberBox.getContent());
// $menggunakan box dengan tipe data string
let stringBox = new Box("halo");
console.log(stringBox.getContent());
let number = {
    first: 123,
    second: "Home"
};
// @======================== Batasan GENERICS (constraint)
/**
 * *kadang" kita ingin membatasi tipe yang dapat digunakan pada generics, kita bisa menggunakan constraintsuntuk mengatur
 * *-> batasan ada generics
 * *
 */
function logLength(item) {
    console.log(item.length);
}
// ?berfungsi dengan string (karena string memiliki properti length)
logLength("Halo");
// ?berfungsi dengan array (karena array memiliki properti length)
logLength([1, 2, 3]);
// !Tidak berfungsi dengan number (karena number tidak memiliki properti length)
// logLength(123) // ~Error
/**
 * *pada contoh diatas, digunakan T extends {length: number} untuk membatasi generics T hanya pada tipe yang
 * *-> memiliki properti length
 */
// @======================== GENERICS pada fungsi dengan tipe default
/**
 * *kita juga dapat memberikan tipe default ada generics, sehingga jika tipe tidak disediakan, ts akan menggunakan tipe tersebut
 * *->
 */
function createArray(length, value) {
    return Array(length).fill(value);
}
// $menggunakan tipe default string
let strings = createArray(3, "Hello");
console.log(strings); // ?output: ["Hello", "Hello", "Hello"]
// $menggunakan tipe number
let numbers = createArray(3, 12);
console.log(numbers); // ?output: [12, 12, 12]
// @======================== Kesimpulan
/**
 * *generics di ts adalah fitur yang sangat kuat yang memungkinkan pembuatan fungsi, class dan interface yang fleksibel, reusble
 * *->dan aman secara tipe. dengan menggunakan generics, kita dapat menulis kode yang lebih modular dan mencegah kesalahan tipe
 * *->yang tidak diinginkan, tanpa menghilangkan fleksibilitas yang ditawarkan javascript.
 * *
 * $Konsep utama dalam generics meliputi
 * *# Fungsi Generic
 * *# Class Generic
 * *# Interface Generic
 * *# Constraints
 * *# Tipe Default pada generic
 * *->
 * *generic adalah fitur yang esensial untuk pengembangan aplikasi besar dan kompleks dalam ts karena membantu menjaga tipe
 * *->yang konsisten di seluruh sistem aplikasi
 */
// @========================
// @========================
