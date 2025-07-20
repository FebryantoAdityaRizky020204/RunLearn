"use strict";
// @======================== Utility Types
/**
 * *utility types di ts adalah kumpulan type helpers yang disediakan untuk memodifikasi dan memanipulasi tipe. dengan utility
 * *-> types, kita dapat membuat tipe baru berdasarkan tipe yang sudah ada, tanpa harus menuliskan tipe baru dari awal, mereka
 * *-> berguna untuk menghindari engulangan kode dan keamanan tipe.
 * *
 */
function updateUser(user) {
    // ?memungkinkan untuk hanya mengupdate sebagain properti
    console.log(user);
}
updateUser({ name: "Aditya" });
const user = {
    // $HARUS ada semua properti
    id: 1,
    name: "Aditya"
};
const userThree = {
    id: 1,
    name: "Aditya"
};
const userInfo = {
    id: 1,
    name: "Aditya"
};
const userInfoTwo = {
    name: "Aditya"
};
const userRoles = {
    admin: ["alice", "bob"],
    user: ["charlie"],
    guest: []
};
// @======================== ReturnType<T>
/**
 * *menghasilkan tipe dari kembalian fungsi T
 */
function getUser() {
    return { id: 1, name: "Alice" };
}
// ?hasilnya adalah {id: number, name: string}
// @======================== InstanceType
// *menghasilkan tipe dari instance class T
class Person {
    constructor(name) {
        this.name = name;
    }
}
// @======================== Kapan menggunakan utility types
/**
 * *utility types digunakan saat kita ingin melakukan modifikasi tipe secara dinamis tanpa mendefinisikan ualng tipe yang sudah
 * *-> ada. mereka membantu menulis kode yang lebih efisien, reusable, dan aman secara tipe. berikut adalah bebrapa contoh umum
 * *-> kapan menggunakan utility types.
 *
 * *# Partial: untuk membuat objek opsional, misalnya dalam fungsi update
 * *# Pick atau Omit: untuk membuat tipe dengan subset properti tertentu
 * *# Readonly: untuk memastikan objek tidak dapat diubah setelah diinstansiasi
 * *# Record: untuk membuat peta objek dengan kunci tipe tetap
 */
// @======================== Kesimpulan
/**
 * *utility types di ts adalah alat yang sangat kuat untuk memodifikasi dan memanipulasi tipe yang sudah adadengan cara yang
 * *-> fleksibeldan efisien. dengan menggunakan utility types, kita dapat enghindari pengulangan kode, meningkatkan keamanan
 * *-> kode, dan menulis kode yang lebih modular dan reusable.
 * *
 * * konsep utility types membantu pengembang ts dalam menulis kode yang lebih aman, sambil tetap menjaga fleksibilitas
 * *-> dan keterbacaan
 */ 
