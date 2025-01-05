void main() {
  /**
   * ? For In
   * * terkadang kita ingin mengakses list menggunakan pengulangan
   * * -> kemudian mengaksesnya berdasarkan indeksnya yang sedikit ribet
   * * tetapi ini akan lebih mudah dengan menggunakan for-in
   */

  var arrayName = <String>['Aditya', 'Rizky', 'Febryanto'];
  for (var name in arrayName) {
    print(name);
  }
}
