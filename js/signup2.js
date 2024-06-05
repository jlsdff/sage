let slideIndex = 0;
showSlides();

document.querySelector('submit', (e) => {

})

function showSlides() {
    let slides = document.getElementsByClassName("slide");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    slides[slideIndex - 1].style.display = "flex";
    setTimeout(showSlides, 3000); // Change image every 3 seconds
}

function onSignup(){
    
}