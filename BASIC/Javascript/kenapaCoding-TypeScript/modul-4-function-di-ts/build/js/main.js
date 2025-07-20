"use strict";
// ?======================== Function di TS
/**
 * *fungsi dalam ts bisa didefinisikan dengan tipe data pada parameter dan nilai kembali (return value), berikut contohnya
 * *
 * *->
 */
function greet(nama) {
    return "Hello " + nama;
}
console.log(greet("Aditya"));
// *Parameter Opsional
/**
 * *anda dapat mendefinisikan parameter oprional dengan menambahkan tanda tanya setelah nama parameter
 */
function greet2(nama, umur) {
    if (umur) {
        return `Halo nama saya ${nama}, umur saya ${umur} tahun`;
    }
    return `Halo nama saya ${nama}`;
}
console.log(greet2("Rizky"));
console.log(greet2("Aditya", 21));
// *Parameter Default
function greet3(nama = "Guest", umur) {
    if (umur) {
        return `Halo nama saya ${nama}, umur saya ${umur} tahun`;
    }
    return "Halo " + nama;
}
console.log(greet3());
console.log(greet3(undefined, 26));
// ?======================== Void dan Never
// *void, tipe return void digunakan ketika fungsi tidak mengembalikan nilai
function logMessage(mesage) {
    console.log(mesage);
}
// *Never, digunakan untuk fungsi yang tidak pernah kembali atau berakhir, seperti fungsi yang melempar error atau infinity loop
function throwError(message) {
    throw new Error(message);
}
// ?======================== Arrow Function
let multiply = (x, y) => x * y;
console.log("Multiply: ", multiply(2, 2));
function combine(a, b) {
    if (typeof a === "number" && typeof b === "number") {
        return a + b;
    }
    if (typeof a === "string" && typeof b === "string") {
        return a + b;
    }
}
console.log(combine(1, 2));
console.log(combine("halo ", "semua"));
// ?======================== Fungsi callback dengan Type Safety
/**
 * *callback adalah fungsi yang dilewatkan sebagai argumen ke fungsi lain dan dipanggil pada waktu tertentu, dengan ts, kita bisa
 * *-> menambahkan type safety pada callback untuk memastikan bahwa tipe data yang digunakan sesuai dengan yang diharapkan
 * *
 * *->
 */
/**
 * *dalam contoh berikut, ita memiliki fungsi processData yang menerima callback untuk memproses data:
 * *->
 */
function processData(data, callback) {
    data.forEach(callback);
}
processData([1, 2, 3, 4], (item) => {
    console.log(item * 2);
});
//* dengan menambahkan tipe data pada params callback, kita memastikan func callback menerima nilai bertipe number
