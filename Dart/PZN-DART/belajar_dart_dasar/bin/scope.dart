void main() {
  /**
   * ? Scope
   * * variabel atau func hanya bisa diakses di dalam area dimana mereka dibuat
   * * hal ini disebut scope
   * * contoh, jika sebuah variabel dibuat di function, maka hanya bisa diakses 
   * * -> di function tersebut saja
   * * atau jika dibuat di sebuah block kode {}, maka hanya bisa dijalankan di
   * * -> block kode tersebut saja
   */

  var halo = 'Halo Semua';
  print(halo);
}

void manhhh() {
  // print(halo); // ! ini akan error
}
