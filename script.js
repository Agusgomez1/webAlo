document.getElementById("moreInfoBtn").addEventListener("click", function() {
    document.querySelector(".about-card").classList.add("shift-left");
    document.querySelector(".about-info").classList.add("show-info");
    document.querySelector(".about-info").classList.remove("d-none");
});

document.getElementById("closeInfoBtn").addEventListener("click", function() {
    document.querySelector(".about-card").classList.remove("shift-left");
    document.querySelector(".about-info").classList.remove("show-info");
    setTimeout(function() {
        document.querySelector(".about-info").classList.add("d-none");
    }, 500);
});


  








