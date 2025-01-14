// NOTE - MEthod PAda Array

/**
 * ? Menambah/Menghapus Item
 * 
 * ? Kita sudah tahu metode-metode yang menambahkan dan menghapus 
 * ? -> item dari bagian awal atau akhir array:
 * * arr.push(...items) – menambahkan item ke bagian akhir,
 * * arr.pop() – mengekstrak sebuah item dari bagian akhir,
 * * arr.shift() – mengekstrak sebuah item dari bagian awal,
 * * arr.unshift(...items) – menambahkan item ke bagian awal.
 */

// ? Beberapa Method Lain

/**
 * TODO - Splice
 * * Metode arr.splice(start) adalahs sebuah fungsi serbaguna untuk array. 
 * * -> Splice bisa melakukan banyak hal: memasukkan, menghilangkan serta mengganti elemen.
 * 
 * ? Syntax
 * * arr.splice(start[, deleteCount, elem1, ..., elemN])
 */

let arr1 = ['Aditya', 'Rizky', 'Febryanto']
arr1.splice(1, 1) // * dari index 1 hapus 1 elemen
console.log(arr1);// * ['Aditya', 'Febryanto']

arr1.splice(0, 1, 'AnotherAditya')
// ? dari index 0 hapus 1 elemen, dan menggantinya dengan 'AnotherAditya'
console.log(arr1); // * ['AnotherAditya', 'Febryanto']

// ? kita juga bisa menangkap elemen yang dihapus
let removed = arr1.splice(1, 1, 'Rizky', 'Febryanto')
// * dari index 1 hapus 1 elemen, dan tambahkan array 'Rizky' dan 'Febryanto'
console.log(removed); // * ['Febryanto']
console.log(arr1); // * ['AnotherAditya', 'Rizky', 'Febryanto']

// ? kita juga bisa menyisipkan array menggunakan splice
arr1.splice(1, 0, 'sisipkan1', 'sisipkan2')
// * dari index 1 hapus 0 elemen, kemudian tambahkan array sisipkan1 dan sisipkan2
console.log(arr1); // * ['AnotherAditya', 'sisipkan1', 'sisipkan2', 'Rizky', 'Febryanto']

// TODO - Slice
console.log('====================================');

/**
 * ? mirip splice, ini lebih sederhana, sintaksnya
 * ? arr.slice([start], [end])
 * 
 * * Metode ini mengembalikan sebuah sebuah array baru hasil salinan semua item yang ada dari 
 * * -> indeks start hingga end (indeks end tidak termasuk). Baik start maupun end bisa saja negatif, 
 * * -> dalam kasus tersebut posisi dari bagian akhir array sudah diasumsikan/diperkirakan.
 * 
 * * Mirip dengan metode string str.slice, namun membuat subarray bukan substring.
 */

let arr2 = ['Aditya', 'Rizky', 'Febryanto']
let arr3 = arr2.slice(1, 3) // ? membuat array baru dengan mengambil dari arr2 dari index 1 hingga 3
console.log(arr3); // * ['Rizky', 'Febryanto']

let arr4 = arr2.slice(1) // ? membuat array baru dengan mengambil dari arr2 dari index 1 hingga akhir
console.log(arr4); // * ['Rizky', 'Febryanto']

let arr5 = arr2.slice() // ? menyalin semua array
console.log(arr5); // * ['Aditya', 'Rizky', 'Febryanto']

// TODO - concat
console.log('====================================');
/**
 * * Metode arr.concat membuat sebuah array baru yang sudah termasuk nilai-nilai dari array 
 * * -> lainnya serta item-item tambahan.
 * 
 * * Sintaksnya sebagai berikut:
 * * arr.concat(arg1, arg2...)
 */
let arr6 = [1, 2];

// ? membuat sebuah array dari: arr6 dan [3,4]
console.log( arr6.concat([3, 4]) ); // * [1,2,3,4]

// ? membuat sebuah array dari: arr6 dan [3,4] dan [5,6]
console.log( arr6.concat([3, 4], [5, 6]) ); // * [1,2,3,4,5,6]

// ? membuat sebuah array dari: arr6 dan [3,4], lalu menambahkan nilai 5 dan 6
console.log(arr6.concat([3, 4], 5, 6)); // * [1,2,3,4,5,6]

