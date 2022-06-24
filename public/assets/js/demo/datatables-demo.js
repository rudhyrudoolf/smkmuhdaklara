// Call the dataTables jQuery plugin
var table;
var flag;
var id = 0;
var listNasabah = [],selectedData ={};

$(document).ready(function() {
  // table = $('#tblnasabah').DataTable();
  // $('#tblnasabah').DataTable();

  NasabahTable.Init("#tblnasabah");

  GetData.Init();
  activesidebar();
});

function activesidebar()
{
    $("#sideDropdown").removeClass('collapsed');
    $("#collapseNasabah").addClass('show');
    $("#barTransaksi").removeClass('active');
    $("#barDashboard").removeClass('active');
}

$("#btnAddModal").click(function() {
    flag = 'insert';
    $("#modalNasabah").modal('show');
});

$("#savedata").click(function() {
  flag == null ? flag = "insert" : flag;

  // console.log(func.params()); return;
  $.ajax({
      type: "POST",
      url: BASE_URL+'/nasabah/save',
      data: func.params() ,
      dataType:"Json",
      beforeSend:function(){
          $("#btnsubmit").hide();
          $("#btnloading").show();
      },
      success: function(response)
      {
        $("#btnsubmit").show();
        $("#btnloading").hide();
        $("#modalNasabah").modal('hide');
          //window.location.reload();
         
          console.log(response);
          GetData.Init();
          Swal.fire({
            title: 'Success!',
            text: "Data Berhasil Di simpan",
            icon: 'success',
            position: "bottom-end",
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
              },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
              }
            // footer: '<a href="'+BASE_URL+'/mutasi'+'">Cetak Buku</a>'
          });         

      },
      error: function(errResponse)
      {
        $("#btnsubmit").show();
        $("#btnloading").hide();
        $("#modalNasabah").modal('hide');
          console.log(errResponse); 
          // if(errResponse.responseText != "")
          // {
            localStorage.setItem("error",response)
            window.location.reload(); 

            // $('#alert-text-danger').text("Data Nasabah Gagal Di Tambahkan! Trace error : "+ errResponse.responseText['message']);
            // $('#show-alert-danger').show();
          // }else
          // {
          //   $('#alert-text-danger').text("Data Nasabah Gagal Di Tambahkan! ");
          //   $('#show-alert-danger').show();
          // }
      }
    });
});

function reloadPage() {
  location.reload();        
}


$("#selectJenistab").change(function(){
  
  if(this.value != 'TS')
    $("#inputnis").prop('disabled',true);
  else
  $("#inputnis").prop('disabled',false);
});


var func = {
  clearField : function(){
    debugger
    $("#selectJenistab option:first").prop('selected',true);
    $("#inputnis").val('').prop('readonly',true);
    $("#inputnorek").val('').prop('disabled',true);
    $("#inputnama").val('').prop('readonly',false);
    $("#inputAlamat").val('').prop('readonly',false);
    $("#inputJenisKelamin option:first").prop('selected',true);
    $("#inputthnmasuk").val('').prop('readonly',false);
    $("#selectJenistab").select2({ disabled : false});
    $("#inputJenisKelamin").select2({ disabled : false})


  },
  params : function(){
    var params = {
        jt : $("select[name=txtjenistabungan]").val(),
        nis : $("#inputnis").val(),
        nama : $("#inputnama").val(),
        alamat : $("#inputAlamat").val(),
        jk : $("select[name=txtjenisKelamin]").val(),
        thMasuk : $("#inputthnmasuk").val(),
        flag : flag,
        id : id
    }

    return params;
  }
}

// $('#tblnasabah tbody').on('click', '#btnview', function () {

//   var data_row = table.row( $(this).parents('tr') ).data(); // here is the change
//   console.log(data_row);
//  $("#modalNasabah").modal('show');

//  $('#modalNasabah').on('shown.bs.modal', function() {

//    $("select[name=txtjenistabungan]").val(data_row[2]).attr('readonly',true);
//     $('#inputnis').val(data_row[1])
//     $('#inputnorek').val(data_row[4]).attr('readonly',true);
//     $('#inputnama').val(data_row[5]).attr('readonly',true);
//     $('#inputAlamat').val(data_row[6]).attr('readonly',true);
//     $("select[name=txtjenisKelamin]").val(data_row[8]).attr('readonly',true);
//     $('#inputthnmasuk').val(data_row[9]).attr('readonly',true);

//     $('#savedata').hide();

//  });

// });

// $('#tblnasabah tbody').on('click', '#btnEdit', function () {
//   flag = "update";
//   var data_row = table.row( $(this).parents('tr') ).data(); // here is the change
//   console.log(data_row);
//  $("#modalNasabah").modal('show');

