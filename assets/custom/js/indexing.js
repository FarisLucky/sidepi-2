// Doc Ready
$(function () {
  inputPaste("input[name='auth_pass']");
  const error = $(".flash-data").attr("flash-error");
  const success = $(".flash-data").attr("flash-success");
  const failed = $(".flash-data").attr("flash-failed");
  const csrf_name = $(".token").attr("data-nama");
  const csrf_value = $(".token").attr("data-class");
  if (!!error) {
    toastr.error(error);
  }
  if (!!success) {
    Swal({
      title: "Sukses",
      text: success,
      type: "success"
    });
  }
  if (!!failed) {
    Swal({
      title: "Gagal",
      text: failed,
      type: "error"
    });
  }

  // Properti Controller Javascript
  $(document).on("change", "#detail_property input[name='foto']", function (e) {
    e.preventDefault();
    readURL(this, "#detail_property img#foto_properti");
  });
  $(document).on("change", "#tambah_property input[name='foto']", function (e) {
    e.preventDefault();
    readURL(this, "#tambah_property img#foto_properti");
  });

  if ($("textarea[name='txt_spr']").length > 0) {
    CKEDITOR.replace("txt_spr");
  }

  // Transaksi Controller
  let kesepakatan = document.getElementById("txt_kesepakatan");
  let tanda_jadi = document.getElementById("txt_tanda_jadi");
  if (kesepakatan != null) {
    kesepakatan.addEventListener("keyup", function (e) {
      kesepakatan.value = formatRupiah(this.value, "Rp. ");
    });
  }
  if (tanda_jadi != null) {
    tanda_jadi.addEventListener("keyup", function (e) {
      tanda_jadi.value = formatRupiah(this.value, "Rp. ");
    });
  }
  $("#select_konsumen").change(function (e) {
    e.preventDefault();
    let id = $(this).val();
    if (id == "") {
      $("input[name='txt_card']").val("");
      $("input[name='txt_telp']").val("");
      $("input[name='txt_email']").val("");
      $("input[name='txt_alamat']").val("");
    } else {
      ajaxReq(
        "POST",
        "datakonsumen", {
          id,
          id_tkn: csrf_value
        },
        function (response) {
          if (response.success == true) {
            $("input[name='txt_card']").val(response.obj.id_card);
            $("input[name='txt_telp']").val(response.obj.telp);
            $("input[name='txt_email']").val(response.obj.email);
            $("input[name='txt_alamat']").val(response.obj.alamat);
          }
        }
      );
    }
  });

  $('.alasan').click(function (e) { 
    e.preventDefault();
    let data = $(this).attr('data-id');
    ajaxReq(
      "POST",
      base+"transaksi/datatolak", {
        data,
        id_tkn: csrf_value
      },
      function (response) {
        if (response.status == true) {
          $('#modal .body-modal').html(response.data.deskripsi_tolak);
          $('#modal').modal('show');
        }
      }
    );
  });
  $("#select_konsumen").change(function (e) {
    e.preventDefault();
    let id = $(this).val();
    if (id == "") {
      $("input[name='txt_card']").val("");
      $("input[name='txt_telp']").val("");
      $("input[name='txt_email']").val("");
      $("input[name='txt_alamat']").val("");
    } else {
      ajaxReq(
        "POST",
        "datakonsumen", {
          id,
          id_tkn: csrf_value
        },
        function (response) {
          if (response.success == true) {
            $("input[name='txt_card']").val(response.obj.id_card);
            $("input[name='txt_telp']").val(response.obj.telp);
            $("input[name='txt_email']").val(response.obj.email);
            $("input[name='txt_alamat']").val(response.obj.alamat);
          }
        }
      );
    }
  });

  $("#select_unit").change(function (e) {
    e.preventDefault();
    let id = $(this).val();
    if (id == "") {
      $("input[name='txt_deskripsi']").val("");
      $("input[name='txt_type']").val("");
      $("input[name='txt_tanah']").val("");
      $("input[name='txt_bangunan']").val("");
      $("input[name='txt_harga']").val("");
    } else {
      ajaxReq(
        "POST",
        "dataunit", {
          id,
          id_tkn: csrf_value
        },
        function (response) {
          if (response.success == true) {
            $("input[name='txt_deskripsi']").val(response.obj.deskripsi);
            $("input[name='txt_type']").val(response.obj.type);
            $("input[name='txt_tanah']").val(response.obj.luas_tanah);
            $("input[name='txt_bangunan']").val(response.obj.luas_bangunan);
            $("input[name='txt_harga']").val(response.harga);
          }
        }
      );
    }
  });

  $("#periode_Um").change(function (e) {
    e.preventDefault();
    let id = $(this).val();
    if ($('.text-uang-muka').length > 0) {
      $('.text-uang-muka').remove();
    }
    $(".angsuran_periode").remove();
    let form = '<div class="row angsuran_periode">';
    for (let index = 1; index <= id; index++) {
      form +=
        '<div class="col-md-3 col-sm-4"><div class="form-group"><label for="txt_uang_muka">Angsuran ' +
        index +
        '</label><input type="number" name="txt_angsuran[]" class="form-control txt_angsuran_change" required></div></div>';
    }
    form += "</div>";
    $(".periode_row").after(form);
  });

  $("#txt_type_pembayaran").change(function (e) {
    e.preventDefault();
    let id = $(this).val();
    $(".val_periode").remove();
    let form = "";
    if (id == "1" || id == "3") {
      form +=
        '<div class="col-md-3 col-sm-12 val_periode"><div class="form-group"><label for="periode_bayar">Periode Bayar(Bulan)</label><input type="number" name="periode_bayar" class="form-control" id="periode_bayar" required></div></div><div class="col-sm-3 val_periode"></div>';
    }
    $(".bayar").after(form);
  });

  $("#lock_kesepakatan").on("click", function (e) {
    e.preventDefault();
    let harga;
    let kesepakatans = String($("#txt_kesepakatan").val());
    toastr.remove();
    if ($("#txt_kesepakatan").val() == "") {
      toastr.warning("masukkan Kesepakatan");
      $("#txt_kesepakatan").val("");
      return;
    } else if (
      $("#select_unit").val() == "" ||
      $("#select_konsumen").val() == ""
    ) {
      toastr.warning("Isi Data diatas");
      return;
    }
    $("#txt_ttl_transaksi,#txt_ttl_akhir").val(kesepakatans);
    $("#txt_kesepakatan").attr("readonly", true);
    $(this).addClass("locked");
    $(this).attr("disabled", true);
  });
  $("#lock_tanda_jadi").on("click", function (e) {
    e.preventDefault();
    let radio = $("input[name='radio_tj']:checked");
    let tanda_jadi = $("#txt_tanda_jadi").val();
    if ($("button.locked").length < 1) {
      toastr.remove();
      toastr.error("Kesepakatan belum di kunci");
      return false;
    } else if (tanda_jadi == "") {
      toastr.remove();
      toastr.warning("Masukkan Tanda Jadi");
      return false;
    } else if (radio.length < 1) {
      toastr.remove();
      toastr.warning("Pilih Tanda Jadi");
      return false;
    }
    let hasil;
    let parseTanda = parseInt(tanda_jadi.split(".").join(""));
    let ttl_sementara = parseInt(
      $("#txt_ttl_transaksi")
      .val()
      .split(".")
      .join("")
    );
    if (radio.val() == "masuk") {
      hasil = parseInt(ttl_sementara - parseTanda);
      $("#txt_ttl_akhir").val(formatRupiah(String(hasil), "Rp. "));
    } else {
      hasil = ttl_sementara;
      $("#txt_ttl_akhir").val(formatRupiah(String(hasil), "Rp. "));
    }
    $(this).attr("disabled", true);
    $(this).addClass("locked_tanda_jadi");
    $("#txt_tanda_jadi").attr("readonly", true);
    $("input[name='radio_tj']").attr("readonly", true);
  });
  $("#lock_uang_muka").on("click", function () {
    let total = 0;
    if (
      $("button.locked").length < 1 ||
      $("button.locked_tanda_jadi").length < 1
    ) {
      toastr.remove();
      toastr.error("Kesepakatan atau Tanda Jadi Belum di kunci");
      return false;
    } else if ($("input[name='txt_angsuran[]']").val() == "") {
      toastr.remove();
      toastr.warning("Masukkan Uang Muka");
      return false;
    }
    $("input[name='txt_angsuran[]']").each(function () {
      total += Number($(this).val());
    });
    $("#txt_uang_muka").val(formatRupiah(String(total), "Rp. "));
    let ttl = $("#txt_ttl_akhir")
      .val()
      .split(".")
      .join("");
    let value = ttl - total;
    $("#txt_ttl_akhir").val(formatRupiah(String(value), "Rp. "));
    $("input[name='txt_angsuran[]']").attr("readonly", true);
    $("input[name='periode_Um']").attr("readonly", true);
    $(this).attr("disabled", true);
    $(this).addClass("locked_uang_muka");
  });
  $("#lock_type_bayar").on("click", function (e) {
    e.preventDefault();
    let ttl_akhir = parseInt(
      $("#txt_ttl_akhir")
      .val()
      .split(".")
      .join("")
    );
    let cicilan;
    let value = parseInt($("#periode_bayar").val());
    let type = $("#txt_type_pembayaran").val();
    if ($("button.locked_tanda_jadi").length < 1) {
      toastr.remove();
      toastr.error("Tanda Jadi belum di kunci");
      return false;
    } else if (type == "") {
      toastr.remove();
      toastr.warning("Pilih Type");
      return false;
    }
    if (type == "1") {
      cicilan = parseInt(ttl_akhir / value);
    } else {
      cicilan = ttl_akhir;
    }
    $("#total_bayar_periode").val(formatRupiah(String(cicilan), "Rp. "));
    $(this).attr("disabled", true);
    if ($(".locked_uang_muka").length < 1) {
      $("#lock_uang_muka").attr("disabled", true);
    }
    $(this).addClass("locked_type_bayar");
    $("#periode_bayar").attr("readonly", true);
    $("#txt_type_pembayaran").attr("readonly", true);
    $("button.simpan").attr('disabled', false);
  });
  $("#search_form").on("submit", function (e) {
    e.preventDefault();
    let url = $(this).attr("action");
    let input = $("select[name='pilih_unit']").val();
    $("#tbl_um")
      .DataTable()
      .destroy();
    dataTables("#tbl_um", url, {
      id_tkn: csrf_value,
      id_jenis: 2,
      pilih_unit: input
    });
  });
  $("#search_form").on("submit", function (e) {
    e.preventDefault();
    let url = $(this).attr("action");
    let input = $("select[name='pilih_unit']").val();
    $("#tbl_cicilan")
      .DataTable()
      .destroy();
    dataTables("#tbl_cicilan", url, {
      id_tkn: csrf_value,
      id_jenis: 3,
      pilih_unit: input
    });
  });
  // end Js Pembayaran
  $('#upload_file').click(function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    $("form#modal_user").attr('action', base + 'konsumen/coretambahfile');
    // $("form#modal_user").attr('enctype', 'multipart/form-data');
    $("#modal_user input[name='input_hidden']").val(id);
    let html = '<div class="form-group"><label>Upload File</label><input type="file" class="form-control" name="file_upload"></div><div class="form-group"><button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button></div>';
    $("#form_change").html(html);
    $("#modal_doc").modal("show");
  });
  $("#file_unit").click(function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    $("form#modal_user").attr('action', base + 'persyaratanunit/coretambahfile');
    // $("form#modal_user").attr('enctype', 'multipart/form-data');
    $("#modal_user input[name='input_hidden']").val(id);
    let html = '<div class="form-group"><label>Upload File</label><input type="file" class="form-control" name="file_upload"></div><div class="form-group"><button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button></div>';
    $("#form_change").html(html);
    $("#modal_doc").modal("show");
  });

  $('.next').click(function () {
    $('.nav-tabs .nav-item .active').parent().next().find('a').click();
  });
  $('.prev').click(function () {
    $('.nav-tabs .nav-item .active').parent().prev().find('a').trigger('click');
  });
  
  $('#batal').click(function (e) { 
    e.preventDefault();
    Swal({
      title: "Tanyakan",
      text: "apakah ingin membatalkan Pengeluaran ?",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#00ce68",
      cancelButtonColor: "#e65251",
      confirmButtonText: "Oke"
    }).then(result => {
      if (result.value) {
        window.location = url;
      }
    });
  });
  
  $('.modal_tolak').on('click',function (e) { 
    e.preventDefault();
    let data = $(this).attr('data-id');
      if (data !== '') {
        $('#modal #input_hidden').val(data);
        $('#modal').modal('show');
    }
  });
  $('.alasan_di_history').click(function (e) { 
    e.preventDefault();
    let data = $(this).attr('data-id');
    ajaxReq(
      "POST",
      base+"pembayaran/datatolak", {
        data,
        id_tkn: csrf_value
      },
      function (response) {
        if (response.status == true) {
          $('#modal_history .body-modal').html(response.data.deskripsi_tolak);
          $('#modal_history').modal('show');
        }
      }
    );
  });
  $('.alasan_pengeluaran').click(function (e) { 
    e.preventDefault();
    let data = $(this).attr('data-id');
    ajaxReq(
      "POST",
      base+"pengeluaran/datatolak", {
        data,
        id_tkn: csrf_value
      },
      function (response) {
        if (response.status == true) {
          $('#modal_history .body-modal').html(response.data.deskripsi_tolak);
          $('#modal_history').modal('show');
        }
      }
    );
  });
  $('.alasan_kartu_kontrol').click(function (e) { 
    e.preventDefault();
    let data = $(this).attr('data-id');
    ajaxReq(
      "POST",
      base+"kartukontrol/datatolak", {
        data,
        id_tkn: csrf_value
      },
      function (response) {
        if (response.status == true) {
          $('#modal_kontrol .body-modal').html(response.data.deskripsi_tolak);
          $('#modal_kontrol').modal('show');
        }
      }
    );
  });
});

