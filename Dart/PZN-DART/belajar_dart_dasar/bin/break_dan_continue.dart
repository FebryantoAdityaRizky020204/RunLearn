void main() {
  /**
   * ? break dan continue
   * * break, digunakan untuk menghentikan suatu program dalam satu bagan
   * * continue digunakan untuk menskip langkah sekarang, dan melanjutkan ke langkah berikutnya
   */

  // contoh pada perulangan
  var counter = 1;
  while (counter >= 1) {
    if (counter % 2 == 0) {
      print('Perulangan ke-$counter');
    }

    if (counter == 21) break;
    counter++;
  }

  counter = 1;
  while (counter >= 1) {
    if (counter % 2 == 0) {
      counter++;
      continue;
    }
    print('X-Perulangan ke-$counter');

    if (counter == 21) break;
    counter++;
  }
}
