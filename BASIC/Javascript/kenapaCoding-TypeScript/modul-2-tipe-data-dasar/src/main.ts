let nama = "Aditya Rizky"
console.log(nama);

// *buat konfigurasi typescript [tsc --init] [ubah outdir ke build/js] [tsc -w]
export {}

// ?================ Tipe Data dasar di typescript
/**
 * *ts memiliki tipe data dasar yang serupa dengan js, tetapi dengan dukungan tipe statis yang lebih kuat, di ts bisa menentukan
 * *-> tipe data variabel secara otomatis melalui type inference atau secara eksplisit dengan type annotations
 */

// *Type Inference, ts secara otomatis mendeteksi tipe databerdasarkan nilai awal
let message = "Hello"; //*ts otomatis mengenali string

// *Type Annotations, kita bisa menetapkan secara eksplisit
let age: number = 30; //*kita tetapkan variabel age bertipe number




// ?================ Tipe Data
// *String [menyimpan teks]
let namaSaya: string = "Aditya Rizky Febryanto"

// *Number [bilangan bulat/desimal]
let umurSaya: number = 21

// *Boolean, [true|false]
let isStudent: boolean = true

// *Array [koleksi nilai dengan tipe data sama]
let numbers: number[] = [1,2,3,4]

// *Tupple [array dengan jumlah elemen tetap, dan tipe data berbeda]
let myIdentity: [string, number] = ["Aditya Rizky Febryanto", 21]

let testObject: {id: number} = {id: 1}

// *Tipe Data : any
/**
 * *dalam ts salah satu fitur yang sering digunakan untuk menangani situasi dimana tipe data tidak diketahui secara pasti
 * *-> adalah tipe data any, tipe ini memungkinkan variabel untuk menampung nilai dari tipe apa saja, baik itu string number,
 * *-> object, dll
 * *any adalah tipe data khusus dalam ts yang secara eksplisit menonaktifkan type checking pada suatu variabel, artinya, sebuah 
 * *-> variabel bertipe any dapat menerima nilai apapun tanpa ts melakukan pemeriksaan jenis datanya
 * *-> 
 */
let variabelX: any;
variabelX = "Halo"
variabelX = 21
variabelX = {id:1}
variabelX = true

// *Kapan menggunakan any
/**
 * *anda tidak tahu tipe data yang akan digunakan pada variabel atau nilai yang diproses secara dinamis
 * *anda sedang melakukan migrasi dari javascript ke typescript, dan tipe" tertentu belum ditentukan dengan jelas
 * *terdapat situasi dimana anda bekerja dengan data dari sumber eksternal seperti API, dan tipe data tdk dpt diprediksi
 * *
 * *-> 
 * *-> 
 */
function logValue(value: any){
    console.log(value);
}

logValue("This is a string")
logValue(100)
logValue([1,2,3])

/**
 * *Risiko penggunaan any
 * 
 * *penggunaan any dapat menyebabkan hilangnya manfaat utama typescript, yaitu keamanan tipe, karena ts tidak lagi melakukan
 * *-> pengecekan tipe data pada variabel bertipe any, hal ini bisa menyebabkan runtime error yang sulit diprediksi saat kompilasi
 * *-> 
 */



// * Union Types dan Literal Types

// *Union, digunakan ketika sebuah variabel bisa memiliki lebih dari satu tipe data
let myId: string | number;
let arrUn: (string|number)[]
myId = "12ABC"
myId = 29399393
arrUn = [1,2,3, "halo"]

// *Literal, digunakan untuk membatasi variabel agar hanya bisa menyimpan nilai tertentu
let isOpen : "yes" | "no"; // nilainya hanya bisa dua ini


// *TYPE Aliases
/**
 * *ts memungkinkan kita untuk mendefinisikan alias untuk tipe data yang kompleks atau panjang menggunakan keyword type,
 * *-> alih" menulis ulang tipe yang sama berulang kali, kita bisa memberikan nama alias untuk tipe tersebut dan menggunakannya
 * *-> di berbagai tempat
 */
type ID = number | string;
let userId : ID;
userId = 123;
userId = "ABC";

type User = {
    id: number;
    name: string;
    isActive: boolean;
};

const user1: User = {
    id: 1,
    name: "John Doe",
    isActive: true
}


// *OPTIONAL Properties