// All Function
function ajaxReq(types, urls, datas, functions) {
  $(".overlay").show();
  $.ajax({
    type: types,
    url: urls,
    data: datas,
    dataType: "JSON",
    success: function (response) {
      if (typeof functions) {
        functions(response);
      }
    },
    complete: function () {
      $(".overlay").hide();
    }
  });
}

function deleteItem(url) {
  Swal({
    title: "Tanyakan",
    text: "hapus data ?",
    type: "question",
    showCancelButton: true,
    confirmButtonColor: "#00ce68",
    cancelButtonColor: "#e65251",
    confirmButtonText: "Hapus"
  }).then(result => {
    if (result.value) {
      window.location = url;
    }
  });
}

function setItem(url, confirm) {
  Swal({
    title: "Tanyakan",
    text: confirm + " data ?",
    type: "question",
    showCancelButton: true,
    confirmButtonColor: "#00ce68",
    cancelButtonColor: "#e65251",
    confirmButtonText: confirm
  }).then(result => {
    if (result.value) {
      window.location = url;
    }
  });
}
function submitForm(url,confirm) {
  event.preventDefault();
  Swal({
    title: "Tanyakan",
    text: confirm + " data ?",
    type: "question",
    showCancelButton: true,
    confirmButtonColor: "#00ce68",
    cancelButtonColor: "#e65251",
    confirmButtonText: confirm
  }).then(result => {
    if (result.value) {
      window.location = url;
    }
  });
}
// Modal change password kelola user
function getModal(id) {
  $("#modal_kelola input[name='input_hidden']").val(id);
  $("#modal_kelola").modal("show");
}


