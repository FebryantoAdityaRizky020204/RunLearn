void main() {
  /**
   * NOTE: Operator Logika
   * ? && -> and
   * ? || -> or
   * ? !  -> not
   */

  print('true && true = ${true && true}');
  print('true && false = ${true && false}');
  print('false || true = ${false || true}');
  print('false || false = ${false || false}');
  print('!false = ${!false}');
  print('!true = ${!true}');

  int nilai = 100;
  int kehadiran = 16;

  bool hasilNilai = nilai >= 90;
  bool hasilKehadiran = kehadiran >= 16;
  print('=======================================');
  print('Hasil Nilai: $hasilNilai');
  print('Hasil Kehadiran: $hasilKehadiran');

  bool lulus = hasilNilai || hasilKehadiran;
  print('Lulus: $lulus');
}
