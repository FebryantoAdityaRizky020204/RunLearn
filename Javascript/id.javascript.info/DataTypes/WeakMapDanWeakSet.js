// TODO WeakMap dan WeakSet [https://id.javascript.info/weakmap-weakset]

/**
 * ? WeakMap
 * ? Perbedaan pertama dari Map adalah kunci WeakMap haruslah objek, bukan nilai primitif:
 */
let weakMap = new WeakMap()
let obj = {}
weakMap.set(obj, 'Aditya')
// weakMap.set('nama', 'Aditya') // ? error tidak bisa menggunakan string, harus objek

console.log(weakMap.get(obj));

/**
 * ? Sekarang, jika kita menggunakan sebuah objek sebagai kunci didalamnya, dan disana tidak t
 * ? -> terdapat referensi lain ke objeknya – itu akan dihilangkan dari memori 
 * ? -> (dan juga dari map) secara otomatis.
 */
let john = { nama: 'John' }
weakMap.set(john, 'John')
john = null;
// ? weakMap.set(john, 'John'), akan dihilangkan dari memori

/**
 * ? itulah perbedaan Map dengan WeakMap, di Map, data dengan key 'John' tersebut tidak akan dihapus
 * 
 * ? Bandingkan itu dengan Map biasa dicontoh diatas. Sekarang jika john hanya ada jika sebagai kunci dari WeakMap – 
 * ? -> itu akan secara otomatis dihapus dari map (dan memori).
 * 
 * ? WeakMap tidak mendukung iterasi dan metode keys(), nilai(), entries(), jadi tidak ada cara untuk mendapatkan 
 * ? -> semua kunci atau nilai darinya.
 * 
 * * WeakMap hanya mempunyai metode berikut:
 * * weakMap.get(key)
 * * weakMap.set(key, value)
 * * weakMap.delete(key)
 * * weakMap.has(key)
 * 
 * TODO - other
 * ? baca beberapa kasus disini
 * * [https://id.javascript.info/weakmap-weakset#kasus-tambahan-data]
 * * [https://id.javascript.info/weakmap-weakset#kasus-penyimpanan-cache]
 */

console.log('====================================');

// ? WeakSet

/**
 * ? WeakSet memiliki perilaku yang sama:
 * ? Analoginya adalah untuk meng-Set, tapi mungkin kita hanya butuh menambahkan objek kedalam WeakSet (bukan primitif).
* ? Sebuah objek ada didalam set selama itu bisa dijangkau dari tempat lain.

 * ? Seperti Set, itu mendukung add, has dan delete, tapi tidak size, keys() dan tidak ada iterasi
 * ? menjadi “weak”, itu juga menyediakan penyimpanan tambahan. Tapi tidak untuk data yang asal-asalan, 
 * ? -> tapi untuk “yes/no”. Keanggotaan dari WeakSet mungkin berarti sesuatu tentang objeknya.
 */
let visitedSet = new WeakSet();

let john2 = { name: "John" };
let pete = { name: "Pete" };
let mary = { name: "Mary" };

visitedSet.add(john2); // John mengunjungi website
visitedSet.add(pete); // lalu Pete
visitedSet.add(john2); // John lagi

// visitedSet sekarang memiliki 2 user

// periksa jika John telah berkunjung?
console.log(visitedSet.has(john2)); // true

// periksa jika Mary telah berkunjung?
console.log(visitedSet.has(mary)); // false

john = null;

// visitedSet akan dibersihkan secara otomatis

