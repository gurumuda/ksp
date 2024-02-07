// tutup modal bootstrap
$(".reloadpage").on("hide.bs.modal", function (event) {
  window.location.reload();
});

/**
 * Halaman Admin Data Anggota
 */
// tambah data anggota
$("#btn-tambah-anggota").on("click", function () {
  username = $("#username").val();
  password = $("#password").val();
  nama = $("#nama").val();
  tmp_lahir = $("#tmp_lahir").val();
  tgl_lahir = $("#tgl_lahir").val();
  alamat = $("#alamat").val();
  no_hp = $("#no_hp").val();
  jenis_kelamin = $("#jenis_kelamin").val();
  simp_pokok = $("#simp_pokok").val();

  if (!(username && password && nama && jenis_kelamin)) {
    toastr.error("Data anggota gagal ditambah, data tidak lengkap.");
    return false;
  }
  $.ajax({
    url: "/tambah/anggota",
    type: "POST",
    headers: { "X-Requested-With": "XMLHttpRequest" },
    data: {
      username,
      password,
      nama,
      tmp_lahir,
      tgl_lahir,
      jenis_kelamin,
      alamat,
      no_hp,
      simp_pokok,
    },
    success: function (data) {
      //   console.log(data);
      if (data == "1") {
        toastr.success("Data anggota berhasil ditambah.");
      }
      if (data == "0") {
        toastr.error("Data anggota gagal ditambah, ada kesalahan sistem.");
      }
      if (data == "2") {
        toastr.error("Data anggota gagal ditambah, ada duplikasi username.");
      }
    },
    error: function (e) {
      console.log(e);
    },
  });
});
// hapus data anggota
$("#example2").on("click", ".btn-hapus-anggota", function () {
  id = $(this).data("id");
  nama = $(this).data("nama");
  whichtr = $(this).closest("tr");

  Swal.fire({
    title: "Konfirmasi hapus data !",
    text: "Anda akan menghapus data " + nama,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus !",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/hapus/anggota",
        type: "POST",
        headers: { "X-Requested-With": "XMLHttpRequest" },
        data: { id },
        success: function (data) {
          //   console.log(data);
          if (data == "1") {
            toastr.success("Data anggota berhasil dihapus.");
            whichtr.remove();
          }
          if (data == "0") {
            toastr.error("Data anggota gagal dihapus, ada kesalahan sistem.");
          }
        },
        error: function (e) {
          console.log(e);
        },
      });
    }
  });
});
// ubah data anggota
$("#example2").on("click", ".btn-ubah-anggota", function () {
  id = $(this).data("id");
  nama = $(this).data("nama");

  $.ajax({
    url: "/ambil/anggota",
    type: "POST",
    headers: { "X-Requested-With": "XMLHttpRequest" },
    data: { id },
    dataType: "json",
    success: function (data) {
      console.log(data);
      $("#modal-ubah").modal("show");
      $("#id_anggota").val(data.anggota_id);
      $("#ubah_username").val(data.username);
      $("#ubah_nama").val(data.nama);
      $("#ubah_tmp_lahir").val(data.tmp_lahir);
      $("#ubah_tgl_lahir").val(data.tgl_lahir);
      $("#ubah_alamat").val(data.alamat);
      $("#ubah_no_hp").val(data.no_hp);
      $("#ubah_jenis_kelamin").val(data.jenis_kelamin);
    },
    error: function (e) {
      console.log(e);
    },
  });
});
$("#btn-ubah-anggota").on("click", function () {
  id_anggota = $("#id_anggota").val();
  username = $("#ubah_username").val();
  password = $("#ubah_password").val();
  nama = $("#ubah_nama").val();
  tmp_lahir = $("#ubah_tmp_lahir").val();
  tgl_lahir = $("#ubah_tgl_lahir").val();
  alamat = $("#ubah_alamat").val();
  no_hp = $("#ubah_no_hp").val();
  jenis_kelamin = $("#ubah_jenis_kelamin").val();

  if (!(username && nama && jenis_kelamin)) {
    toastr.error("Data anggota gagal diubah, data tidak lengkap.");
    return false;
  }
  $.ajax({
    url: "/ubah/anggota",
    type: "POST",
    headers: { "X-Requested-With": "XMLHttpRequest" },
    data: {
      id_anggota,
      username,
      password,
      nama,
      tmp_lahir,
      tgl_lahir,
      jenis_kelamin,
      alamat,
      no_hp,
    },
    success: function (data) {
      //   console.log(data);
      if (data == "1") {
        toastr.success("Data anggota berhasil diubah.");
      }
      if (data == "0") {
        toastr.error("Data anggota gagal diubah, ada kesalahan sistem.");
      }
      if (data == "2") {
        toastr.error("Data anggota gagal diubah, ada duplikasi username.");
      }
    },
    error: function (e) {
      console.log(e);
    },
  });
});

