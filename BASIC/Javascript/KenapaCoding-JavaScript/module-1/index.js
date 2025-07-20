// =================== Variabel
/**
 * var, bisa diakses diluar scope dan nilainya bisa diubah
 * let, tidak bisa diakses diluar scope, hanya idalam scope, dan nilainya bisa diubah
 * const, tidak bisa diakses diluar scope, dan nilainya tidak bisa diubah
 */

// =================== Tipe data di JavaScript
// Tipe Data Primitif
// String, Number, Boolean, Undefined, Null, Symbol (ES6+), BigInt

// String
let nama = "Aditya"
let namaLengkap = `${nama} Rizky Febryanto`

// Number
const umur = 21

// Boolean
const isMarried = false

// Undefined, variabel yang belum didefinisikan
let x; // x bernilai undefined

// Null
let n = null // typeof akan me-return object, tapi sebenarnya itu adalah tipe data primitif null, cari di google

// Symbol
const symbol1 =Symbol("description 1")

// BigInt
const bigInt1 = 27758474837383827272n

// Tipe Data Reference
// Object, Array, Function

// Object
const orang = {
    nama: 'Aditya Rizky Febryanto',
    umur: 21,
    negara: "Indonesia",
}

// Array
const hobi = ["Makan", "Baca Novel", "Renang", "Tidur"]

// Function
function sayHello(){
    return "Halo Kamu yang ada disana"
}


const output = bigInt1
console.log(output, typeof output)

// Perbedaan Tipe data primitif dan Tipe data Reference
/**
 * Penyimpanan:tipe data primitf disimpan di stack memory dengan nilai langsungnya, sedangkan reference type
 *      disimpan di heap memori dan variabelharus menyimpan referensike data tersebut
 */

// Primitif Data types
let a = 10
let b = a
a = 20
console.log(b) // bernilai 20

// Reference Data Types
let obj1 = {nama:"Aditya"}
let obj2 = obj1
obj1.nama = "Rizky"
console.log(obj2.nama) // ini akan menampilkan Rizky

// =================== Data Type Conversion
// Implicit Conversion, dilakukan notomatis oleh javascript
let result1 = "5" + 10 // menjadi 510, 10 akan diubah menjadi string
let result2 = "5" - 10 // menjadi -5, 5 akan diubah menjadi number, semua operasi numerik keculai "+" akan diubah menjadi number

// Explicit Conversion, dilakukan oleh programmer menggunakan fungsiatau metode tertentu
let num1 = 100
let numToString = String(num1) // tipe datanya akan menjadi String
let numToString2 = num1.toString() // tipe datanya akan menjadi String

let string2 = "100"
let string3 = "100.55"
let num2 = parseInt(string2)
let num3 = parseFloat(string3)

// ===================
// ===================
// ===================
// ===================
// ===================
// ===================