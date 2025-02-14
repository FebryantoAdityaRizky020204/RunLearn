void main() {
  /**
   * ? Higher Order Function
   * * adalah function yang menggunakan func sebagai variable, params atau return value
   * * penggunaan higher-order func kadang berguna ketika ingin membuat function yang general dan ingin mendapatkan input
   * * -> yang flexible berupa function, yang bisa dideklarasikan ketika memanggil func tersebut
   */

  sayHello('Aditya', uppercaseName);
}

// ? Contoh higher order function
/// ? jadi terdapat sebuah function yang dapat dipanggil dengan keyword uppercase
/// ? fungsi ini akan mereturn String maka didapatlah String Function()
/// ? func ini akan memiliki satu params dengan tipe data string maka Function(String)
/// ? jika terdapat dua params maka Function(String, String)
/// ? begitulah munculnya String Function(String) uppercase
void sayHello(String nama, String Function(String) uppercase) {
  var uppercaseName = uppercase(nama);
  print('Hi $uppercaseName');
}

// ? inilah function yang akan dikirim nantinya
String uppercaseName(String name) => name.toUpperCase();