/**
 * Halaman Admin Data Jenis Transaksi
 */
// tambah data jenis transaksi
$("#btn-tambah-jenistransaksi").on("click", function () {
  kode_trx = $("#kode_trx").val();
  nama_trx = $("#nama_trx").val();
  periode_trx = $("#periode_trx").val();
  jenis_trx = $("#jenis_trx").val();
  nominal_trx = $("#nominal_trx").val();

  if (!(kode_trx && nama_trx && periode_trx && jenis_trx)) {
    toastr.error("Data anggota gagal ditambah, data tidak lengkap.");
    return false;
  }
  $.ajax({
    url: "/tambah/jenistransaksi",
    type: "POST",
    headers: { "X-Requested-With": "XMLHttpRequest" },
    data: {
      kode_trx,
      nama_trx,
      periode_trx,
      jenis_trx,
      nominal_trx,
    },
    success: function (data) {
      //   console.log(data);
      if (data == "1") {
        toastr.success("Data transaksi berhasil ditambah.");
      }
      if (data == "0") {
        toastr.error("Data transaksi gagal ditambah, ada kesalahan sistem.");
      }
      if (data == "2") {
        toastr.error(
          "Data transaksi gagal ditambah, ada duplikasi kode transaksi."
        );
      }
    },
    error: function (e) {
      console.log(e);
    },
  });
});
// hapus data jenis transaksi
$("#example2").on("click", ".btn-hapus-jenistransaksi", function () {
  id = $(this).data("id");
  nama = $(this).data("nama");
  whichtr = $(this).closest("tr");

  Swal.fire({
    title: "Konfirmasi hapus data !",
    text: "Anda akan menghapus data " + nama,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus !",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/hapus/jenistransaksi",
        type: "POST",
        headers: { "X-Requested-With": "XMLHttpRequest" },
        data: { id },
        success: function (data) {
          //   console.log(data);
          if (data == "1") {
            toastr.success("Data jenis transaksi berhasil dihapus.");
            whichtr.remove();
          }
          if (data == "0") {
            toastr.error(
              "Data jenis transaksi gagal dihapus, ada kesalahan sistem."
            );
          }
        },
        error: function (e) {
          console.log(e);
        },
      });
    }
  });
});
// ubah data jenis transaksi
$("#example2").on("click", ".btn-ubah-jenistransaksi", function () {
  id = $(this).data("id");
  nama = $(this).data("nama");

  $.ajax({
    url: "/ambil/jenistransaksi",
    type: "POST",
    headers: { "X-Requested-With": "XMLHttpRequest" },
    data: { id },
    dataType: "json",
    success: function (data) {
      console.log(data);
      $("#modal-ubah").modal("show");
      $("#jenistransaksi_id").val(data.jenistransaksi_id);
      $("#ubah_kode_trx").val(data.kode_trx);
      $("#ubah_nama_trx").val(data.nama_trx);
      $("#ubah_periode_trx").val(data.periode_trx);
      $("#ubah_jenis_trx").val(data.jenis_trx);
      $("#ubah_nominal_trx").val(data.nominal_trx);
    },
    error: function (e) {
      console.log(e);
    },
  });
});
// ubah data jenis transaksi
$("#btn-ubah-jenistransaksi").on("click", function () {
  jenistransaksi_id = $("#jenistransaksi_id").val();
  kode_trx = $("#ubah_kode_trx").val();
  nama_trx = $("#ubah_nama_trx").val();
  periode_trx = $("#ubah_periode_trx").val();
  jenis_trx = $("#ubah_jenis_trx").val();
  nominal_trx = $("#ubah_nominal_trx").val();

  if (!(kode_trx && nama_trx && jenis_trx)) {
    toastr.error("Data anggota gagal diubah, data tidak lengkap.");
    return false;
  }
  $.ajax({
    url: "/ubah/jenistransaksi",
    type: "POST",
    headers: { "X-Requested-With": "XMLHttpRequest" },
    data: {
      jenistransaksi_id,
      kode_trx,
      nama_trx,
      periode_trx,
      jenis_trx,
      nominal_trx,
    },
    success: function (data) {
      //   console.log(data);
      if (data == "1") {
        toastr.success("Data transaksi berhasil diubah.");
      }
      if (data == "0") {
        toastr.error("Data transaksi gagal diubah, ada kesalahan sistem.");
      }
      if (data == "2") {
        toastr.error(
          "Data transaksi gagal diubah, ada duplikasi kode transaksi."
        );
      }
    },
    error: function (e) {
      console.log(e);
    },
  });
});