console.log(arr6); // ? [1,2], arr6 tidak terpengaruh

// ? ada beberapa topik yang membingungkan baca sendiri di
// * [https://id.javascript.info/array-methods#menambahkan-menghapus-item]

// TODO - iterasi:forEach

/** 
 * ? Metode arr.forEach membuat kita dapat menjalankan sebuah fungsi untuk setiap elemen yang ada 
 * ? -> di dalam array.
 * */

let arr7 = ['Aditya', 'Rizky', 'Febryanto']
arr7.forEach((item) => console.log(item))
console.log(['Halo', 'Semua'].forEach((item) => console.log(item)));

// TODO - Mencari di dalam array
console.log('====================================');

// ? indexOf, lastIndexOf, includes

/**
 * * Metode arr.indexOf, arr.lastIndexOf dan arr.includes memiliki sintaks yang sama dan pada dasarnya keduanya 
 * * -> melakukan fungsi yang samahave the same syntax, namun untuk mengoperasikannya perlu ditujukan item bukan karakter:
 * 
 * * [1] arr.indexOf(item, from) – mencari item dimulai dari indeks from, dan mengembalikan indeks dimana item yang dicari itu
 * * -> ditemukan jika tidak akan mengembalikan -1.
 * * [2] arr.lastIndexOf(item, from) – serupa, namun mencari dari kiri ke kanan.
 * * [3] arr.includes(item, from) – mencari item dimulai dari indeks from, mengembalkikan true jika yang dicari itu ditemukan.
 */

let arr8 = [1, 2, 3, 0, true, false]
console.log(arr8.indexOf(0)); // * 3
console.log(arr8.lastIndexOf(1)); // * 0
console.log(arr8.includes(2)); // * true

console.log('====================================');
// ? find dan findIndex

/**
 * * Bayangkan kita memiliki sebuah array berisi objek. Bagaimana cata kita menemukan sebuah objek dengan kondisi tertentu?
 * 
 */
{
    let result = ['Halo', 'Semua'].find(function(item, index, array) {
      // jika true dikembalikan, item dikembalikan dan pengulangan dihentinkan
        // untuk skenario palsu akan mengembalikan undefined
        
        /**
         * ? Fungsi tersebut dipanggil untuk elemen-elemen dalam array, satu sama lainnya:
         * * item adalah elemen.
         * * index adalah indeks elemen tersebut.
         * * array adalah array itu sendiri.
         * 
         * ? Jika fungsi tersebut mengembalikan true, pencarian dihentikan, lalu item akan dikembalikan. 
         * ? -> Jika tidak ditemukan apa-apa, undefined yang dikembalikan.
         */
    });
}

let users = [
    { nama: 'John' },
    { nama: 'Aditya' },
    {nama: 'Rizky'}
]

let user = users.find(user => user.nama === 'Aditya')
console.log(user); 

// ? findIndex mirip, tetapi akan mengembalikan index dari elemen yang dicari

console.log('====================================');
// ? filter

/**
 * * Metode find mencari sebuah elemen tunggal (pertama) yang akan membuat fungsi tersebut mengembalikan true.
 * * Jika ada banyak elemen demikian, kita bisa menggunakanarr.filter(fn).
 * * Sintaksnya mirip dengan find, tetapi filter mengembalikan array yang berisi elemen-elemen yang cocok:
 */

{
    let results = ["halo", "semua"].filter(function(item, index, array) {
        // * jika true item di-push ke hasil dan pengulangan berlanjut
        // * mengembalikan array kosong jika tidak ditemukan apapun
    });
}

let users2 = [
  {id: 1, name: "John"},
  {id: 2, name: "Pete"},
  {id: 3, name: "Mary"}
];

// ? mengembalikan array dua user pertama
let someUsers = users2.filter(item => item.id < 3);
console.log(someUsers);

// TODO - mengubah array
console.log('====================================');

/**
 * ? map
 * 
 * * Metode arr.map adalah salah satu metode yang paling berguna dan paling sering digunakan.
 * * Metode ini memanggil fungsi untuk tiap elemen di array dan mengembalikan hasilnya dalam bentuk array.
 */

