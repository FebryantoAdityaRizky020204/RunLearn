// ? MAP dan SET

/**
 * ? Sekarang kita telah membelajari struktur data compleks berikut:
 * * == Objek untuk menyimpan koleksi kunci.
 * * == Array untuk menyimpan koleksi berurut.
 */

// TODO - MAP

/**
 * ? Map adalah kumpulan item data yang berkunci, seperti Object. Tetapi perbedaan utama 
 * ? -> adalah Map membolehkan kunci jenis apa pun.
 * 
 * ?Metode dan properti:
 * * new Map() – menciptakan map.
 * * map.set(key, value) – menyimpan nilai dengan kunci.
 * * map.get(key) – mengembalikan nilai dengan kunci, undefined jikakey tidak ada di map.
 * * map.has(key) – mengembalikan true jikakey ada, false sebaliknya.
 * * map.delete(key) – menghapus nilai dengan kunci.
 * * map.clear() – menghapus semua isi dari map.
 * * map.size – mengembalikan jumlah elemen saat ini.
 */

let map = new Map()
map.set('name', 'Aditya')
map.set(1, 1)
map.set('1', 'satu')
map.set('bool', true)

// ? map menyimpan berdasarkan key yang diberikan, 1 != '1'
console.log(map.get(1));
console.log(map.get('1'));
console.log('====================================');

/**
 * ? Menggunakan objek sebagai kunci adalah salah satu fitur Map yang paling terkenal dan penting. 
 * ? -> Untuk kunci string, Object bisa dipakai, tetapi tidak untuk kunci objek.
 */

let ben = { nama: 'Ben' }
let john = { nama: 'John' }

let visit = {}

visit[ben] = 1
visit[john] = 2

console.log(visit[john]); // ? 2
console.log(visit[ben]); // ? 2
console.log(visit["[object Object]"]); // 2
/**
 * ? Karena visitsCountObj adalah sebuah objek, ia mengubah semua kunci, seperti john menjadi string, 
 * ? -> jadi kita mendapatkan kunci string "[object Object]". Jelas bukan yang kita inginkan.
 */

// ? berbeda dengan MAP, yang bisa menggunakan object sebagai keynya
let visitMap = new Map()

visitMap.set(ben, 1)
visitMap.set(john, 2)

console.log(visitMap.get(john)); // ? 2
console.log(visitMap.get(ben)); // ? 1

/**
 * ? Chaining
 * ? Setiap panggilan map.set mengembalikan map itu sendiri, sehingga kami dapat “mem-chain” 
 * ? -> panggilan-panggilan:
 * 
 * * map.set('1', 'str1')
 * *  .set(1, 'num1')
 * *  .set(true, 'bool1');
 */

console.log('====================================');



// NOTE - Iterasi dengan map
/**
 * ? Untuk looping atas map, ada 3 method:
 * * map.keys() – mengembalikan iterable untuk kunci,
 * * map.values() – mengembalikan iterable untuk nilai,
 * * map.entries() – mengembalikan iterable untuk entri [key, value], 
 * * -> ini digunakan dengan standar di for..of.
 */

let resepUsingMap = new Map([
    ['ayam', '1kg'],
    ['telur', '2butir'],
    ['santan', '1/2liter']
]);

// ? iterasi dengan keys()
for (let bahan of resepUsingMap.keys()) { 
    console.log(bahan); // ? ayam, telur, santan
}
console.log('------------------------------------');

// ? iterasi dengan values()
for (let bahan of resepUsingMap.values()) { 
    console.log(bahan); // ? 1kg, 2butir, 1/2liter
}
console.log('------------------------------------');

// ? iterasi dengan entries()
for (let entry of resepUsingMap.entries()) {  // ? bisa juga (let [key, value] of resepUsingMap) sama saja
    console.log(entry); // ? ['ayam', '1kg'], ['telur', '2butir'], ['santan', '1/2liter']
}

// ? Map juga bisa menggunakan forEach
resepUsingMap.forEach((value, key) => {
    console.log(key, value); // ? ayam, 1kg, telur, 2butir, santan, 1/2liter
})

console.log('====================================');

