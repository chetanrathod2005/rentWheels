const counters = document.querySelectorAll(".counter");
    const statsSection = document.querySelector("#statsSection");

    let started = false;

    function startCounters() {

        if (started) return;
        started = true;

        counters.forEach(counter => {

            const target = +counter.getAttribute("data-target");
            let count = 0;

            const updateCounter = () => {

                const increment = target / 100;

                if (count < target) {

                    count += increment;

                    if (target === 24) {
                        counter.innerText = Math.ceil(count) + "/7";
                    } else {
                        counter.innerText = Math.ceil(count) + "+";
                    }

                    requestAnimationFrame(updateCounter);

                } else {

                    if (target === 24) {
                        counter.innerText = "24/7";
                    } else {
                        counter.innerText = target + "+";
                    }

                }
            };

            updateCounter();
        });
    }

    const observer = new IntersectionObserver((entries) => {

        entries.forEach(entry => {

            if (entry.isIntersecting) {
                startCounters();
            }

        });

    }, {
        threshold: 0.5
    });

    observer.observe(statsSection);