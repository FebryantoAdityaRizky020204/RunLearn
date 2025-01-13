// NOTE - Arrays

// ? Deklarasi
let arr1 = []
let arr2 = new Array()


arr1 = ['pisang', 'melon', 'nanas']
arr2 = arr1.map((item) => [...item])
console.log(arr2)
arr2[1] = 'apel'
console.log(arr2)

console.log('====================================');

// ? Sebuah array dapat menyimpan elemen dari tipe (data) apapun.
let anything = [
    'Apple',
    { nama: 'Aditya' },
    true,
    function () { console.log('halo') }
]

console.log(anything);
anything[3]()
console.log(anything[1].nama);

// NOTE - MEthod pop/push, shift/unshift
console.log('====================================');

/**
 * * Sebuah antrian (queue) adalah bentuk penggunaan paling umum sebuah array. Dalam computer science, 
 * * ->hal ini berarti sebuah koleksi elemen yang tertata yang mendukung dua operasi:
 * * [1] push menambahkan sebuah elemen di akhir antrian.
 * * [2] shift mengambil sebuah elemen di awal antrian, memajukan antrian elemen, 
 * * -> jadi elemen urutan ke-2 menjadi urutan pertama1.
 */

/**
 * * Ada kasus kegunaan lain untuk array – struktur data yang dinamakan tumpukan (stack).
 * * Stack mendukung dua operasi, yakni:
 * * [1] push menambahkan sebuah elemen di akhir tumpukan.
 * * [2] pop mengambil sebuah elemen di akhir tumpukan.
 * * Jadi elemen-elemen baru ditambahkan atau diambil selalu dari “akhir” tumpukan.
 */

let buahBuahan = ["Pisang", "Mangga", "Nanas", "Melon"]

buahBuahan.pop() // ? menghapus elemen terakhir (Melon)
console.log(buahBuahan); // ? ['Pisang', 'Mangga', 'Nanas']

buahBuahan.push('Melon') // ? menambahkan elemen (Melon) di akhir 
console.log(buahBuahan); // ? ['Pisang', 'Mangga', 'Nanas', 'Melon']

buahBuahan.shift() // ? menghapus elemen pertama (Pisang)
console.log(buahBuahan); // ? ['Mangga', 'Nanas', 'Melon']

buahBuahan.unshift('Pisang') // ? menambahkan elemen (Pisang) di awal
console.log(buahBuahan); // ? ['Pisang', 'Mangga', 'Nanas', 'Melon']

// ? array berprilaku mirip dengan object, contohnya referensi data didalamnya
// ? baca lebih jelas di [https://id.javascript.info/array], ada yang agak rumit untuk ditulis

// NOTE - Perulangan pada Array
console.log('====================================');

for (let i = 0; i < buahBuahan.length; i++){
    console.log(buahBuahan[i]);
}
console.log('------------------------------------');
for (let buah of buahBuahan){
    console.log(buah);
}
console.log('------------------------------------');
for (let keyBuah in buahBuahan) {
    console.log(buahBuahan[keyBuah]);
}
console.log('------------------------------------');
buahBuahan.forEach((buah) => { 
    console.log(buah);
})

/**
 * ! NOTEEEEEE
 * ? Namun sebenernya for..in adalah ide buruk. Ada beberapa masalah-masalah potensial:
 * ? Pengulangan for..in beralih pada semua properti, tidak hanya yang numerik saja.
 * 
 * ? Terdapat apa yang disebut sebagai objek “seperti array” dalam peramban serta lingkungan lainnya, yang terlihat 
 * ? -> seperti array. Objek tersebut, memiliki length dan properti yang ber-indeks, namun juga bisa memiliki properti 
 * ? -> non-numerik lain serta metode-metode, yang mana biasanya tidak kita butuhkan. Pengulangan for..in akan mendaftarkan 
 * ? -> properti tersebut. Jadi kita perlu bekerja dengan objek-objek yang seperti array, lalu properti-properti “ekstra” ini 
 * ? -> akan menjadi sebuah masalah.
 * 
 * ? Pengulangan for..in dioptimasi untuk objek-objek umum (generic), bukan array, dan 10-100 kali lebih lambat. Tentu saja, 
 * ? -> pengulangan tersebut masih begitu cepat. Percepatannya mungkin saja berpengaruh saat kondisi kemacetan saja. Namun tetap 
 * ? -> kita harus menyadari perbedaannya.
 * 
 * ? Secara umum, kita tidak seharusnya menggunakan for..in array.
 */


// NOTE - length

/**
 * ? Properti length secara otomatis diperbarui ketika kita memodifikasi array. Lebih tepatnya, 
 * ? -> length bukanlah jumlah nilai yang ada dalam array, tapi angka indeks terbesar ditambah satu.
 */

// * Contohnya, sebuah elemen tunggal dengan indeks yang besar juga menghasilkan panjang atau length yang besar:
let ayam = []
ayam[123] = 'ayam 123'
console.log(ayam.length); // ? 124, karena indeks terbesarnya adalah 123

// ? kita dapat menghapus/memotong array dengan mengurangi/menghapus lengthnya, misalnya
let cobaLength = [1, 2, 3, 4, 5, 6];
cobaLength.length = 3;
console.log(cobaLength); // ? [1, 2, 3]
// ? jadi cara mudah untuk menghapus value array adalah dengan mengatur nilai lengthnya menjadi 0
cobaLength.length = 0; // ? isi array auto kosong
console.log(cobaLength); // ? []

// NOTE - new Array()
console.log('====================================');
let arr3 = new Array(5)
/**
 * ? ini akan membuat array kosong, dengan index hingga 5,
 * ? new Array('Pisang', 'nanas', 'melon'), jarang digunakan karena syntax yang lebih panjang,
 * ? ini biasanya digunakan untuk membuat array kosong hingga n-index
*/

console.log(arr3[2]); // ? undefined
console.log(arr3.length); // ? 5

// NOTE - Array Multidimensi
console.log('====================================');
let arr4 = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
]

console.log(arr4[0][2]); // ? 3

/**
 * ? Array memiliki implementasi metode toString-nya sendiri yang mengembalikan daftar 
 * ? -> elemen yang dipisahkan oleh tanda koma.
 */

let arr5 = [1, 2, 3];
console.log(arr5); // [1,2,3]
console.log(String(arr5)); // 1,2,3
console.log(String(arr5) === '1,2,3'); // true






