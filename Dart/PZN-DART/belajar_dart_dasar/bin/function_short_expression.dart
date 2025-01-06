void main() {
  /**
   * ? Function Short Expression
   * * dart mendukung fse
   * * dimana jika terdapat sebuah function yang hanya satu baris, kita bisa menyingkatnya secara sederhana
   * * untuk membuat FSE, menggunakan {} dan tidak memerlukan kata kunci return
   */

  int sums = sum(5, 5);
  print('Total: $sums');
}

// ? contoh FSE
int sum(int first, int two) => first + two;
