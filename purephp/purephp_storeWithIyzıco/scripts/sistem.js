function sepeteEkle(SITE,urunID)
{
    var adet=$(".adet").val();
    $.ajax({
        method:"POST",
        url:SITE+"ajax.php",
        data:$("form#urunbilgisi").serialize()+"&urunID="+urunID+"&islemtipi=sepeteEkle",
        success: function(sonuc)
        {
            if(sonuc=="TAMAM")
            {
                Swal.fire({
                    title: '<strong>Sepete Eklendi</strong>',
                    icon: 'success',
                    html:
                        'Ürün sepetinize başarıyla eklenmiştir',
                    showCloseButton: false,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> Alışverişe Devam Et',
                    confirmButtonAriaLabel: 'Alışverişe Devam Et',
                })
            }
            else if (sonuc=="STOK")
            {
                Swal.fire({
                    title: '<strong>Stokta Yok</strong>',
                    icon: 'warning',
                    html:
                        'Bu Ürün Stokta Bulunmamaktadır',
                    showCloseButton: false,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> Alışverişe Devam Et',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                })
            }
            else
            {
                alert("Birşeyler ters gitti");
            }
        }
    });
}
function sifreIste(SITE) {
    var mailadresi=$(".sifremail").val();
    $.ajax({
        method:"POST",
        url:SITE+"ajax.php",
        data:{"mailadresi":mailadresi,"islemtipi":"sifreIste"},
        success: function(sonuc)
        {
            if(sonuc=="TAMAM")
            {
                window.location.href = SITE+"sifre-belirle/dogrulama";
            }
            else
            {
                alert("Birşeyler ters gitti");
            }
        }
    });

}