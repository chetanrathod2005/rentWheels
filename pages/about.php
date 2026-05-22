<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | RentWheels</title>
    
    <style>
        :root {
            --primary: #6366f1;
            --dark: #0f172a;
            --light: #f8fafc;
            --text-muted: #64748b;
            --white: #ffffff;
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--white); color: var(--dark); line-height: 1.7; }

        /* --- Global Components --- */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .section-padding { padding: 80px 0; }
        .text-center { text-align: center; }
        .badge { background: #e0e7ff; color: var(--primary); padding: 5px 15px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; }

        /* --- About Hero --- */
        .about-hero {
            background: linear-gradient(135deg, #f1f5f9 0%, #fff 100%);
            padding: 100px 0 60px;
        }
        .about-hero h1 { font-size: clamp(2.5rem, 5vw, 3.5rem); margin-top: 15px; }
        .about-hero p { color: var(--text-muted); font-size: 1.2rem; max-width: 700px; margin: 20px auto; }

        /* --- Story Section (Image + Text) --- */
        .story-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        .story-image img {
            width: 100%;
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
        }

        /* --- Services We Provide (Detailed) --- */
        .services-detail { background: var(--light); }
        .service-card-long {
            display: flex;
            background: var(--white);
            margin-bottom: 40px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .service-card-long:nth-child(even) { flex-direction: row-reverse; }
        .service-card-long:hover { transform: translateY(-5px); }
        
        .service-img { flex: 1; min-height: 300px; background-size: cover; background-position: center; }
        .service-content { flex: 1; padding: 40px; display: flex; flex-direction: column; justify-content: center; }
        .service-content h3 { font-size: 1.8rem; margin-bottom: 15px; color: var(--primary); }

        /* --- Values Section --- */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        .value-item { padding: 30px; border: 1px solid #e2e8f0; border-radius: 15px; }
        .value-item h4 { margin-bottom: 10px; font-size: 1.2rem; }

        /* --- Responsive --- */
        @media (max-width: 992px) {
            .story-grid { grid-template-columns: 1fr; }
            .service-card-long, .service-card-long:nth-child(even) { flex-direction: column; }
            .service-img { height: 250px; }
        }
    </style>
</head>
<body>

    <section class="about-hero text-center">
        <div class="container">
            <span class="badge">Our Journey</span>
            <h1>Redefining Mobility in Bhavnagar</h1>
            <p>Since 2020, RentWheels has been on a mission to provide freedom of movement through affordable and reliable vehicle rentals.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="story-grid">
                <div class="story-image">
                    <img src="assets/images/hero_img/rent_car.jpg" alt="Our Fleet">
                </div>
                <div class="story-content">
                    <span class="badge">Who We Are</span>
                    <h2 style="margin: 15px 0;">We aren't just a rental service; we're your travel partner.</h2>
                    <p>We started with just 5 bikes and a small garage. Today, we manage over 100+ vehicles. We believe that whether you are a tourist exploring the heritage of Gujarat or a professional commuting to work, your journey should be seamless, safe, and cost-effective.</p>
                    <p style="margin-top: 15px;">Our technology-driven platform ensures that you can book a ride in under 60 seconds, with transparent pricing and no hidden security deposit hassles.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="services-detail section-padding">
        <div class="container">
            <div class="text-center" style="margin-bottom: 60px;">
                <span class="badge">What We Provide</span>
                <h2>Comprehensive Rental Solutions</h2>
            </div>

            <div class="service-card-long">
                <div class="service-img" style="background-image: url('assets/images/hero_img/flexible_car.jpg');"></div>
                <div class="service-content">
                    <h3>Flexible Daily Rentals</h3>
                    <p>Perfect for those who need a vehicle for a few hours or a full day. Choose from fuel-efficient scooters to premium sedans. Includes 24/7 roadside assistance and a complimentary helmet for two-wheelers.</p>
                </div>
            </div>

            <div class="service-card-long">
                <div class="service-img" style="background-image: url('assets/images/hero_img/monthly_rent.jpg');"></div>
                <div class="service-content">
                    <h3>Monthly Subscriptions</h3>
                    <p>Forget the hassles of ownership, insurance, and maintenance. Our long-term rental plans allow you to keep a vehicle for months at a fraction of the cost of a loan EMI.</p>
                </div>
            </div>

            <div class="service-card-long">
                <div class="service-img" style="background-image: url('assets/images/hero_img/hero.jpg');"></div>
                <div class="service-content">
                    <h3>Premium & Luxury Fleet</h3>
                    <p>Make your special occasions even more memorable. We provide luxury cars  corporate events, and premium city tours with professional chauffeur options.</p>
                </div>
            </div>
             <div class="service-card-long">
                <div class="service-img" style="background-image: url('assets/images/hero_img/wedding.jpg');"></div>
                <div class="service-content">
                    <h3>For Wedding Special Decorated Vehicles</h3>
                    <p>we also provide our serice in wedding where there is number of car we deliver accroding to our user requirement, we can arrange upto 50 cars at one wedding </p>
                </div>
            </div>
            <div class="service-card-long">
                <div class="service-img" style="background-image: url('assets/images/hero_img/pickup.jpg');"></div>
                <div class="service-content">
                    <h3>pickup from airport</h3>
                    <p>we not only provide vehicle we made our client to tension free once you book vehicle from our site then definately
                    you get vehicle and you reach your destination within your time  </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container text-center">
            <h2>Our Core Values</h2>
            <div class="values-grid">
                <div class="value-item">
                    <h4>Safety First</h4>
                    <p>Every vehicle undergoes a 50-point safety check before every single handover.</p>
                </div>
                <div class="value-item">
                    <h4>Transparency</h4>
                    <p>What you see is what you pay. No hidden charges or surprise penalties.</p>
                </div>
                <div class="value-item">
                    <h4>Eco-Friendly</h4>
                    <p>We are actively expanding our fleet of Electric Vehicles (EVs) to reduce carbon footprints.</p>
                </div>
            </div>
        </div>
    </section>


</body>
</html>