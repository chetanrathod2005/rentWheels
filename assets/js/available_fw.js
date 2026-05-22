function bookRide(id) {
     fetch("fw_booking/fw_book.php?id="+id) 
    .then(res=>res.text())
    .then(data=>{
    document.getElementById("book_model").style.display="flex";
     document.getElementById('booking_content').innerHTML=data;
    })
    }
   
 document.addEventListener("change", function (e) {
    if (e.target && e.target.id === "date_from") {
        let fromDate = e.target.value;
        let toInput = document.getElementById("date_to");

        if (toInput) {
            toInput.min = fromDate;

            if (toInput.value && toInput.value < fromDate) {
                toInput.value = "";
            }
        }
    }
});
    document.addEventListener("submit",function (e) {
        if (e.target && e.target.id=="booking_data") {
            e.preventDefault();
        
        let formData=new FormData(e.target);
        fetch("fw_booking/save_fw_booking.php",{
            method:"POST",
            body:formData
        })
        .then(res=>res.text()) 
        .then(data=> {
            alert(data);
            location.reload();
        })
        }
    })

    function cancel_book() {
        document.getElementById('book_model').style.display="none";
    }
    
document.querySelectorAll('.bike-card').forEach(card => {
    const slides = card.querySelectorAll('.slide');
    const dotsContainer = card.querySelector('.slider-dots');
    let currentIndex = 0;
    let isPaused = false;

    // Create Dots dynamically based on image count
    slides.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        if (index === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(index));
        dotsContainer.appendChild(dot);
    });

    const dots = card.querySelectorAll('.dot');

    function goToSlide(index) {
        slides[currentIndex].classList.remove('active');
        dots[currentIndex].classList.remove('active');
        currentIndex = index;
        slides[currentIndex].classList.add('active');
        dots[currentIndex].classList.add('active');
    }

    function nextSlide() {
        if (!isPaused) {
            let next = (currentIndex + 1) % slides.length;
            goToSlide(next);
        }
    }

    // Auto cycle every 3 seconds
    let slideInterval = setInterval(nextSlide, 3000);

    // Pause on Hover
    card.querySelector('.image-slider-container').addEventListener('mouseenter', () => {
        isPaused = true;
    });

    card.querySelector('.image-slider-container').addEventListener('mouseleave', () => {
        isPaused = false;
    });
});