{
  let result = ['halo', 'semua'].map(function(item, index, array) {
  // mengembalikan nilai baru, bukan item
  });
}
// ? contohnya, map akan membuat nilai baru berdasarkan item dalam array
let lengths = ["Bilbo", "Gandalf", "Nazgul"].map(item => item.length);
console.log(lengths);

// ? arr.sort() agak ribet, baca disini [https://id.javascript.info/array-methods]

// ? reverse
// * Metode arr.reverse membalikkan urutan elemen di dalam arr.
let arr9 = [1, 2, 3, 4, 5];
arr9.reverse();

console.log(arr9); // [5,4,3,2,1]

// ? split dan join

/**
 * ? SPLIT
 * 
 * * Metode str.split(delimiter) melakukan tepat hal yang dijelaskan di atas. 
 * * -> Metode ini memisahkan string ke dalam array dengan delimiter (pemisah) delim
 */

let names = 'Aditya, Rizky, Febryanto'
let arrNames = names.split(', ')
console.log(arrNames); // * ['Aditya', 'Rizky', 'Febryanto']

/**
 * ? JOIN
 * 
 * * arr.join(glue) melalukan kebalikan split. ini membuat sebuah string item-item arr digabungkan oleh 
 * * -> glue (lem) diantara item tersebut.
 */
let arrNames2 = arrNames.join(';')
console.log(arrNames2); // * 'Aditya;Rizky;Febryanto'

// ? reduce , reduceRight
console.log('====================================');

/**
 * ? Ketika kita perlu mengulang-ulang sebuah array – kita dapat menggunakan forEach, for atau for..of.
 * ? Ketika kita perlu mengulang dan mengembalikan data setiap elemen – kita menggunakan map.
 * 
 * ? Metode arr.reduce dan metode arr.reduceRight juga termasuk ke dalam kelompok metode-metode tadi, 
 * ? -> tapi ada sedikit lebih rumit. Kedua metode ini digunakan untuk menghitung sebuah nilai tunggal 
 * ? -> berdasarkan array.
 */

{
  let initial = 0;
  let value = ['halo', 'semua'].reduce(function(accumulator, item, index, array) {
    // ...
  }, [initial]);

  /**
   * ? Fungsi di atas diterapkan pada semua elemen array satu sama lainnya dan “melanjutkan” hasil perhitungannya 
   * ? -> ke panggilan berikutnya.
   * * Argument-argumennya yakni:
   * * [1] previousValue – adalah hasil dari dari pemanggilan fungsi sebelumnya, sama dengan initial pertama kalinya 
   * * -> (jika initial diberikan).
   * * [2] item – adalah item array yang sekarang.
   * * [3] index – adalah posisi item tersebut.
   * * [4] array – adalah array-nya.
   * 
   * ? Jika fungsi sudah diterapkan, maka hasil dari panggilan fungsi sebelumnya dioper ke panggilan selanjutnya 
   * ? -> sebagai argumen pertama.
   */
}

let arr10 = [1, 2, 3, 4, 5];
let resultArr10 = arr10.reduce((sum, current) => sum + current, 0)
console.log(resultArr10);

// ? ribet baca sendiri di link [https://id.javascript.info/array-methods#mengubah-array]


// TODO - Array.isArray()

/**
 * ? Array tidak membentuk sebuah bahasa tipe sendiri. Array terbentuk berdasarkan objek.
 * ? Jadi typeof tidak membantu membedakan sebuah objek polos dari sebuah array:
 */

console.log('====================================');
console.log(typeof { nama: 'Aditya' }); // ? object
console.log(typeof ['Aditya']); // ? object

/**
 * ? …Tetapi array serung diguakan hingga ada metode khusus untuk hal ini: Array.isArray(value). 
 * ? -> Metode ini mengembalikan true jika value adalah sebuah array, dan false jika sebaliknya.
 */

console.log(Array.isArray({ nama: 'Aditya' })); // ? false
console.log(Array.isArray(['Aditya'])); // ? true

// TODO - thisArg
// ? agak membingungkan baca disini [https://id.javascript.info/array-methods#kebanyakan-metode-mendukung-thisarg]



