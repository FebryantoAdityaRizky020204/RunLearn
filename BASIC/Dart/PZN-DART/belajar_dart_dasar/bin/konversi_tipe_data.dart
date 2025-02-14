void main() {
  // semua tipe data di dart adalah Object
  // toString() -> dari number ke string
  // parse(x) -> dari string ke number
  // toInt() or toDouble() -> konversi number ke number

  var inputString = '1234';
  var inputInt = int.parse(inputString);
  var inputDouble = double.parse(inputString);

  print(inputString);
  print(inputInt);
  print(inputDouble);

  var intToDouble = inputInt.toDouble();
  var doubleToInt = inputDouble.toInt();
  var intToString = inputInt.toString();

  print(intToDouble);
  print(doubleToInt);
  print(intToString);

  // konversi boolean ke string
  // untuk bool ke string bisa menggunakan toString()
  // untuk string ke boolean, tidak ada caranya biasanya menggunakan operator perbandingan

  var inputString2 = 'true';
  var inputBool = bool.parse(inputString2);
  // inputBool bisa  error jika string bukan true atau false

  print(inputString2);
  print(inputBool);
}