//  $('#modalNasabah').on('shown.bs.modal', function() {

//    $("select[name=txtjenistabungan]").val(data_row[2]).attr('readonly',true);
//     $('#inputnis').val(data_row[1])
//     $('#inputnorek').val(data_row[4]).attr('readonly',true);
//     $('#inputnama').val(data_row[5]).attr('readonly',false);
//     $('#inputAlamat').val(data_row[6]).attr('readonly',false);
//     $("select[name=txtjenisKelamin]").val(data_row[8]).attr('readonly',false);
//     $('#inputthnmasuk').val(data_row[9]).attr('readonly',true);

   
//     id = data_row[10];
//     $('#savedata').show();
//  });

// });

$('#modalNasabah').on('hide.bs.modal', function (e) {
  if (!app.checkObj.isEmptyNullOrUndefined(e.relatedTarget)) {
      GetData.Init();
  }
});

 $('#modalNasabah').on('shown.bs.modal', function() {

  var data = selectedData;
  
  
  func.clearField();
  if(flag == 'view'){
    $("select[name=txtjenistabungan]").val(data.jtCode);
    $('#inputnis').val(data.nis).prop('disabled',true);
    $('#inputnorek').val(data.nomor_rekening).attr('readonly',true);
    $('#inputnama').val(data.Nama).attr('readonly',true);
    $('#inputAlamat').val(data.Alamat).attr('readonly',true);
    $("select[name=txtjenisKelamin]").val(data.jkCode);
    $('#inputthnmasuk').val(data.tahunMasuk).attr('readonly',true);
    $("#selectJenistab").select2({ disabled : true});
    $("#inputJenisKelamin").select2({ disabled : true});

    $('#savedata').hide();
  }else if( flag == 'update'){
    $("select[name=txtjenistabungan]").val(data.jtCode).attr('readonly',true);
    $('#inputnis').val(data.nis)
    $('#inputnorek').val(data.nomor_rekening).attr('readonly',true);
    $('#inputnama').val(data.Nama).attr('readonly',false);
    $('#inputAlamat').val(data.Alamat).attr('readonly',false);
    $("select[name=txtjenisKelamin]").val(data.jkCode);
    $('#inputthnmasuk').val(data.tahunMasuk).attr('readonly',false);
    $("#inputJenisKelamin").select2({ disabled : false});
    id = data.id;
    $('#savedata').show();
  }
  
 });

var GetData = {
  Init: function(){
      $.ajax({
          type: "GET",
          url: BASE_URL+'/nasabah/Init',
          dataType: "JSON",
          success: function (response) {
              console.log('success')
              console.log(response)
              NasabahTable.DataBind(response.listNasabah);
   
          },
          error: function(data){
              console.log('error')
              console.log(data)
          }
      });
  },
  delete: function(data){
    debugger;
    $.ajax({
      type: "POST",
      url: BASE_URL+'/nasabah/delete',
      data: {
        id : data.id
      },
      dataType: "JSON",
      success: function (response) {
        if(response){
          Swal.fire('Data berhasil di hapus!', '', 'success')
        }else{
          Swal.fire('Data Gagal di hapus!', '', 'error')
        }
          GetData.Init();
          

      },
      error: function(data){
          console.log('error')
          console.log(data)
      }
  });
  }
}