/**
 * Halaman Admin Transaksi Debet
 */
// Ambil Data Anggota dan Jenis Transaksi
$("#dataAnggotaKoperasi").on("change", function () {
  anggota_id = $(this).val();

  $.ajax({
    url: "/ambil/transaksiDebet",
    type: "POST",
    headers: { "X-Requested-With": "XMLHttpRequest" },
    dataType: "json",
    data: { anggota_id },
    success: function (data) {
      console.log(data);
      $("#tampil-data-anggota").show();
      $("#tampil-nama").html(data["dataAnggota"].nama);
      $("#tampil-no_hp").html(data["dataAnggota"].no_hp);
      $("#tampil-alamat").html(data["dataAnggota"].alamat);
      $("#data_pinjaman").html(data["html"]);
      $("#tampil_transaksi").html(data["html2"]);
    },
    error: function (e) {
      console.log(e);
    },
  });
});

/**
 * Halaman Admin Transaksi Kredit
 */
// Ambil Data Anggota dan Jenis Transaksi
$("#dtAnggotaKoperasi").on("change", function () {
  anggota_id = $(this).val();

  $.ajax({
    url: "/ambil/transaksiKredit",
    type: "POST",
    headers: { "X-Requested-With": "XMLHttpRequest" },
    dataType: "json",
    data: { anggota_id },
    success: function (data) {
      console.log(data);
      $("#tampil-data-anggota").show();
      $("#tampil-nama").html(data["dataAnggota"].nama);
      $("#tampil-no_hp").html(data["dataAnggota"].no_hp);
      $("#tampil-alamat").html(data["dataAnggota"].alamat);
      $("#data_pinjaman").html(data["html"]);
      $("#tampil_transaksi").html(data["html2"]);
    },
    error: function (e) {
      console.log(e);
    },
  });
});

// hapus data transaksi beban
$("#example2").on("click", ".btn-hapus-beban", function () {
  id = $(this).data("id");
  nama = $(this).data("nama");
  whichtr = $(this).closest("tr");

  Swal.fire({
    title: "Konfirmasi hapus data !",
    text: "Anda akan menghapus data " + nama,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus !",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/hapus/beban",
        type: "POST",
        headers: { "X-Requested-With": "XMLHttpRequest" },
        data: { id },
        success: function (data) {
          //   console.log(data);
          if (data == "1") {
            toastr.success("Data jenis transaksi berhasil dihapus.");
            whichtr.remove();
          }
          if (data == "0") {
            toastr.error(
              "Data jenis transaksi gagal dihapus, ada kesalahan sistem."
            );
          }
        },
        error: function (e) {
          console.log(e);
        },
      });
    }
  });
});
