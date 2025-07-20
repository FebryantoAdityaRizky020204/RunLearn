// @======================== Utility Types
/**
 * *utility types di ts adalah kumpulan type helpers yang disediakan untuk memodifikasi dan memanipulasi tipe. dengan utility
 * *-> types, kita dapat membuat tipe baru berdasarkan tipe yang sudah ada, tanpa harus menuliskan tipe baru dari awal, mereka
 * *-> berguna untuk menghindari engulangan kode dan keamanan tipe.
 * *
 */


// @======================== Partial <T>
/**
 * *partial embuat semua properti dari tipe T menjadi opsional, ini berguna saat kita ngin bekerja dengan objek yang mungkin
 * *-> hanya memiliki sebagain dari properti yang dibutuhkan
 * *
 */

interface User {
    id: number,
    name: string,
    email: string
}

function updateUser(user: Partial<User>){
    // ?memungkinkan untuk hanya mengupdate sebagain properti
    console.log(user);
}

updateUser({name: "Aditya"})

// @======================== Required <T>
/**
 * *kebalikan dari partial. utility required menjadikan semua properti tipe T, sebagai properti wajib (tidak boleh undefined)
 * *->
 */
interface UserTwo {
    id?: number,
    name?: string
}

const user: Required<UserTwo> = {
    // $HARUS ada semua properti
    id: 1,
    name: "Aditya"
}


// @======================== Readonly
/**
 * *utility ini menjadikan semua properti dari tipe T menjadi hanya bisa baca (readonly), artinya tidak bisa mengubah nilainya
 * *-> setelah diinisialisasi
 */
interface UserThree {
    id: number,
    name: string
}

const userThree: Readonly<UserThree> = {
    id: 1,
    name: "Aditya"
}

// userThree.name = "Aditya" // ~ Error: cannot assign because it's a read-nly property


// @======================== Pick<T, K>
/**
 * *pick memungkinkan kita untuk memilih subset dari properti yang ada pada tipe T
 * *->
 */

interface UserFour {
    id: number,
    name: string,
    email: string
}

type UserInfo = Pick<UserFour, 'id' | 'name'>

const userInfo: UserInfo = {
    id: 1,
    name: "Aditya"
}

// @======================== Omit
/**
 * *omit berfungsi kebalikan dari pick, ini menghapus properti tertentu dari tipe T
 */

type userWithoutEmailAndId = Omit<UserFour, 'email' | 'id'>
const userInfoTwo: userWithoutEmailAndId = {
    name: "Aditya"
}


// @======================== Record<K, T>
/**
 * *record digunakan untuk membuat tipe objek dimana kunci (K) dipetakan ke nilai dari tipe tertentu (T)
 */
type UserRoles = 'admin' | 'user' | 'guest'

const userRoles: Record<UserRoles, string[]> = {
    admin: ["alice", "bob"],
    user: ["charlie"],
    guest: []
}


// @======================== Extract<T, U>
/**
 * *menghasilkan tipe yang hanya mengandung elemen T yang juga ada di U
 */
type StringOrNumber = string | number
type OnlyString = Extract<StringOrNumber, string>// ? hasilnya hanya string

// @======================== Exclude<T, U>
/**
 * *kebalikan dari extract, menghasilkan tipe yang menghapus elemen dari T yang juga ada di U
 */

type onlyNumber = Exclude<StringOrNumber, string>//? hasilnya hanya number


// @======================== NonNullable<T>
/**
 * *menghilangkan null dan undefined dari type
 */
type ThereIsNull = string | null | undefined
type iIsJustString = NonNullable<ThereIsNull>

// @======================== ReturnType<T>
/**
 * *menghasilkan tipe dari kembalian fungsi T
 */
function getUser(){
    return {id: 1, name: "Alice"}
}

type UserReturnType = ReturnType<typeof getUser>
// ?hasilnya adalah {id: number, name: string}

// @======================== InstanceType
// *menghasilkan tipe dari instance class T

class Person {
    name: string
    constructor(name: string){
        this.name = name
    }
}


type PersonInstance = InstanceType<typeof Person>


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