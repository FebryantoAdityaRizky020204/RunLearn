void main() {
  // Penulisan variabel camelCase
  String namaLengkap;
  namaLengkap = 'Aditya Rizky Febryanto';
  print(namaLengkap);

  String namaDepan = 'Aditya';
  print(namaDepan);

  // bisa juga menggunakan var, tipe data akan ditentukan sesuai isinya secara otomatis
  var namaBelakang = 'Rizky Febryanto';
  print(namaBelakang);

  // secara default nilai variabel dart bisa dirubah, jika tidak ingin gunakan [final],
  // .. variabel tidak bisa dideklrasasikan  ulang
  final usia = 20;
  print(usia);

  // const variabel dan nilainya tidak bisa diubah
  const phi = 3.14;
  print(phi);

  // =========
  final array1 = [1, 2, 3];
  const array2 = [1, 2, 3];

  array1[0] = 10; // ini boleh karena hanya merubah isinya
  // array2[0] = 10; ini akan menyebabkan error
  // array1 = [2,3,4]; ini juga akan menyebabkan error, karena mendeklarasi ulang

  print(array1);
  print(array2);

  // late, mendeklarasikan variabel ketika variabel tersebut diakses
  var value = getValue();
  print('variabel dibuat');
  print(value);
  // output
  // .. getValue() dipanggil
  // .. variabel dibuat
  // .. Aditya Rizky Febryanto

  late var value2 = getValue();
  print('variabel dibuat');
  print(value2);
  // output
  // .. variabel dibuat
  // .. getValue() dipanggil
  // .. Aditya Rizky Febryanto
  //  value2 baru akan dibuat ketika diakses {print(value2)}
}

String getValue() {
  print('getValue() dipanggil');
  return 'Aditya Rizky Febryanto';
}
