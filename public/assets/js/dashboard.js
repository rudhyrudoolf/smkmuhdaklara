$(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd ',
        todayHighlight: true,

    });
});


$("#searchData").click(function () { 
   var periodFrom = $("#periodFrom").val();
   var periodTo = $("#periodTo").val();

   debugger

   if(periodFrom>periodTo)
   {
    bootbox.alert({
        title : "<p style='color:red'>Warning!</p>",
        message: "Periode tidak valid"
    });
    return true;
   }
   $.ajax({
       type: "GET",
       url: BASE_URL+'/home/filter',
       data: {
           periodFrom:periodFrom,
           periodTo:periodTo
       },
       dataType: "JSON",
       success: function (response) {
           console.log(response)
           
           $("#totalnasabah").text(response.totalnasabah['totalnasabah'])
           $("#totalDebit").text(formatNumber(response.debit))
           $("#totalKredit").text(formatNumber(response.kredit))
           $("#totalsaldo").text(formatNumber(response.saldo))

       },
       error: function(data){
           
       }
   });
});

function formatNumber(params)
{
    var bilangan = params;
	if(bilangan != null){
    var	reverse = bilangan.toString().split('').reverse().join(''),
	ribuan 	= reverse.match(/\d{1,3}/g);
	ribuan	= ribuan.join('.').split('').reverse().join('');

    return ribuan
    }else return null
}