function ajaxMessageError(form_id, href) {
  event.preventDefault();
  let form = $(form_id).serialize();
  $.ajax({
    type: "POST",
    url: href,
    data: form,
    dataType: "JSON",
    success: function (success) {
      if (success.success === true) {
        swallSuccess("Berhasil", "Data Disimpan", "success", function () {
          location.reload();
        });
      } else {
        toastr.remove();
        $.each(success.msg, function (key, val) {
          if (val != "") {
            toastr.info(val);
          }
        });
      }
    }
  });
}

function readURL(input, selector) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $(selector).attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function validateFileUpload(input_element) {
  var fileName = input_element.value;
  var allowed_extensions = new Array("jpg", "png", "jpeg");
  var file_extension = fileName.split(".").pop();
  for (var i = 0; i < allowed_extensions.length; i++) {
    if (allowed_extensions[i] == file_extension) {
      // valid = true; // valid file extension
      return true;
    }
  }
  // el.innerHTML="Invalid file";
  toastr.info("Upload harus gambar");
  $(input_element).val("");
  return true;
}


$('#ubah_properti').click(function(e) {
  e.preventDefault();
  $("#form_detail input[name='txt_nama']").attr("readonly", false);
  $("#form_detail input[name='txt_jumlah']").attr("readonly", false);
  $("#form_detail input[name='txt_satuan']").attr("readonly", false);
  $("#form_detail input[name='txt_luas']").attr("readonly", false);
  $("#form_detail select[name='txt_rekening']").attr("readonly", false);
  $("#form_detail select[name='txt_status']").attr("readonly", false);
  $("#form_detail textarea[name='txt_alamat']").attr("readonly", false);
  $("#form_detail #foto_properti").after(
      '<input type="file" name="foto" class="form-control" onchange="validateFileUpload(this);">'
  );
  $(this).after(
      ' <button type="submit" class="btn btn-sm btn-primary mr-2"><i class="fa fa-save"></i>Simpan</button><button type="button" onClick="window.location.reload()" class="btn btn-sm btn-dark mr-2"><i class="fa fa-window-close"></i>Batal</button>'
  );
  $(this).remove();
});

