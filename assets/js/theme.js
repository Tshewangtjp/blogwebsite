
var icon = document.getElementById("icon");

if(localStorage.getItem("theme") == null){
    localStorage.setItem("theme", "light");
}



let localData = localStorage.getItem("theme");

if(localData == "light"){
    icon.src = "../assets/images/moon.png";
    document.body.classList.remove("dark-theme");
}else if(localData == "dark"){
    icon.src = "../assets/images/sun.png";
    document.body.classList.add("dark-theme");

}

icon.onclick = function(){
    document.body.classList.toggle("dark-theme");
    if(document.body.classList.contains("dark-theme")){
        icon.src = "../assets/images/sun.png";
        localStorage.setItem("theme", "dark");
    }else{
        icon.src = "../assets/images/moon.png";
        localStorage.setItem("theme", "light");
    }
}

var typed = new Typed(".multiple-text", {
    strings: ["Teacher", "Writer", "Blogger", "Freelancer"],
    typeSpeed: 100,
    backSpeed: 100,
    backDelay: 1000,
    loop: true
})


$('.post-slider').each(function(index, slider) {
    $(slider).slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: false,
      infinite: false,
      autoplaySpeed: 2000,
      nextArrow: $(slider).siblings('.next-arrow'),
      prevArrow: $(slider).siblings('.prev-arrow'),
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 550,
          settings: {
            slidesToShow: 2,
          }
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
    });
