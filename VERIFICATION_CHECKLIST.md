# ✅ VERIFICATION CHECKLIST

Gunakan checklist ini untuk verify setiap part dari aplikasi sudah bekerja dengan baik.

---

## 🔍 Pre-Launch Checks

### Database Connection
- [ ] Database `kependudukanraka_db` ada
- [ ] Table `warga` sudah ter-create
- [ ] Ada 4 dummy data di table
- [ ] Migration status: "Batch 1" untuk semua migrations

**Command:**
```bash
cd c:\laragon\www\kependudukanraka
php artisan migrate:status
php artisan tinker
>>> App\Models\Warga::count()
>>> App\Models\Warga::first()
```

---

## 🎨 Frontend Checks

### Homepage (Index)
- [ ] Sidebar muncul dengan menu
- [ ] Tabel data warga muncul
- [ ] Ada 4 data di tabel
- [ ] Pagination controls muncul
- [ ] Search box ada dan berfungsi
- [ ] Tombol "Add" ada

**URL:** `http://kependudukanraka.test`

### Add Data Form
- [ ] Form muncul dengan semua fields
- [ ] Fields: NIK, No KK, Nama, Alamat, RT, RW, Jenis Kelamin, Tempat Lahir, Tanggal Lahir, No Telp, Agama
- [ ] Button "Simpan" dan "Batal" ada
- [ ] Form dapat diisi

**URL:** `http://kependudukanraka.test/warga/create`

### Edit Data Form
- [ ] Form muncul dengan data yang di-select
- [ ] Semua field ter-populate dengan nilai lama
- [ ] Button "Perbarui" dan "Batal" ada

**URL:** `http://kependudukanraka.test/warga/{id}/edit`

---

## ✨ Feature Tests

### CREATE (Tambah Data)

**Test Case 1: Valid Data**
```
NIK: 1234567890123456
No KK: 6543210987654321
Nama: Test User
Alamat: Jl. Test No 1
RT: 1
RW: 1
Jenis Kelamin: Laki-laki
Tempat Lahir: Bandung
Tanggal Lahir: 1990-01-01
No Telp: 081234567890
Agama: Islam
```
- [ ] Form berhasil di-submit
- [ ] Success message muncul: "✅ Data warga berhasil ditambahkan"
- [ ] Redirect ke halaman list
- [ ] Data baru ada di list

**Test Case 2: Duplicate NIK**
- [ ] Coba input dengan NIK yang sudah ada
- [ ] Error message muncul: "nik has already been taken"
- [ ] Form tetap di halaman create dengan data yang diisi

**Test Case 3: Invalid Date**
- [ ] Coba input tanggal di masa depan
- [ ] Error message muncul
- [ ] Form tetap di halaman create

**Test Case 4: Invalid Agama**
- [ ] Coba submit dengan agama yang tidak sesuai
- [ ] Error message muncul
- [ ] Form tetap di halaman create

### READ (Lihat Data)

- [ ] Semua data muncul di list
- [ ] Pagination berfungsi (show 10 entries)
- [ ] Row count "Showing 1 to X of Y entries" benar
- [ ] Search box berfungsi (search by name atau NIK)
- [ ] Table columns: No, NIK, No KK, Nama, Alamat, RT, RW, Jenis Kelamin, Tempat/Tgl, No Telp, Agama, Aksi

### UPDATE (Edit Data)

**Test Case 1: Valid Update**
- [ ] Klik edit pada satu data
- [ ] Form muncul dengan data lama
- [ ] Ubah satu field (e.g., nama)
- [ ] Klik "Perbarui"
- [ ] Success message muncul: "✅ Data warga berhasil diperbarui"
- [ ] Data di list sudah update

**Test Case 2: Duplicate NIK on Update**
- [ ] Coba ubah NIK dengan NIK yang sudah ada (dari data lain)
- [ ] Error message muncul
- [ ] Form tetap di halaman edit dengan data yang diisi

### DELETE (Hapus Data)

**Test Case 1: Delete with Confirm**
- [ ] Klik delete pada satu data
- [ ] Modal confirm muncul: "Apakah Anda yakin ingin menghapus data warga ini?"
- [ ] Klik "Hapus"
- [ ] Success message muncul: "✅ Data warga berhasil dihapus"
- [ ] Data hilang dari list

