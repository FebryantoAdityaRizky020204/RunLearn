void main() {
  /**
   * NOTE: Set
   * ? mirip list tetapi tidak bisa duplikat data yang sama
   * * menggunakan kurung kurawal {}
   * 
   * ! di set tidak bisa edit data, hanya bisa add, remove dan length
   */

  Set<String> namaSaya = {};
  Set alamat = <String>{'Sampit', 'Kotawaringin Timur', 'Kalimantan Tengah'};

  namaSaya.add('Aditya');
  namaSaya.add('Aditya'); // ini tidak akan dimasukan karena sama
  namaSaya.add('Rizky');
  namaSaya.add('Febryanto');

  print(namaSaya);
  namaSaya.remove('Aditya');
  print(namaSaya);

  print(alamat.length);
}
