// TODO - Objects, Keys, Values, Entries

/**
 * ? Mari kita berpaling dari struktur data individual dan membahas iterasi mereka.
 * ? Di bab sebelumnya kita telah melihat method map.keys(), map.values(), map.entries().
 * 
 * ? Method ini generik, ada persetujuan umum untuk menggunakan mereka untuk struktur data. Jika kita pernah 
 * ? menciptakan struktur data sendiri, kita harus mengimplementasikannya juga.
 * 
 * * Mereka tersedia untuk:
 * * [1] Map
 * * [2]  Set
 * * [3]  Array
 * * Objek biasa juga menghadapi method yang mirip, tapi sintaksisnya sedikit berbeda.
 */

/**
 * ? Objek.kunci, nilai-nilai, entri-entri
 * ? Untuk objek biasa, method berikut tersedia:
 * * Object.keys(obj) – mengembalikan array kunci.
 * * Object.values(obj) – mengembalikan array nilai.
 * * Object.entries(obj) – mengembalikan array pasangan [key, value].
 */

let user = {
    nama: 'John',
    umur: 30
}

Object.keys(user); // ? ['nama', 'umur']
Object.values(user); // ? ['John', 30]
Object.entries(user); // ? [['nama', 'John'], ['umur', 30]]

console.log(Object.keys(user));
// loop atas nilai
for (let value of Object.values(user)) {
  console.log(value); // John, 30
}

console.log('====================================');

// ? Mengubah Objek
/**
 * ? Objek kekurangan banyak method yang ada untuk arrays, contoh map, filter dan yang lainnya.
 * 
 * ? Jika kita ingin mengapplikasikan method-method tersebut, kita bisa menggunakan Object.entries 
 * ? -> diikuti oleh Object.fromEntries:
 * 
 * * Gunakan Object.entries(obj) untuk mendapatkan array pasangan kunci/nilai dari obj.
 * * Gunakan method array di array tersebut, contoh map.
 * * Gunakan Object.fromEntries(array) di array hasil untuk mengubahnya kembali menjadi objek.
 */

let prices = {
    pisang: 1,
    nanas: 3,
    daging: 5
}

let doublePrices = Object.fromEntries(
    Object.entries(prices).map(([key, value]) => [key, value * 2])
);

console.log(prices);
console.log(doublePrices);