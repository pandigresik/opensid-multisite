# opensid-multisite

Satu opensid untuk banyak desa

Berikut cara setting sederhana satu aplikasi opensid untuk beberapa desa sekaligus. Disini saya menggunakan OS Ubuntu 20.10, web server apache dan php versi 7.4.9

# langkah - langkahnya sebagai berikut :

- buat database untuk masing2 desa,
- setting koneksi untuk masing2 desa di sites-desa/{nama_desa}/desa/config/database.php
- membuat virtual host di apache untuk masing - masing desa
- test menjalankan aplikasi

# Berikut ini file Opensid yang harus disesuaikan

- assets/filemanager/config/config.php
- assets/filemanager/dialog.php
- assets/filemanager/init.php
- donjo-app/helpers/opensid_helper.php

# Versi Opensid

- v22.06
