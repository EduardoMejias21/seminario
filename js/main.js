
var swiper = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
  });
let ubicacionPrincipal = window.pageYOffset; //0

  AOS.init();

window.addEventListener("scroll", function(){
    let desplazamientoActual = window.pageYOffset; //180
    if(ubicacionPrincipal >= desplazamientoActual){ // 200 > 180
        document.getElementsByTagName("nav")[0].style.top = "0px"
    }else{
        document.getElementsByTagName("nav")[0].style.top = "-100px"
    }
    ubicacionPrincipal= desplazamientoActual; //200

})
// Menu

let enlacesHeader = document.querySelectorAll(".enlaces-header")[0];
let semaforo = true;

document.querySelectorAll(".hamburguer")[0].addEventListener("click", function(){
    if(semaforo){
        document.querySelectorAll(".hamburguer")[0].style.color ="#fff";
        semaforo= false;
    }else{
        document.querySelectorAll(".hamburguer")[0].style.color ="#000";
        semaforo= true;
    }

    enlacesHeader.classList.toggle("menudos")
})
