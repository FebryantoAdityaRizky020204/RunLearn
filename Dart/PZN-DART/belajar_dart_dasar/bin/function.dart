void main() {
  /**
   * ? Blok kode Program yang akan berjalan ketika dipanggil
   * ? function disebut juga method dalam konsep oop
   * ? contohnya, print()
   */
  sayHello2('Aditya');
  sayHello3('namaDepan'); // params kedua optional
  sayHello3('namaDepan', 'namaBelakang');
  sayHello4('namaDepan');
}

// ? Contoh function, di dart biasanya penulisan function camelCase
void sayHello(String s) {
  print('Halo Semua');
}

// ignore: slash_for_doc_comments
/**
 * ? Function parameter
 * * bisa mengirim parameter dengan menambahkan argumen/parameter di function 
 * * -> yg dibuat dan dikirim
 */

void sayHello2(String nama) {
  print('Halo $nama');
}

/// ? Optional Parameter
/// ? decara default params wajib dikirim ketika function dipanggil
/// ? namaun, jika ingin terdapat params optional, bisa dibungkus []
/// ? dan parameter optional harus nullable
void sayHello3(String namaDepan, [String? namaBelakang]) {
  print('Halo $namaDepan $namaBelakang');
  // namaBelakang tidak harus ada, optional
}

// ? Default Parameter
// * kita bisa terapkan default value di optional params,
// * -> sehingga tidak perlu nullable params untuk optional value
void sayHello4(String namaDepan,
    [String namaBelakang = 'defaultValue', String optional = '']) {
  // sekarang optional value tidak perlu nullable
  print('Halo $namaDepan $namaBelakang $optional');
}
