document.onreadystatechange = function () {
    if (document.readyState !== "complete") {
        document.querySelector(".doc-loader").style.visibility = "visible";
    } else {
        setTimeout(() => {
            document.querySelector(".doc-loader").style.display = "none";
        }, 1333);
    }
};
