void main() {
  /**
   * ? while loop adalah versi sederhana for-loop
   * ? di while-loop hanya ada kondisi pengulangan, tanpa ada init sttmnt dan post sttmnt
   */

  var counter = 1;
  while (counter <= 10) {
    print('angka : $counter');
    counter++;
  }

  /**
   * ? do while loop
   * ? mirip dengan while loop, tetapi do-while-loop akan menjalankan bagan program
   * ? -> setidaknya satu kali
   */

  int angka = 2;
  do {
    print('angka: $angka');
    angka++;
  } while (angka <= 2);
}
