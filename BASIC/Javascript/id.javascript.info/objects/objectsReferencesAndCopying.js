// NOTE = Referensi dan salinan

/**
 * * salah satu perbedaan antara object vs primitif adalah
 * * -> objek disimpan dan disalin "dengan rferensi"
 * * -> nilai primitif (string, boolean, etc) selalu disalin "sebagai nilai keseluruhan"
 */

let message = 'halo semua'
let phrase = message;
// ? Sebagai hasilnya kita punya dua variabel yang berdiri sendiri, dan keduanya menyimpan nilai string "Hello!".

// ? objek tidak seperti itu
/**
 * * Sebuah variabel tidak menyimpan objek itu sendiri, akan tetapi “disimpan didalam memori”, 
 * * -> dengan kata lain “mereferensi” kepadanya (ke data didalam memori).
 */
let user = {
    nama: 'Aditya'
}
admin = user;
/**
 * * pada syntax diatas, admin hanya akan menyalin refenrensi nama saja, tidak membuat data baru dengan key nama
 * 
 * ? nama = #123,
 * * user.nama => #123
 * * admin.nama => #123
 * ? kedua object tersebut merujuk ke data dengan referensi yang sama
 */

admin.nama = 'Rizky';
console.log(`nama di user ${user.nama}`);
console.log(`nama di admin ${admin.nama}`);
// ? keduanya akan memiliki nama 'Rizky', ini membuktikan bahwa keduanya merujuk ke data yang sama

console.log('====================================');

// NOTE - Perbandingan dan Referensi
// ? dua objek adalah sama jika mereka objek yang sama
let a = {}
let b = a
console.log(a === b); // ? akan bernilai true, karena keduanya berbagi referensi yang sama #123 = (a,b)

let aA = {}
let bB = {}
console.log(aA === bB); // ? false, karena keduanya berbagi referensi yang berbeda

console.log('====================================');

// NOTE - Penggandaan dan penggabungan, assign object

/**
 * * Jadi, menyalin sebuah variabel objek akan menciptakan satu lagi referensi kepada objek yang sama.
 * * -> Tapi bagaimana jika kita butuh untuk menduplikasi objek? Membuat salinan yang berdiri sendiri, 
 * * -> menggandakan atau meng-klon?
 */

let user1 = { nama: 'Aditya', age: 20 }
let clone = {}

for (let key in user1) {
    clone[key] = user1[key];
}
// ? ini akan membuat clone yang berdiri sendiri
clone.nama = 'Rizky'
console.log(user1); // ? ini tidak akan terpengaruh
console.log(clone);

// ? ada cara lain yaitu menggunakan Object.assign(dest, sources, sources)
let user2 = { name: "John" };

let permissions1 = { canView: true };
let permissions2 = { canEdit: true };

// ? menyalin seluruh properti dari permission1 dan permission2 kedalam user2
Object.assign(user2, permissions1, permissions2);
console.log(user2);
// * sekarang user2 = { name: "John", canView: true, canEdit: true }

// ! jika terdapat key yang sama. maka data akan ditimpa
Object.assign(user2, { name: 'Rizky' });
console.log(user2);
// * sekarang user2 = { name: "Rizky", canView: true, canEdit: true }

/**
 * ? Kita juga bisa menggunakan Object.assign untuk mengganti perulangan for...in untuk penggandaan yang sederhana.
 */
let siswa = { nama: 'Aditya', age: 20 }
let cloneSiswa = Object.assign({}, siswa); // ? ini akan menyalin key-value dari siswa ke clone
console.log(cloneSiswa);
console.log('====================================');


// NOTE - Nested Cloning
// ? ada sedikit masalah untuk kloning object bersarang
let user4 = {
  name: "John",
  sizes: {
    height: 182,
    width: 50
  }
};

let clone = Object.assign({}, user4);
alert(user4.sizes === clone.sizes); // true, objek yang sama

// user dan clone akan berbagi objek yang sama
user4.sizes.width++;       // ganti properti dari satu tempat
alert(clone.sizes.width); // 51, melihat hasilnya ditempat yang lain

// ? cara paling aman untuk hal ini adalh menggunakan kloning perulangan secara mendalam,
// * -> itu disebut deep cloning

// ? atau bisa menggunakan method dibawah dari library lodash
// LINK - [https://lodash.com/docs#cloneDeep]
