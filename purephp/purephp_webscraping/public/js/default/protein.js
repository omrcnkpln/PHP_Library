var doms = document.getElementsByClassName("proteinShake");
const shake = document.getElementById("proteinShake");

var selected = 0;

for (var x = 0; x < doms.length; x++) {
    for (var i = 0; i < doms[x].children.length; i++) {
        doms[x].children[i].addEventListener("mousedown", function (e) {
            selected = this;
        })
    }
}

shake.addEventListener("mouseup", function (e) {
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

shake.addEventListener("mousemove", function (e) {
    if (selected == null || !selected) return;
    selected.style.left = (e.clientX - (selected.getBoundingClientRect().width / 2) - shake.getBoundingClientRect().x) + "px"
    selected.style.top = (e.clientY - (selected.getBoundingClientRect().height / 2) - shake.getBoundingClientRect().y) + "px"
    selected.style.animation = 0;

})

window.addEventListener('click', () => {

})