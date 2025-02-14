// ignore_for_file: slash_for_doc_comments

void main() {
  /** 
   * ? Named Parameter
   * * Secara default, posisi parameter ketika memanggil function harus sesuai dengan posisi
   * * -> parameter di function tersebut
   * * dart memiliki fitur named parameter, dimana saat mengisi params kita bisa menyebutkan 
   * * -> nama paramsnya, sehingga tidak perlu sesuai urutan/posisi parameternya
   * * bisa dibuat dengan beberapa perubahan saat membuat params di function, menggunakan {}
   * * secara default named params adalah nullable, sehingga perlu ditambahkan ?
   * * tetapi ketika menggunakan ini, setiap argumen harus disertai nama params
  */

  sayHello(namaDepan: 'Aditya', namaBelakang: 'Rizky');
  sayHello(namaBelakang: 'Rizky', namaDepan: 'Aditya');
  sayHello2(namaDepan: 'arf');
  sayHello3(nama: 'Adit');
}

void sayHello({String? namaDepan, String? namaBelakang}) {
  print('halo $namaDepan $namaBelakang');
}

/**
 * ? juga bisa menggunakan default value, dan params tidak akan nullable lagi
 */
void sayHello2({String namaDepan = 'nama-depan', String? namaBelakang}) {
  print('2-Halo $namaDepan $namaBelakang');
}

/**
 * ? Required Parameter
 * * pada named parameter, kita bisa memubuat sebuah params menjadi mandatory function
 * * -> jadi ketika function dipanggil argumen untuk params tersebut wajib diberikan
 * * dengan memberikan required di awal parameter
 */

void sayHello3({required String nama}) {
  print('Halo $nama');
}