$('#ubah_unit').click(function (e) {
  e.preventDefault();
  $("input[name='txt_nama']").attr("readonly", false);
  $("input[name='txt_type']").attr("readonly", false);
  $("input[name='txt_tanah']").attr("readonly", false);
  $("input[name='satuan_tanah']").attr("readonly", false);
  $("input[name='txt_bangunan']").attr("readonly", false);
  $("input[name='satuan_bangunan']").attr("readonly", false);
  $("input[name='txt_harga']").attr("readonly", false);
  $("textarea#txt_desc").attr("readonly", false);
  $("textarea#txt_alamat").attr("readonly", false);
  $("#foto_unit").after(
    '<input type="file" name="foto" multiple id="txt_logo" class="form-control">'
  );
  $(this).after(
    '<button type="submit" class="btn btn-sm btn-success mr-2">Simpan</button>'
  );
  $(this).remove();
})

function ubahPerusahaan(params) {
  event.preventDefault();
  $("#form_perusahaan input[type='text']").attr("readonly", false);
  $("#form_perusahaan input[type='email']").attr("readonly", false);
  $("#form_perusahaan input[type='number']").attr("readonly", false);
  $("#form_perusahaan textarea").attr("readonly", false);
  $("#form_perusahaan #logo_perusahaan").after(
    '<input type="file" name="image" id="txt_img" class="form-control">'
  );
  $(params).after(
    '<button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i>Simpan</button>'
  );
  $(params).remove();
}

