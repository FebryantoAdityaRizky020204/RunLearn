// ignore_for_file: unused_local_variable

void main() {
  /**
   * ? Null Safety
   * * dalam bahasa pemrograman, NullPointerException adalah salah satu kesalahan 
   * * -> yang sangat sering dilakukan programmer
   * * biasanya terjadi ketika mengakses data yang null
   * * dart mendukung null safety, dimana ini membantu programmer dari melakukan kesalahan
   * * -> mengakses data yang null
   * 
   * ? Null Check
   * * secara default, saat mengakses property, method atau operator terhadap data yang nullable
   * * -> maka dart akan memberi compile error
   * * dart akan meminta kita melakukan cek Null Check terlebih dahulu, sebelum mengakses 
   * * -> data nullablenya
   */

  int? age;
  // print(age.toDouble()); // ! ini cara yang salah

  // buat null check
  // ignore: unnecessary_null_comparison
  if (age != null) {
    print('halo semua');
  }

  /**
   * ? Konversi Nullable ke non nullable
   * * untuk melakukan konversi tipe data non null ke nullable, bisa langsung masukkan datanya saja
   * * namun untuk melakukan konversi tipe data nullable ke non nullable, kita wajib melakukan 
   * * -> null check terlebih dahulu
   */

  String nama = 'Aditya Rizky Febryanto';
  String? nama2 = nama; // sekalipun memiliki value, nama2 merupakan nullable

  int? nullableNumber;
  // ignore: unnecessary_null_comparison
  if (nullableNumber != null) {
    // ! jika != diubah menjadi == maka akan error
    int number = nullableNumber;
    // * sekarang number adalah nullable variabel
    print(number);
  }

  /**
   * ? Default Value
   * * untuk menjadi value ke ddefault value jika variabel bernilai null
   * * dapat menggunakan operator ??
   */

  String? guest;
  var guestName = guest ?? 'Guest';
  //  ? jika guest adalah null, maka isi value menjadi 'Guest'

  /**
   * ? Konversi secara paksa 
   * * dart mendukung konversi secara paksa dari tipe nullable ke nonullable
   * * -> dengan menggunakan karakter ! (tanda seru) setelah nama variable nullable
   * 
   * * namun konsekuensinya jika variabel ternyata datanya null, maka otomatis akan terjadi error
   * * -> ketika aplikasi berjalan
   */

  int? nullableNumber2;
  nullableNumber2 = 2; // nullablenumber harus diberi nilai agar tidak error
  var number = nullableNumber2;
  print(number);
}
