// ? ========================= Math Object
// -> properti bawaan javascript berisi berbagai properti dan metode  untuk melakukan operasi matematika

console.log(Math.PI); // mengembalikan nilai Phi (3.14159)
console.log(Math.E); // mengembalikan nilai konstanta Euler (2.718)

// Metode Math
console.log(Math.abs(-7)); // meng-absolutkan number, menjadi 7
console.log(Math.pow(2,5)); // digunakan untuk memangkatkan 2^5
console.log(Math.sqrt(16)); // akar 2, 4
console.log(Math.cbrt(27)); // akar 3, 3
console.log(Math.max([1,4,5,32,4,0,54])); // mencari nilai minimum
console.log(Math.min([1,4,5,32,4,0,54])); // mencari nilai maksimum

// Pembulatan Angka
console.log(Math.round(2.3)); // pembulatan terdekat menjadi 2, jika (2.5 menjadi 3)
console.log(Math.ceil(4.1)); // dibulatkan keatas menjadi 5
console.log(Math.floor(3.9)); // dibulatkan kebawah menjadi 3
console.log(Math.trunc(4.9)); // menghapus semua bialangan desimalnya (atau bialangan komanya)

// Random Number
console.log(Math.random()); // angka random antara 0-1
console.log(Math.random() * 100); // angka random antara 0.0-100.0
console.log(Math.round(Math.random() * 100)); // angka random antara 0-100

// ? ========================= Date Object
// * data object bekerja dengan tanggal dan waktu, objek ini memungkinkan kita untuk mendapatkan, mengatur, dan memanipulasi tanggal dan waktu

// Tanggal dan Waktu Saat ini
let now = new Date()
console.log(now); // Fri Jun 20 2025 19:26:31 GMT+0700 (Western Indonesia Time)

// CUSTOM DATE
// dengan string
let specificDateWithString = new Date("August 20, 2024 10:30:00")
console.log(specificDateWithString);

// dengan params num (tahun,bulan,hari,jam,menit,detik,milidetik)
let specificDateWithSomeParams = new Date(2024,7,20,10,30)
console.log(specificDateWithSomeParams);

// mengambil informasi tanggal dan waktu
console.log(now.getFullYear());
console.log(now.getMonth()) // bulan dimulai dari 0
// getDate, getDay, getHours, getMinutes, getSeconds, getMiliSeconds, getTime, 


// juga bisa mengatur date
let date = new Date()
date.setFullYear(2025)
// sama seperti diatas, ubah saja get menjadi set


// ? ========================= 
// ? ========================= 
// ? ========================= 
// ? ========================= 