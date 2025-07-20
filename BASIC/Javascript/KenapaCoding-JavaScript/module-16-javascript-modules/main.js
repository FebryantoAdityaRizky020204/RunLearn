// ?==================== Javascript Modules
// *js modules adalah fitur yang memungkinkan kita untuk membagi kode js kedalam file terpisah, ini membuat kode lebih terstruktur,
// *-> lebih mudah untuk dipelihara, dan meningkatkan keterbacaan. dengan modules, anda dapat mengelompokkan fungsionalitas
// *-> tertentu dalam file yang terpisah, dan kemudian mengimpor file tersebut sesuai kebutuhan.

/**
 * *Mengapa menggunakan modules
 * * - pemeliharaan yang lbeih mudah
 * * - penggunaan ulang kode
 * * - meningkatkan kejelasan
 */

/**
 * *Tipe module JavaScript
 * * - ES Modules (ECMAScript Modules): menggunakan sintaks import dan export, ini adalah standar dari ECMAScript
 * *- CommonJS Modules: module yang biasanya digunakan dalam lingkungan NodeJS, menggunakan require dan module.exports
 */

// ?==================== ES Modules
// *anda dapat enggunakan export untuk mengekspor fungsi , variabel, atau objek dari suatu file, yang kemudian dapat diimpor oleh
// *-> file lain. setelah anda mengekspor, anda dapat mengimpor nilai tersebut ke file lain

// *Export Named (Ekspor Bernama)
export const add = (a, b) => a + b;
export const substract = (a, b) => a - b;

// *Export Default
export default function greet(name) {
    console.log(`Hello ${name}`);
}

// *Import Named
import { add, substract } from "./main";
console.log(add(1, 2));
console.log(substract(3, 3));

// *Import Default
import greet from "./main";
greet("John Doe");

// ?==================== CommonJS Modules
// *CommonJS adalah sistem modul yang digunakan di NodeJS, ini menggunakan require untuk mengimport dan module.exports untuk mengekspor
// *->

// *Export
const addC = (a, b) => a + b;
const substractC = (a, b) => a - b;
module.exports = { addC, substractC };

// *Import
const { addC, substractC } = require("./main");
console.log(addC(2, 3));
console.log(substractC(3, 2));

// ?==================== Dynamic Import
// *dengan dynamic import, anda dapat mengimpor modul hanya ketika dibutuhkan saja, yang dapat meningkatkan kinerja aplikasi
document.getElementById("load").addEventListener("click", async () => {
    const module = await import("./main.js");
    console.log(module.add(4, 5));
});
