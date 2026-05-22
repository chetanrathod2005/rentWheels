<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/vehicle.css">
    <title>Document</title>
</head>
<body>
    <div class="page-header" >
    <div class="page-info">
        <h1>Our Vehicles</h1>
        <p>Choose your ride for a comfortable journey</p>
    </div>
</div>



    <!-- Interactive Filter -->
    <div class="filter-tabs">
        <button class="tab-btn active" onclick="filterType('all')">All</button>
        <button class="tab-btn" onclick="filterType('car')">Cars</button>
        <button class="tab-btn" onclick="filterType('bike')">Bikes</button>
    </div>

    <!-- Cars Group -->
    <div class="category-group" id="cars-section">
        <h2>Cars</h2>
        <div class="vehicle-grid">

        </div>
    </div>

    <!-- Bikes Group -->
    <div class="category-group" id="bikes-section">
        <h2>Bikes & Scooter </h2>
        <div class="vehicle-grid">
            
</div>
</div>
</body>
<script>
    function filterType(type) {
        // Update button appearance
        const btns = document.querySelectorAll('.tab-btn');
        btns.forEach(btn => btn.classList.remove('active'));
        event.currentTarget.classList.add('active');

        // Toggle sections
        const carSection = document.getElementById('cars-section');
        const bikeSection = document.getElementById('bikes-section');

        if (type === 'all') {
            carSection.style.display = 'block';
            bikeSection.style.display = 'block';
        } else if (type === 'car') {
            carSection.style.display = 'block';
            bikeSection.style.display = 'none';
        } else if (type === 'bike') {
            carSection.style.display = 'none';
            bikeSection.style.display = 'block';
        }
    }
    const vehicles = [
    {
        type: "car",
        name: "Swift Dzire",
        image: "assets/images/hero_img/swift.png",
        specs: ["👤 5 Seats", "⛽ Petrol", "⚙️ Manual"],
        price: 2100
    },
    {
        type: "car",
        name: "Ertiga",
        image: "assets/images/hero_img/ertiga.png",
        specs: ["👤 7 Seats", "❄️ AC", "⚙️ Manual"],
        price: 2500
    },
    {
        type: "car",
        name: "Aura",
        image: "assets/images/hero_img/aura.png",
        specs: ["👤 5 Seats", "❄️ AC", "⚙️ Manual"],
        price: 2000
    },
    {
        type: "car",
        name: "Tata Punch",
        image: "assets/images/hero_img/punch.png",
        specs: ["👤 5 Seats", "❄️ AC", "⚙️ Manual"],
        price: 2200
    },
    {
        type: "car",
        name: "Innova",
        image: "assets/images/hero_img/Innova.png",
        specs: ["👤 7 Seats", "❄️ AC", "⚙️ Auto"],
        price: 3500
    },
    {
        type: "car",
        name: "Harrier",
        image: "assets/images/hero_img/harrier.png",
        specs: ["👤 7 Seats", "❄️ AC", "⚙️ Auto"],
        price: 3300
    },
    {
        type: "car",
        name: "Scorpio N",
        image: "assets/images/hero_img/scorpion.png",
        specs: ["👤 7 Seats", "❄️ AC", "⚙️ Auto"],
        price: 4500
    },
    {
        type: "car",
        name: "Thar",
        image: "assets/images/hero_img/thar.jpg",
        specs: ["👤 5 Seats", "❄️ AC", "⚙️ Manual"],
        price: 4000
    },
    {
        type: "bike",
        name: "Royal Enfield",
        image: "assets/images/hero_img/bullet.png",
        specs: ["🏍️ 350cc", "⛽ 35kmpl"],
        price: 500
    },
    {
        type: "bike",
        name: "Shine 125",
        image: "assets/images/hero_img/shine.png",
        specs: ["🏍️ 125cc", "⛽ 55kmpl"],
        price: 350
    },
    {
        type: "bike",
        name: "Glamour",
        image: "assets/images/hero_img/glamour.png",
        specs: ["🏍️ 125cc", "⛽ 55kmpl"],
        price: 400
    },
    {
        type: "bike",
        name: "Splendor",
        image: "assets/images/hero_img/splendor.png",
        specs: ["🏍️ 100cc", "⛽ 70kmpl"],
        price: 300
    },
    {
        type: "bike",
        name: "super splendor",
        image: "assets/images/hero_img/supper_splendor.png",
        specs: ["🏍️ 125cc", "⛽ 50kmpl"],
        price: 350
    },
    {
        type: "bike",
        name: "Pulsar",
        image: "assets/images/hero_img/pulsar.png",
        specs: ["🏍️ 125cc", "⛽ 65kmpl"],
        price: 300
    },
    {
        type: "bike",
        name: "Activa 6G",
        image: "assets/images/hero_img/activa6g.png",
        specs: ["🛵 Automatic", "⛽ 40kmpl"],
        price: 350
    },
     {
        type: "bike",
        name: "Access-125",
        image: "assets/images/hero_img/access125.png",
        specs: ["🛵 Automatic", "⛽ 35kmpl"],
        price: 350
    }
];function renderVehicles() {
    const carGrid = document.querySelector("#cars-section .vehicle-grid");
    const bikeGrid = document.querySelector("#bikes-section .vehicle-grid");

    carGrid.innerHTML = "";
    bikeGrid.innerHTML = "";

    vehicles.forEach(v => {
        const card = `
        <div class="vehicle-card">
            <div class="image-box">
                <img src="${v.image}" alt="${v.name}">
            </div>
            <div class="card-details">
                <h3>${v.name}</h3>
                <div class="vehicle-specs">
                    ${v.specs.map(s => `<span>${s}</span>`).join("")}
                </div>
                <div class="price-tag">₹${v.price} <span>/ day</span></div>
                <button class="book-btn" onclick="window.location.href='index.php?page=home&show=login'">
                Book Ride</button>
            </div>
        </div>
        `;

        if (v.type === "car") {
            carGrid.innerHTML += card;
        } else {
            bikeGrid.innerHTML += card;
        }
    });
}

renderVehicles();
</script>
</html>