// NOTE - Object.entries() dan objectFromEntries()

/**
 * ? Object.entries() 
 * 
 * ? -> Jika kita memiliki objek biasa, dan kita mau menciptakan sebuah Map darinya, kita bisa menggunakan 
 * ? -> method built-in Object.entries(obj) yang mengembalikan array daripada pasangan-pasangan kunci/nilai untuk satu 
 * ? -> objek yang berformat persis sama.
 */

let obj = {
    nama: 'Aditya',
    umur: 20
}

let mapFromObject = new Map(Object.entries(obj))
console.log(mapFromObject); // ? Map { 'nama' => 'Aditya', 'umur' => 20 }
console.log(mapFromObject.get('nama')); // ? Aditya
console.log(mapFromObject.get('umur')); // ? 20
console.log('------------------------------------');

/**
 * ? diatas adalah cara menciptakan Map dari objek biasa dengan Object.entries(obj).
 * ? Ada juga method Object.fromEntries yang melakukan kebalikkannya: 
 * ? jika diberi array berisi pasangan [kunci, nilai], ia menciptakan objek darinya:
 */
let harga = Object.fromEntries([
    ['ayam', 10000],
    ['telur', 5000],
    ['santan', 2000]
])

// ? sekarang, harga = {ayam: 10000, telur: 5000, santan: 2000}

/**
 * ? Kita bisa menggunakan Object.fromEntries untuk mendapatkan objek polos dari Map.
 * 
 * ? Contoh: Kita menyimpan data di dalam Map, tapi kita perlu mengirimnya ke kode pihak 
 * ? -> ketiga yang mengharapkan objek biasa.
 */
let mapDefault = new Map([
    ['nama', 'Aditya'],
    ['umur', 20]
]);

let objDefault = Object.fromEntries(mapDefault); // ? sekarang map menjadi object
// ? objDefault = { nama: 'Aditya', umur: 20 }


console.log('====================================');


// TODO - SET

/**
 * ? Set adalah tipe koleksi spesial – “set nilai-nilai” (tanpa kunci), dimana setiap nilai hanya 
 * ? -> dapat terjadi sekali.
 * 
 * ? Method utamanya adalah:
 * * new Set(iterable) – menciptakan set, dan jika objek iterable disediakan (biasanya array), 
 * * -> menyalin nilai darinya ke set.
 * * set.add(value) – menambahkan nilai, mengembalikan set itu sendiri.
 * * set.delete(value) – menghapus nilai, mengembalikan true jika value ada pada saat panggilan 
 * * -> berlangsung, jika tidak false.
 * * set.has(value) – mengembalikan true jika nilai ada di set, jika tidak false.
 * * set.clear() – menghapus semuanya dari set.
 * * set.size – adalah hitungan elemen.
 * 
 * ? Fitur utamanya adalah panggilan berulang set.add(value) dengan nilai yang sama tidak melakukan 
 * ? -> apa-apa. Itulah alasan mengapa setiap nilai hanya muncul dalam Set sekali.
 */

let set = new Set()
let johnS = { nama: 'John' }
let benS = { nama: 'Ben' }

set.add(johnS)
set.add(benS)
set.add(johnS)

console.log(set); // ? Set { { nama: 'John' }, { nama: 'Ben' } }
console.log(set.size); // ? 2

// ? Iterasi pada SET
// * bisa menggunakan for...of dan forEach

let setArr = new Set([1, 2, 3, 4, 5])

for (let angka of setArr) {
    console.log(angka); // ? 1, 2, 3, 4, 5
}
console.log('------------------------------------');
setArr.forEach((angka) => {
    console.log(angka); // ? 1, 2, 3, 4, 5
})

/**
 *  ? set memiliki Metode yang sama yang dimiliki Map untuk iterator juga didukung: 
 * * set.keys() – mengembalikan objek iterable untuk nilai,
 * * set.values() – sama dengan set.keys(), untuk kompatibilitas dengan Map,
 * * set.entries() – mengembalikan objek iterable untuk entri [nilai, nilai], ada untuk kompatibilitas dengan Map.set
 */

console.log('====================================');