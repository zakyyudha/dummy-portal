# Dummy Portal

Repositori ini digunakan untuk kebutuhan satuan kerja mencoba mengimplementasikan single sign on pada setiap layanan

## Installation

### Requirement
Untuk menggunakan repo ini, server anda harus mendukung:
- PHP 5.5.9 or greater
- PHP LDAP Extension
- An LDAP Server

### Installing
- Clone repository ini
- Jalankan perintah `$ composer install`
- Setelah selesai jalankan perintah

```
$ cp config/example.ldap.php config/ldap.php
$ cp config/example.preauth.php config/preauth.php
```

- Sesuaikan file konfigurasi `ldap.php` dan `preauth.php` dengan server anda