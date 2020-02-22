
# Dokumentasi Dale

Dale merupakan kelas php sederhana yang dapat membantu pengembang untuk melakukan pengembangan API berbasis bahasa pemograman php dengan mudah dan sederhana

Dale menggunakan JSON sebagai format data yang diambil atapun error yang akan diterima saat terjadi kesalahan, hal ini bertujuan untuk memudahkan integrasi

## Cara Menggunakan kelas
```shell
include 'dale.php';
```

## Membuat Konstruktor
```shell
$dale = new dale();
```

## Melakukan koneksi ke basis data
```
$dale->konek_ke_database("HOST_YANG_AKAN_DITUJU", "NAMA_BASIS_DATA","USERNAME_BASIS_DATA","PASSWORD_BASIS_DATA");
```

### Melakukan Kueri
Kueri dapat dilakukan dengan mudah cukup ketik : Contohnya untuk mengambil data dari tabel 'customer'
```shell
$dale->kueri("SELECT * FROM `CUSTOMER`");
echo $dale;
```

That's all, easy right?




