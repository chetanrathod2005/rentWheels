<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="hero">
        <div class="hero_img">
            <div class="info">

                <h2>Drive Your Dreams </h2>
                <p>Affordable, Reliable & Easy Vehicle Rentals</p>
            </div>
            <div>
                <?php if (isset($_GET['show']) && $_GET['show'] == "login") {
                    include("auth.php");
                } ?>
            </div>
        </div>
    </div>
    <!-- Features -->
    <section class="features">
        <div class="feature-box">
            <h3>Easy Booking</h3>
            <p>Book in seconds with simple steps.</p>
        </div>
        <div class="feature-box">
            <h3>Affordable</h3>
            <p>Best prices guaranteed.</p>
        </div>
        <div class="feature-box">
            <h3>Variety</h3>
            <p>Cars, bikes & more options.</p>
        </div>
        <div class="feature-box">
            <h3>Support</h3>
            <p>24/7 customer service.</p>
        </div>
    </section>
    <section class="how-it-works">
        <h2>How It Works</h2>
        <div class="steps">
            <div class="step">
                <h3>1. Choose Vehicle</h3>
                <p>Select from a wide range of bikes and cars.</p>
            </div>
            <div class="step">
                <h3>2. Book Online</h3>
                <p>Easy and quick booking process.</p>
            </div>
            <div class="step">
                <h3>3. Enjoy Ride</h3>
                <p>Drive safely and enjoy your journey.</p>
            </div>
            <div class="step">
                <h3>4. Return Vehicle</h3>
                <p>Simple return process with no hassle.</p>
            </div>
        </div>
    </section>
    <!-- Vehicles -->
    <section class="vehicles">
        <div class="vehicle-heading">
            <span>Premium Collection</span>
            <h2>Choose Your Perfect Ride</h2>
            <p>
                Explore our stylish and comfortable vehicles for every journey.
                Whether it’s a bike ride or a family trip, we have the perfect option.
            </p>
        </div>

        <div class="vehicle-container">

            <!-- Two Wheeler -->
            <div class="vehicle-card">
                <div class="vehicle-image">
                    <img src="assets/images/hero_img/bullet.png" alt="Two Wheeler">
                </div>

                <div class="vehicle-content">
                    <h3>Two Wheelers</h3>
                    <p>
                        Fast, stylish, and perfect for city rides and long journeys.
                    </p>

                    <a href="index.php?page=vehicle" class="vehicle-btn">Explore Bikes</a>
                </div>
            </div>

            <!-- Four Wheeler -->
            <div class="vehicle-card">
                <div class="vehicle-image">
                    <img src="assets/images/hero_img/scorpion.png" alt="Four Wheeler">
                </div>

                <div class="vehicle-content">
                    <h3>Four Wheelers</h3>
                    <p>
                        Comfortable and spacious vehicles for family and group travel.
                    </p>

                    <a href="index.php?page=vehicle" class="vehicle-btn">Explore Cars</a>
                </div>
            </div>

        </div>
    </section>
    <section class="why-us">
        <h2>Why Choose RentWheels?</h2>

        <div class="why-container">

            <div class="why-card">
                <div class="icon">🚘</div>
                <h3>Trusted Service</h3>
                <p>
                    Thousands of customers trust us for safe and comfortable travel.
                </p>
            </div>

            <div class="why-card">
                <div class="icon">🛠️</div>
                <h3>Well Maintained Vehicles</h3>
                <p>
                    All vehicles are regularly serviced and cleaned for better rides.
                </p>
            </div>

            <div class="why-card">
                <div class="icon">💰</div>
                <h3>Flexible Pricing</h3>
                <p>
                    Affordable hourly, daily, and weekly rental plans available.
                </p>
            </div>

        </div>
    </section>
    <section class="popular">
        <h2>Popular Vehicles</h2>
        <div class="popular-grid">
            <div class="card">Honda Activa</div>
            <div class="card">Royal Enfield</div>
            <div class="card">Hyundai i20</div>
            <div class="card">Maruti Swift</div>
            <div class="card">Ertiga</div>
        </div>
    </section>
    <!-- Stats -->
    <!-- Stats -->
    <section class="stats" id="statsSection">
        <div class="stat">
            <h2 class="counter" data-target="100">0</h2>
            <p>Vehicles</p>
        </div>

        <div class="stat">
            <h2 class="counter" data-target="1000">0</h2>
            <p>Happy Customers</p>
        </div>

        <div class="stat">
            <h2 class="counter" data-target="24">0</h2>
            <p>Support</p>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="testimonial-slider">
            <div class="testimonial-track">

                <!-- [SET 1] Original 5 Cards -->
                <div class="testimonial-box">
                    <p>"Amazing service..."</p><strong>- Rahul</strong>
                </div>
                <div class="testimonial-box">
                    <p>"Booking was super easy..."</p><strong>- Priya</strong>
                </div>
                <div class="testimonial-box">
                    <p>"The bikes were clean..."</p><strong>- Amit</strong>
                </div>
                <div class="testimonial-box">
                    <p>"Customer support was available..."</p><strong>- Neha</strong>
                </div>
                <div class="testimonial-box">
                    <p>"Best vehicle rental experience..."</p><strong>- Karan</strong>
                </div>

                <!-- [SET 2] Exact Clone of the 5 Cards -->
                <div class="testimonial-box">
                    <p>"Amazing service..."</p><strong>- Rahul</strong>
                </div>
                <div class="testimonial-box">
                    <p>"Booking was super easy..."</p><strong>- Priya</strong>
                </div>
                <div class="testimonial-box">
                    <p>"The bikes were clean..."</p><strong>- Amit</strong>
                </div>
                <div class="testimonial-box">
                    <p>"Customer support was available..."</p><strong>- Neha</strong>
                </div>
                <div class="testimonial-box">
                    <p>"Best vehicle rental experience..."</p><strong>- Karan</strong>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <h2>Ready to Ride?</h2>
        <p>Book your vehicle now and start your journey!</p>
        <a href="index.php?page=home&show=login">Get Started</a>
    </section>
    <section class="contact">
        <h2>Contact Us</h2>
        <p>Email: support@rentwheels.com</p>
        <p>Phone: +91 9876543210</p>
        <p>Location: Bhavnagar, India</p>
    </section>
</body>
<script src="assets/js/home.js"></script>

</html>