void main() {
  /**
 * NOTE: LIST
 * ? tipe data yang berisi kumpulan data
 * ! saat membuat list kita perlu menentukan tipe datanya
 * * untuk membuat data list memerlukan [], mirip array di bahasa pemrograman lain
 * * di dart, semua tipe data adalah object, jadi List juga punya method, property, 
 *  * -> dan operator sendiri
 * * dokumentasi lebih lanjut disini
 * LINK [https://api.dart.dev/dart-core/List-class.html]
 * 
 * ANCHOR: BEBERAPA: add, length, remove, removeAt(index),
 *   -> list[index], list[index] = 'x', dll
 * * beberapa mirip array
 */

  List<int> nomorUrut = [];
  /** atau*/ var hurufAbjad = <String>[];

  nomorUrut.add(1);
  nomorUrut.add(2);

  hurufAbjad.add('halo');
  hurufAbjad.add('semua');

  print(nomorUrut);
  nomorUrut.remove(1);
  print(nomorUrut);

  print(hurufAbjad);
  hurufAbjad.removeAt(0);
  print(hurufAbjad);

  // NOTE Deklarasi Secara Langsung
  var namaSaya = ['Aditya', 'Rizky', 'Febryanto'];

  // ini bisa tidak disebutkan tipe datanya, otomatis menyesuaikan value
  // bisa juga ditentukan tipe datanya

  var alamat = <String>['Sampit', 'Kotawaringin Timur', 'Kalimantan Tengah'];

  print(namaSaya);
  print(alamat);
}
