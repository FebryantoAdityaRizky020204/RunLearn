// NOTE - Method Pada data Primitif

/**
 * * Javascript memperbolehkan kita untuk bekerja dengan primitif (string, angka, dan lain-lain.) 
 * * -> Mereka dapat digunakan seperti jika mereka adalah objek. Mereka juga menyediakan metode untuk 
 * * -> didipanggil. Kita akan belajar tentang hal itu nanti, tapi pertama kita akan melihat bagaimana 
 * * -> hal itu bekerja, dan juga, primitif bukanlah objek (dan disini kita akan membuat hal itu lebih 
 * * -> jelas).
 */

/**
 * ? Primitif
 * * [1] Adalah sebuah nilai dari tipe primitif.
 * * [2] Ada 7 primitif tipe: string, number, bigint, boolean, symbol, null dan undefined.
 */

/**
 * ? Objek
 * * [1] Mampu untuk menyimpan banyak nilai sebagai properti.
 * * [2] Bisa dibuat dengan menggunakan {}, contoh: {name: "John", age: 30}. 
 * * -> Terdapat beberapa macam objek di Javascript: untuk contoh, fungsi, adalah objek.
 */

// * Salah satu hal yang terbaik tentang objek adalah kita bisa menyimpan fungsi 
// * -> sebagai salah satu dari propertinya.
let john = {
  name: "John",
  sayHi: function() {
    console.log("Hi buddy!");
  }
};
john.sayHi(); // Hi buddy!

// ! Penjelasannya agak ribet, baca sendiri di [https://id.javascript.info/primitives-methods]

/**
 * ? RINGKASAN
 * 
 * * Primitif kecuali null dan undefined menyediakan banyak metode yang berguna. 
 * * -> Kita akan belajar hal itu di bab selanjutnya.
 * * Secara formal, metode-metode ini akan bekerja dengan menggunakan objek sementara, 
 * * -> tapi mesin Javascript telah dibuat dengan baik untuk mengoptimasi hal itu secara internal, 
 * * -> jadi mereka tidaklah sulit untuk dipanggil.
 */