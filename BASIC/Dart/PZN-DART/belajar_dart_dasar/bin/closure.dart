void main() {
  /**
   * ? Closure
   * * closure adalah kemampuan sebuah func atau anon func berinteraksi dengan data-data sekitarnya
   * * -> dalam scope yang sama
   * * harap gunakan fitur ini dengan bijak saat membuat aplikasi, karena kita bisa bingung 
   * * -> kenapa sebuah data bisa berubah
   */
  var counter = 0;

  void increment() {
    print(counter);
    counter++;
  }

  increment();
  print(counter);
}
