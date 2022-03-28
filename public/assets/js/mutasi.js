var data;

$(document).ready(function(){
    activesidebar()
    Init();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd ',
        todayHighlight: true,

    });
})
function activesidebar()
{

    $("#sideDropdown2").removeClass('collapsed');
    $("#collapseTabungan").addClass('show');
    $("#barTransaksi").removeClass('active');
    $("#barDashboard").removeClass('active');
    $("#barMutasi").addClass('active');

}

function Init()
{
    $.ajax({
        type: "GET",
        url: BASE_URL+'/transaksi/getrekening',
        data: "",
        dataType: "json",
        success: function (response) {
            $('#inputNorek').select2({
                allowClear: true,
                placeholder: "pilih",
                width: '100%',
                data:response
            });
        }
    });    
}