function inputPaste(selector) {
  $(selector).on("paste", function (e) {
    e.preventDefault();
    return false;
  });
}

function rabProperti(params, rab) {
  event.preventDefault();
  let id = $(params).attr("data-id");
  $("#modal_dialog input[name='properti']").val(id);
  $("#modal_dialog input[name='rab']").val(rab);
  $("#modal_dialog").modal("show");
}

function showPass(selector, selector2) {
  let attr = document.getElementById(selector2);
  if ($(selector).is(":checked")) {
    attr.setAttribute("type", "text");
  } else {
    attr.setAttribute("type", "password");
  }
}

function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? rupiah : "";
}

function changeData(type, url, selector, place) {
  event.preventDefault();
  let id_properti = $(selector).val();
  ajaxReq(
    type,
    url, {
      id_properti
    },
    function (response) {
      $(place).html(response.html);
    }
  );
}

// Change Element
function changeElement(params, type, url, csrf, replace) {
  event.preventDefault();
  let params1 = $(params).val();
  let csrf_value = csrf;
  ajaxReq(
    type,
    url, {
      id_tkn: csrf_value,
      params1
    },
    function (response) {
      $(replace).html(response.html);
    }
  );
}

// Search Data
function searchData(params, csrf, table, url) {
  event.preventDefault();
  let data = {
    id_tkn: csrf
  };
  $.each(params, function (i, v) {
    data[v] = document.getElementById(v).value;
  });
  $(table)
    .DataTable()
    .destroy();
  dataTables(table, url, data);
}

function nextTab(elem) {
  elem.next().find('a[data-toggle="tab"]').click();
}

function nextTab(elem) {
  $(elem).prev().find('a[data-toggle="tab"]').click();
}

function updateData(params) {
  event.preventDefault();
  let id = document.getElementById(params).value;
  if (id != '') {
    $.ajax({
      type: "POST",
      url: base+"laporanunit/getjumlah/",
      data: {id,id_tkn: csrf_val},
      dataType: "JSON",
      success: function (response) {
        $('#ttl').html(response.ttl.total);
        $('#bt').html(response.bt.bt);
        $('#b').html(response.b.b);
        $('#t').html(response.t.t);
      }
    });
  }
}
function updateTransaksi(params) {
  event.preventDefault();
  let id = document.getElementById(params).value;
  if (id != '') {
    $.ajax({
      type: "POST",
      url: base+"listtransaksi/getjumlah/",
      data: {id,id_tkn: csrf_val},
      dataType: "JSON",
      success: function (response) {
        $('#s').html(response.s.s);
        $('#p').html(response.p.p);
        $('#sl').html(response.sl.sl);
      }
    });
  }
}