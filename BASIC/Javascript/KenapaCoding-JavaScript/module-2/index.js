// ? ========================= Operator Ternary
// condition ? expressionIfTrue : expressionIfFalse
let age = 21
let canVote = (age >= 17 ? "Yes" : "No")
console.log(canVote);

// ? ========================= String
let str1 = "      Javascript itu !mudah"
console.log(str1[0]); // J
console.log(str1.length); // mengetahui panjang string
console.log(str1.toLowerCase()); // menjadikan all huruf kecil
console.log(str1.toUpperCase()); // menjadikan all huruf besar
let trimmed = str1.trim() // menghapus spasi berlebih diawal dan diakhir
console.log(trimmed); 

// concat, menggabungkan string
let firstName = "Aditya"
let lastName = "Rizky"

let fullName1 = firstName + " " + lastName
let fullName2 = `${firstName} ${lastName}`

console.log("fullname1: ", fullName1);
console.log("fullname2: ", fullName2);

// [slice, substring], mengambil string berdasarkan indeks
let partTrimmed1 = trimmed.slice(0,4);
let partTrimmed2 = trimmed.substring(4,10);
console.log("partTrimmed1: ", partTrimmed1);
console.log("partTrimmed2: ", partTrimmed2);


// Replace, mengganti bagian string dengan string baru
let str2 = "Hello World!"
let newStr = str2.replace("World!", "Dunia!!")
console.log("newStr: ", newStr);

// split, membagi string menjadi array, dengan delimiter tertentu
console.log("Halo Semua".split(" "));
console.log("Halo Semua Apa Kabar".split(" ", 3)); // ["Halo", "Semua", "Apa"]
// join, menggabungkan semua elemen array menjadi sebuah string
console.log(["Halo", "Semua"].join(" "));

// indexOf(), mengembalikan indeks dari kemunculan pertama substring dalam string, atau -1 jika tidak ditemukan
let sentence1 = "Ada udang di balik batu udang"
console.log("indexOf(udang): ", sentence1.indexOf("udang")); // 4 kemunculan pertama

// lastIndexOf(), mengembalikan indeks dari kemunculan terakhir substring dalam string, atau -1 jika tidak ditemukan
console.log("lastIndexOf(udang)", sentence1.lastIndexOf("udang")); // 24 kemunculan terakhir

// includes(), mengembalikan true jika string mengandung substring yang dicari
console.log("includes(udang): ", sentence1.includes("udang"));

let challange = "javascript"
stringResultChalange = challange[0].toUpperCase() + challange.slice(1)
console.log("Result Chalange: ", stringResultChalange);

// ? ========================= NUMBERS
let bilanganBulat = 26
let bilanganPecahan = 27.5
let bilanganNegatif = -26

let infinityValue = Infinity // -infinity
let NotANumber = NaN

// * JS menyediakan beberapa properti pada objek number  yang berguna
console.log(Number.MIN_VALUE);
console.log(Number.MAX_VALUE);
console.log(Number.NEGATIVE_INFINITY);
console.log(Number.POSITIVE_INFINITY);
console.log("NaN: ", "abc"/2);

// * Metode bawaan Number
/**
 * ? .toString(), mengubah menjadi string
 * ? .toFixed(digits), mengubah angka menjadi string dengan jumlah digit desimal yang ditentukan
 * ? .toPrecision(digits), mengubah angka menjadi string dengan panjang total yang ditentukan
 * ? parseInt() dan parseFloat(), mengubah string menjadi angka integer atau float
 */



// =========================