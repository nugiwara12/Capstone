let slideIndex = 0;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n - 1);
        }

        function showSlides(n) {
            const slides = document.getElementsByClassName("slide");
            const dots = document.getElementsByClassName("dot");

            if (n >= slides.length) {
                slideIndex = 0;
            }
            if (n < 0) {
                slideIndex = slides.length - 1;
            }

            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            for (let i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }

            slides[slideIndex].style.display = "block";
            dots[slideIndex].className += " active";
        }
