// tutup modal bootstrap
$(".reloadpage").on("hide.bs.modal", function (event) {
  window.location.reload();
});

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

// tambah data anggota
$("#btn-tambah-jenistransaksi").on("click", function () {
  kode_trx = $("#kode_trx").val();
  nama_trx = $("#nama_trx").val();
  jenis_trx = $("#jenis_trx").val();
  periode_trx = $("#periode_trx").val();
  nominal_trx = $("#nominal_trx").val();

  if (!(kode_trx && nama_trx && jenis_trx && periode_trx)) {
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
      jenis_trx,
      periode_trx,
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
