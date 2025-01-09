// NOTE - Pengumpulan Sampah (_garbage collection_)
/**
 * * Manajemen memori di JavaScript dilakukan secara otomatis dan tak terlihat oleh kita. 
 * * -> Kita membuat primitive, objek, fungsi… Semua yang membutuhkan memori.
 * 
 * * Apa yang terjadi ketika sesuatu yang telah kita buat tersebut sudah tidak diperlukan? 
 * * -> Bagaimana engine JavaScript menemukan dan membersihkannya?
 */

// NOTE - Keterjangkauan (Reachability)
let user = {
    nama: 'John', // ? user memiliki referensi ke objek ini
}
// ? jika user = null; maka [nama:'John'] akah dihapus oleh garbageCollector

// ! Dua Rujukan
let admin = user;
// ? sekarang admin juga memiliki refernsi terhadap data [nama: 'John']
// * jika user = null, maka user tidak lagi memiliki referensi terhadap [nama: 'John']
// * tetapi [nama: 'John'] tidak akan dihapus, karena masih ter-referen dengan admin

// NOTE - Objek-objek yang saling terkait
function marry(man, woman) {
    woman.husband = man;
    man.wife = woman;

    return {
        father: man,
        mother: woman
    }
}

let family = marry({
    nama: 'John'
}, {
    nama: 'Jane'
})

/**
 * * Fungsi marry “mengawinkan” dua objek dengan memberikan keduanya rujukkan satu sama lain 
 * * -> dan mengembalikan sebuah objek baru yang berisikan kedua objek tersebut.
 */

delete family.father;
delete family.mother.husband;
 /**
  * * dengan melakukan hal diatas, semua object yang merujuk ke data [nama: 'John']
  * * -> sudah dihapus, maka data tersebut akan dihapus oleh garbage-collection
  */

// NOTE - Pulau tak terjangkau (Unreachable Island)
/**
 * * Mungkin saja satu kumpulan (pulau) objek yang saling tertaut menjadi tak terjangkau dan 
 * * -> dihapus dari memori.

 * * Objeknya sama seperti diatas. Kemudian:
 */
family = null;
// ? maka data [name: 'Jane'] pun akan dihapus
// console.log(family.woman); // ! error cannot read properties of null

/**
 * NOTE - Algoritma Internal
 * 
 * ? Algoritma garbage collection dasar disebut “mark-and-sweep”.
 * * Langkah “garbage collection” berikut dilakukan secara teratur:
 * * [1] Garbage collector mengambil objek roots dan “menandai” (marks / mengingat) mereka.
 * * [2] Kemudian ia mendatangi dan “menandai” semua rujukkannya.
 * * [3] Kemudian ia mendatangi objek yang telah ditandai tersebut dan menandai rujukkan mereka. 
 * *    -> Semua objek yang telah dikunjungi akan diingat, agar nantinya tidak mengunjungi 
 * *    -> objek yang sama dua kali.
 * * …Dan seterusnya sampai semua rujukkan yang dapat dijangkau (dari roots) telah dikunjungi.
 * * [4] Semua objek kecuali yang ditandai akan dihapus.
 * 
 * ? cukup banyak baca di
 * LINK - [https://id.javascript.info/garbage-collection#algoritma-internal]
 */