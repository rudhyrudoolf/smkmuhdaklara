// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#tblnasabah').DataTable();
});


$("#btnAddModal").click(function() {
  func.clearField();
    $("#modalNasabah").modal();
});

$("#savedata").click(function() {
 console.log(func.params());
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
         
        
          if(response.content)
          {
            console.log(response.content);
            $('#alert-text-success').text("Data Nasabah Berhasil Di Tambahkan");
            $('#add-alert-success').show();
          }else{
              $('#alert-text-danger').text("Data Nasabah Gagal Di Tambahkan");
              $('#show-alert-danger').show();
          }

      },
      error: function(errResponse)
      {
        $("#btnsubmit").show();
        $("#btnloading").hide();
        $("#modalNasabah").modal('hide');
          console.log(errResponse); 
          if(errResponse.responseText != "")
          {
            $('#alert-text-danger').text("Data Nasabah Gagal Di Tambahkan! Trace error : "+ errResponse.responseText['message']);
            $('#show-alert-danger').show();
          }else
          {
            $('#alert-text-danger').text("Data Nasabah Gagal Di Tambahkan! ");
            $('#show-alert-danger').show();
          }
      },
      complete: function(){
        //setInterval('location.reload()', 2000);   
        window.setTimeout(function(){ 
          location.reload(true);
      } ,2000);
      }
    });
});

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
        thMasuk : $("#inputthnmasuk").val()
    }

    return params;
  }
}