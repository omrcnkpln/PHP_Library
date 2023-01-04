$(function(){
    var doms = $('.proteinShake'),
        domsDiv = $('.proteinShake .div'),
        shake = $('#proteinShake'),
        selected = 0;
    for (var x = 0; x < doms.length; x++) {
        for (var i = 0; i < domsDiv.length; i++) {
            doms[x].domsDiv[i].on('mousedown', function(e){
               selected = this;
            });
        }
    }
    shake.on("mouseup", function (e) {
        selected.animate(300, 'bounceback 1s ease');
        selected.animate(300, 'bounceback 1s ease');
        selected.style.animation = "bounceback 1s ease";
        selected.style.animationFillMode = "forwards";
        var lala = selected;
        selected = null;

        setTimeout(function () {
            lala.style.animation = "";
            lala.style.animationFillMode = "";
            lala.style.left = "";
            lala.style.top = "";
        }, 1000)

    })
});