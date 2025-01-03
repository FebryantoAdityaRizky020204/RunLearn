// ignore_for_file: unnecessary_type_check

void main() {
  /**
   * NOTE: Operator Type Test
   * ? untuk mengecek tipe data
   * * as, typecast .untuk melakukan konversi tipe data secara paksa
   * * is, true. jika object sesuai tipe data
   * * is!, true. jika object tidak sesuai tipe data
   */

  dynamic variable = 100;
  var variableInt = variable as int;
  // var variableString = variable as String; ini akan error, tidak bisa dikonversi

  var isInt = variableInt is int;
  var isNotBoolean = variableInt is! bool;

  print('Variable: $variable');
  print('isInt: $isInt');
  print('isNotBoolean $isNotBoolean');
}
