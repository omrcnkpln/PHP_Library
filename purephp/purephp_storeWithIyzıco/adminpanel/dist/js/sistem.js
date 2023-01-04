var SITE=$("html").data("url");
var ANASITE=$("html").data("anaurl");

$(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })


})
$(function () {
    // Summernote
    $('.textarea').summernote()
})
function aktifpasif(ID,tablo)
{
    var durum=0;
    if($(".aktifpasif"+ID).is(':checked'))
    {
        durum=1;
    }
    else
    {
        durum=2;
    }

    $.ajax({
        method:"POST",
        url:SITE+"ajax.php",
        data:{"tablo":tablo,"ID":ID,"durum":durum},
        success: function(sonuc)
        {
            if(sonuc=="TAMAM")
            {
            }
            else
            {
                alert("İşleminiz şuan geçersizdir. Lütfen daha sonra tekrar deneyiniz.");
            }
        }
    });
}

function vitrinaktifpasif(ID,tablo)
{
    var durum=0;
    if($(".vitrinaktifpasif"+ID).is(':checked'))
    {
        durum=1;
    }
    else
    {
        durum=2;
    }

    $.ajax({
        method:"POST",
        url:SITE+"ajax.php",
        data:{"tablo":tablo,"ID":ID,"vitrindurum":durum},
        success: function(sonuc)
        {
            if(sonuc=="TAMAM")
            {
            }
            else
            {
                alert("İşleminiz şuan geçersizdir. Lütfen daha sonra tekrar deneyiniz.");
            }
        }
    });
}