/**
 * *ts menyediakan fitur yang memungkinkan anda untuk mendefinisikan properti opsional pada objek menggunakan optional properties,
 * *-> properti opsional adalah properti yang tidak wajib diisi pada sebuah objek, dengan kata lain, properti tersebut bisa ada
 * *-> atau tidak ada, tergantung kebutuhan
 */
type User2 = {
    name: string;
    age?: number;
    email?: string;
}

let userT1 = {
    name: "Aditya"
}

let userT2 = {
    name: "Rizky",
    age: 21
}


// *ENUM
/**
 * *enum (enumerasi) di ts adalah cara untuk mendefinisikan sekumpulan nilai yang memiliki nama dan biasanya digunakan untuk 
 * *-> merepresentasikan data yang terbatas dan tetap, seperti status, arah, atau kode kesalahan. enum memungkinkan anda untuk
 * *-> mendefinisikan nama yang bermakna untuk sekelompok nilai konstan.
 */
enum Direction1 {
    Up, //0
    Down,//1
    Left,//2
    Right//3
}

enum Direction2 {
    Up= 1,
    Down,
    Left,
    Right
}

enum Direction3 {
    Up = "UP",
    Down = "DOWN",
    Left = "LEFT",
    Right = "RIGHT"
}

console.log(Direction1.Up); //0

console.log(Direction2.Up); //1
console.log(Direction2.Down); //2

console.log(Direction3.Down); //DOWN


// *CONST ENUM
/**
 * *const enum adalah versi khusus dari enum yang dioptimalkan untuk kinerja. ketika menggunakan const enum , ts menghilangkan
 * *-> semua deklarasi enum dari hasil kompilasi dan menggantinya langsung dengan nilai enum
 * *
 */

const enum Direction4 {
    Up, Down, Left, Right
}
console.log("Const enum (Right): ", Direction4.Right);

// *TIPE UNKNOWN
/**
 * *unknown adalah tipe bawaan di ts yang digunakan ketika anda tidak tahu tipe data apa yang akan diterima, tipe ini lebih
 * *-> aman dibandingkan dengan any, karena memaksa kita untuk melakukan pengecekan tipe sebelum menggunakan nilainya, dalam
 * *-> kata lain, unknown memberikan fleksibilitas tanpa mengorbankan keamanan tipe
 * *
 */

let dataUnk: unknown;
dataUnk = 123
dataUnk = "Hello"

// dataUnk.toUpperCase(); //? Error : data is type 'unknown'

if(typeof dataUnk === "string") {
    dataUnk.toUpperCase() // ini aman
}

// ?================ Type Assertion
/**
 * *type assertion di ts adalah cara memberi tahu compiler bahwa kita lebih tahu mengenai tipe data dari sebuah nilai dibandingkan
 * *-> apa yang ts inferensikan. type assertion digunakan untuk mengubah tipe variabel secara eksplisit tanpa melakukan konversi
 * *-> data di runtime. melainkan hanya membantu ts memahami kode statis.
 * *
 * *type assertion tidak mengubah tipe data aktual yang digunakan oelh js, tapi hanya mengubah cara ts memeriksa tipe tersebut 
 * *-> selama proses kompilasi.
 * *
 * *terdapat dua sintaks yang dapat digunakan
 * *# menggunakan sintaks "angle-bracket"
 * *# menggunakan as keyword
 * *-> 
 */


let someValue: unknown = "Hello TypeScript!"
// *menggunakan angle-bracket
let stringLength: number = (<string>someValue).length
console.log(stringLength);

// *menggunakan as keyword
let stringLength2: number = (someValue as string).length
console.log(stringLength2);

/**
 * *pada contoh diatas, kita memberitahu ts bahwa someValue sebenarnya bertipe string, sehingga kita memanggil properti
 * *-> length pada variabel tersebut
 */

/**
 * *Kapan menggunakan type assertion
 * 
 * *# saat ts tidak inferensi tipe dengan baik, misalnya ketika variabel bertipe any
 * *# saat menggunakan API atau library yang mengembalikan tipe umum, tapi kita yakin dengan tipe yang spesifik (misalnya saat
 * *# -> memanipulasi elemen DOM)
 */
const myInputTest= document.getElementById("my-input") as HTMLInputElement
myInputTest.value = "New Value"