var NasabahTable = {
  Init: function (elm, opt) {
      debugger
      if ($(elm) !== 'undefined') {
          $(elm).each(function () {
              var auto_responsive = $(this).data('auto-responsive');
              var def = {
                  responsive: true,
                  autoWidth: false,
                  dom: '<"row justify-between g-2"<"col-7 col-sm-6 text-right"<"datatables-filter pull-left"f>><"col-5 col-sm-6 text-right"<"datatable-filter"l>>><"datatable-wrap my-3"t><"row align-items-left"<"col-5 col-sm-12 col-md-3"i><"col-7 col-sm-12 col-md-9 text-left text-md-right"p>>',
                  language: {
                      search: "Search",
                      searchPlaceholder: "Type in to Search",
                      // lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                      info: "_START_ -_END_ of _TOTAL_",
                      infoEmpty: "No records found",
                      paginate: {
                          "first": "First",
                          "last": "Last",
                          "next": "Next",
                          "previous": "Prev"
                      },
                      infoFiltered: "( Total _MAX_  )"
                  },
                  "paging": true,
                  "searching": true,
                  "ordering": true,
                  "info": true,
                  "rowCallback": function (row, data) {
                      $(row).addClass('nk-tb-item');
                  },
                  "oSearch": { "bSmart": false, "bRegex": true },
                  "columns": [
                      {
                          data: null,
                          className: "nk-tb-col tb-col-xs text-left",
                          "className": "nk-tb-col text-left",
                          render: function (data, type, row, meta) {
                              return meta.row + 1;
                          }
                      },
                      {
                        data: null,
                        visible : false,
                        "className": "nk-tb-col text-left",
                        render: function (data, type, row, meta) {
                            debugger
                            return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.jtCode) ? data.jtCode : '') + '</span>';
                        }
                      },
                      {
                        data: null,
                        visible : false,
                        "className": "nk-tb-col text-left",
                        render: function (data, type, row, meta) {
                            debugger
                            return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.jkCode) ? data.jkCode : '') + '</span>';
                        }
                      },
                      {
                        data: null,
                        visible : false,
                        "className": "nk-tb-col text-left",
                        render: function (data, type, row, meta) {
                            debugger
                            return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.id) ? data.id : '') + '</span>';
                        }
                      },
                      {
                          data: null,
                          "className": "nk-tb-col text-left",
                          render: function (data, type, row, meta) {
                              debugger
                              return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.nis) ? data.nis : '') + '</span>';
                          }
                      },
                      {
                          data: null,
                          "className": "nk-tb-col text-left",
                          visible :false,
                          render: function (data, type, row, meta) {
                              debugger
                              return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.jenis_tabungan) ? data.jenis_tabungan : '') + '</span>';
                          }
                      },
                      {
                          data: null,
                          "className": "nk-tb-col text-left",
                          render: function (data, type, row, meta) {
                              return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.nomor_rekening) ? data.nomor_rekening : '') + '</span>';
                          }
                      },
                      {
                          data: null,
                          "className": "nk-tb-col text-left",
                          render: function (data, type, row, meta) {
                              return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.Nama) ? data.Nama : '') + '</span>';
                          }
                      },
                      {
                          data: null,
                          "className": "nk-tb-col text-left",
                          render: function (data, type, row, meta) {
                              return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.Alamat) ? data.Alamat : '') + '</span>';
                          }
                      },
                      {
                          data: null,
                          "className": "nk-tb-col text-left",
                          render: function (data, type, row, meta) {
                              return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.jenis_kelamin) ? data.jenis_kelamin : '') + '</span>';
                          }
                      },
                      {
                          data: null,
                          "className": "nk-tb-col text-center",
                          render: function (data, type, row, meta) {
                              return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.tahunMasuk) ? data.tahunMasuk : '') + '</span>';
                          }
                      },
                      {
                          //width: '10vw',
                          data: null,
                          "className": "nk-tb-col text-center",
                          render: function (data, type, row) {
                             
                              var html = ' <button type="button" data-toggle="modal"  data-target="#modalNasabah" id="btnview" class="btn btn-sm btn-info">\
                              <i class="fas fa-eye"></i>\
                            </button>\
                            <button type="button" data-toggle="modal" data-target="#modalNasabah" id="btnEdit" class="btn btn-trigger btn-sm btn-primary">\
                              <i class="fas fa-edit"></i>\
                            </button>\
                            <button type="button"  id="btnDelete" class="btn btn-sm btn-danger">\
                              <i class="fas fa-trash"></i>\
                            </button>';
                              return html;
                          }
                      }
                  ]
              },
                  attr = (opt) ? extend(def, opt) : def;
              attr = (auto_responsive === false) ? extend(attr, { responsive: false }) : attr;

              $(this).DataTable(attr).draw();
          });
      }

      listNasabah = $(elm).DataTable();
      
      // $('#modalProcess').modal('show');
      $(elm + ' tbody').off().on('click', 'button#btnview', function (e) {
          debugger
         // $("#modalNasabah").modal('show');
          flag = "view"
          selectedData = $(elm).DataTable().row($(this).parents('tr')).data();

      });

      $(elm + ' tbody').on('click', 'button#btnEdit', function (e) {
          
        // $("#modalNasabah").modal('show');
        flag = "update"
        selectedData = $(elm).DataTable().row($(this).parents('tr')).data();

    });

    $(elm + ' tbody').on('click', 'button#btnDelete', function (e) {
          
      // $("#modalNasabah").modal('show');
      flag = "delete"
      selectedData = $(elm).DataTable().row($(this).parents('tr')).data();
      Swal.fire({
        title: 'Apakah Ingin Menghapus data Ini?',
        showCancelButton: true,
        confirmButtonText: 'Yes'
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          GetData.delete(selectedData);
          
        } 
      })

  });
      
  },
  DataBind: function (data) {
      listNasabah.clear().rows.add(data).draw();
      listNasabah.columns.adjust();
  }
}