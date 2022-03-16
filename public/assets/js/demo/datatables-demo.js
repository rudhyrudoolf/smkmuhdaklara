// Call the dataTables jQuery plugin
var table;
var flag;
var id = 0;
$(document).ready(function() {
  table = $('#tblnasabah').DataTable();
  $('#tblnasabah').DataTable();

  if(localStorage.getItem("success"))
  {
    // let item = JSON.parse(localStorage.getItem("success"));

    // console.log(item);
    $('#alert-text-success').text("Data Nasabah Berhasil Di Tambahkan");
    $('#add-alert-success').show();
  }else if(localStorage.getItem("error"))
  {
    $('#alert-text-danger').text("Data Nasabah Gagal Di Tambahkan");
    $('#show-alert-danger').show();
  }
  localStorage.removeItem("success");
  localStorage.removeItem("error");

});


$("#btnAddModal").click(function() {
  func.clearField();
    $("#modalNasabah").modal();
});

$("#savedata").click(function() {
  flag == null ? flag = "insert" : flag;

  // console.log(func.params()); return;
  $.ajax({
      type: "POST",
      url: BASE_URL+'/nasabah/save' ,
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
         
          if(response.content)
          {
            let myObj = response;
            localStorage.setItem("success",JSON.stringify(myObj))
            // $('#alert-text-success').text("Data Nasabah Berhasil Di Tambahkan");
            // $('#add-alert-success').show();
          }else{
            localStorage.setItem("error",response)

            // $('#alert-text-danger').text("Data Nasabah Gagal Di Tambahkan"+response.content);
            // $('#show-alert-danger').show();
          }
          window.location.reload(); 
         
          

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
    $("#selectJenistab option:first").prop('selected',true);
    $("#inputnis").val('');
    $("#inputnorek").val('');
    $("#inputnama").val('');
    $("#inputAlamat").val('');
    $("#inputJenisKelamin option:first").prop('selected',true),
    $("#inputthnmasuk").val('')
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

$('#tblnasabah tbody').on('click', '#btnview', function () {

  var data_row = table.row( $(this).parents('tr') ).data(); // here is the change
  console.log(data_row);
 $("#modalNasabah").modal('show');

 $('#modalNasabah').on('shown.bs.modal', function() {

   $("select[name=txtjenistabungan]").val(data_row[2]).attr('readonly',true);
    $('#inputnis').val(data_row[1])
    $('#inputnorek').val(data_row[4]).attr('readonly',true);
    $('#inputnama').val(data_row[5]).attr('readonly',true);
    $('#inputAlamat').val(data_row[6]).attr('readonly',true);
    $("select[name=txtjenisKelamin]").val(data_row[8]).attr('readonly',true);
    $('#inputthnmasuk').val(data_row[9]).attr('readonly',true);

    $('#savedata').hide();

 });

});

$('#tblnasabah tbody').on('click', '#btnEdit', function () {
  flag = "update";
  var data_row = table.row( $(this).parents('tr') ).data(); // here is the change
  console.log(data_row);
 $("#modalNasabah").modal('show');

 $('#modalNasabah').on('shown.bs.modal', function() {

   $("select[name=txtjenistabungan]").val(data_row[2]).attr('readonly',true);
    $('#inputnis').val(data_row[1])
    $('#inputnorek').val(data_row[4]).attr('readonly',true);
    $('#inputnama').val(data_row[5]).attr('readonly',false);
    $('#inputAlamat').val(data_row[6]).attr('readonly',false);
    $("select[name=txtjenisKelamin]").val(data_row[8]).attr('readonly',false);
    $('#inputthnmasuk').val(data_row[9]).attr('readonly',true);

   
    id = data_row[10];
    $('#savedata').show();
 });

});