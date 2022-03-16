var flag;
var flaginput;

$(document).ready(function(){
    
    Init();
    // $.fn.modal.Constructor.prototype.enforceFocus = function() {};
})

function Init()
{
    $('#inputNorek').select2({
        maximumInputLength:3,
        dropdownParent: $('#modaltransaksi'),
        allowClear: true,
        placeholder: "pilih",
        width: '100%',
        heigth: '10%',  
        ajax : { 
            url: BASE_URL+'/transaksi/getrekening',
            delay: 500,
            dataType: "json",
            data: function(params){
                return {
                    search: params.term
                }
            },
            processResults: function (data,page) {
                return{
                    results : data
                }
            }
        }

    });
}

function onlyNumber(event)
{
    var angka = (event.which) ? event.which : event.keyCode;
    if(isNaN(String.fromCharCode(angka)))
        return false;
    return true;
}

$('#inputNorek').on('select2:select', function (e) {
    var data = e.params.data;
    console.log(data.id);

    $.ajax({
        type: "GET",
        url: BASE_URL+'/transaksi/getdetailnasabah',
        data: {id: data.id},
        dataType: "Json",
        success: function (response) {
            let res = response[0];
            $("#inputnis").val(res.nis);
            $("#inputnama").val(res.Nama);
            $("#inputjenistabungan").val(res.jenis_tabungan)
        }
    });
});

$("#btnSetorTunaiModal").click(function(){
    clear()
    flag = 'insert';
    flaginput = "kredit";    
    $("#modaltransaksi").modal('show');
    $("#lblnominal").text('Jumlah Setor Tunai');
    $("#transaksilabel").text('Setor Tunai');
    $("#inputsandi").val('1').prop('disabled',true)
});

$("#btnTarikTunaiModal").click(function(){
    clear()
    flag = 'insert';
    flaginput = "debit";    
    $("#modaltransaksi").modal('show');
    $("#lblnominal").text('Jumlah Tarik Tunai');
    $("#transaksilabel").text('Tarik Tunai');
    $("#inputsandi").val('2').prop('disabled',true)

})

$("#savedata").click(function(){
    
    if(populateData())
    {
        var params = {
            norek : $("#inputNorek").select2('data')[0].text,
            nis : $("#inputnis").val(),
            sandi : $("#inputsandi").val(),
            debit : flaginput == "debit" ? Number($("#inputnominal").val()) : 0,
            kredit : flaginput == "kredit" ? Number($("#inputnominal").val()) : 0,
            flag : flag
        }
        $.ajax({
            type: "POST",
            url: BASE_URL+'/transaksi/savedata',
            data: params,
            dataType: "Json",
            success: function (response) {
                console.log(JSON.stringify(response))
            }
        });
    }
})

function populateData(){
    var isvalid = true;
    var listparam =[];
    var nomorRekening = $("#inputNorek").select2('val');
    var nis = $("#inputnis").val();
    var nominal = $("#inputnominal").val();
    var sandi = $("#inputsandi").val();

    var errMesg = '<ul>';

    if(nomorRekening == '' || nomorRekening == null)
    {
        errMesg = errMesg+" <li>Nomor Rekening Tidak Boleh Kosong</li>"
        isvalid = false;
    }

    if(nominal.length < 1 || nominal == null)
    {
        errMesg = errMesg+"<li>Nominal Tidak Boleh Kosong</li>"
        isvalid = false;
    }else
    {

        if(nominal < 10000 || nominal == null)
        {
            errMesg = errMesg+"<li>Nominal harus 10.000 atau lebih</li>"
            isvalid = false;
        }
    }

    if(isvalid)
    {
        listparam.push({
            norek : $("#inputNorek").select2('data')[0].text,
            nis : nis,
            nominal : nominal,
            sandi : sandi
        });

        return listparam;
    }else
    {
        bootbox.alert({
            title : "<p style='color:red'>Warning!</p>",
            message: errMesg+ "</ul>"
        });
        return false;
    }
}

function clear()
{
    $("#inputNorek").val('').trigger('change');
    $("#inputnis").val('');
    $("#inputnama").val('');
    $("#inputjenistabungan").val('');
    $("#inputnominal").val('');
}