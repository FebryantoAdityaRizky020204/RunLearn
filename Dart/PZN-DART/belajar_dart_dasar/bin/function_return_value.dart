void main() {
  /**
   * ? Function Return Value
   * * secara default function menghasilkan null return, namun jika kita ingin kita bisa membuat
   * * -> function yang mengembalikan value
   * * keyword void harus diubah sesuai dengan return value yang akan diberikan
   * * hanya bisa memberikan 1 data dalam sebuah function tibak bisa lebih
   */

  var halo = sayHello(nama: 'Aditya');
  print(halo);

  int total = sum([2, 4, 5, 4, 3, 1, 2]);
  print('total $total');
}

String sayHello({String nama = ''}) {
  return 'Halo $nama';
}

int sum(List<int> numbers) {
  int total = 0;
  for (var n in numbers) {
    total += n;
  }
  return total;
}