**Test Case 2: Cancel Delete**
- [ ] Klik delete pada satu data
- [ ] Modal confirm muncul
- [ ] Klik "Batal"
- [ ] Modal tutup
- [ ] Data tetap ada di list

---

## 🔒 Validation Tests

### NIK Validation
- [ ] Reject: kosong
- [ ] Reject: lebih dari 16 digit
- [ ] Reject: kurang dari 16 digit
- [ ] Reject: duplicate (sudah ada)
- [ ] Accept: 16 digit, unique

### No KK Validation
- [ ] Reject: kosong
- [ ] Reject: lebih dari 16 digit
- [ ] Reject: kurang dari 16 digit
- [ ] Reject: duplicate (sudah ada)
- [ ] Accept: 16 digit, unique

### Tanggal Lahir Validation
- [ ] Reject: kosong
- [ ] Reject: format salah
- [ ] Reject: tanggal di masa depan
- [ ] Accept: valid date di masa lalu

### Agama Validation
- [ ] Reject: kosong
- [ ] Reject: nilai yang tidak tersedia
- [ ] Accept: "Islam"
- [ ] Accept: "Kristen"
- [ ] Accept: "Hindu"
- [ ] Accept: "Buddha"
- [ ] Accept: "Kong Hu Cu"

---

## 💻 Browser Compatibility

- [ ] Chrome/Edge (latest)
- [ ] Firefox (latest)
- [ ] Mobile responsive (check with mobile browser)

---

## 📊 Performance Tests

### Load Time
- [ ] Index page loads dalam < 2 detik
- [ ] Create form loads dalam < 1 detik
- [ ] Edit form loads dalam < 1 detik
- [ ] Search results filter instantly

### Large Dataset (Optional)
- [ ] Add 100+ data
- [ ] Pagination still works
- [ ] Search still responsive
- [ ] No timeout errors

---

## 🐛 Error Handling Tests

### 404 Errors
- [ ] Try access non-existent ID: `/warga/999999`
- [ ] Should show 404 error or redirect

### Database Errors
- [ ] Check `storage/logs/laravel.log` for any errors
- [ ] No PHP errors di console
- [ ] No JavaScript errors di browser console

### Form Submission Errors
- [ ] Submit form dengan browser developer tools open
- [ ] Check Network tab - should POST successfully
- [ ] Check Response - should be redirect to index

---

## 🔄 Cache & Session Tests

- [ ] Clear cache: `php artisan cache:clear`
- [ ] App still works after cache clear
- [ ] Session works (success message persists on redirect)
- [ ] No "Compiled view not found" errors

---

## 📝 Documentation Check

- [ ] README_INDONESIA.md ada
- [ ] LARAGON_SETUP.md ada
- [ ] FINAL_STATUS.md ada
- [ ] setup.bat ada di Laragon folder
- [ ] Dokumentasi mudah dipahami

---

## 🎯 Final Verification

### Overall Checks
- [ ] No console errors (F12 → Console)
- [ ] No network errors (F12 → Network)
- [ ] No missing images/assets
- [ ] Styling consistent (same font, colors, layout)
- [ ] All links working
- [ ] All buttons clickable

### Database Integrity
- [ ] Run: `php artisan migrate:status` → all "Batch"
- [ ] Run: `php artisan db:seed` → no errors
- [ ] Data persists after page refresh
- [ ] Transactions working (data saved correctly)

### Security
- [ ] CSRF token in forms (check page source)
- [ ] SQL injection prevention (input sanitized)
- [ ] XSS prevention (no script tags in output)
- [ ] Unique constraints enforced

---

## ✅ Sign-Off

**Date Tested:** _______________

**Tester Name:** _______________

**All Tests Passed:** ☐ YES ☐ NO

**Notes / Issues Found:**
```
_________________________________
_________________________________
_________________________________
```

**Status:** 
- ✅ READY TO DEPLOY
- ⚠️ NEEDS FIXES
- ❌ BLOCKED

---

## 📞 Troubleshooting Reference

If test fails, check:

1. **Database connection**: `php artisan tinker` → `DB::connection()->getPdo()`
2. **Table exists**: `SHOW TABLES LIKE 'warga';`
3. **Model binding**: `php artisan tinker` → `App\Models\Warga::all()`
4. **Validation**: Check `app/Http/Controllers/WargaController.php`
5. **Routes**: `php artisan route:list`
6. **Views**: Check `resources/views/warga/`

---

Good luck! 🚀
