<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fuerza Fitness Gym</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      line-height: 1.6;
      background: #f7f9fc;
      color: #222;
    }

    header {
      background: url('image/background.jpg') no-repeat center center/cover;
      height: 100vh;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 0 2rem;
    }

    header h1 {
      font-size: 3rem;
      font-weight: 700;
    }
    header img{
      width: 600px;
      height: auto;
    }

    header p {
      font-size: 1.25rem;
      margin: 1rem 0;
    }

    .cta-buttons a {
      padding: 0.75rem 1.5rem;
      margin: 0 0.5rem;
      border: none;
      border-radius: 15px 15px;
      font-size: 1rem;
      cursor: pointer;
    }

    .cta-buttons .register {
      background-color: blue;
      color: white;
      text-decoration: none;
    }

    .cta-buttons .register:hover {
      background-color: white; 
      color: black; 
    }

    .cta-buttons .login {
      background-color: #2563eb;
      color: white;
      text-decoration: none;
    }

    .cta-buttons .login:hover {
      background-color: white; 
      color: black; 
    }

    .features, .testimonial, .gallery, .location {
      padding: 4rem 2rem;
      background: white;
      text-align: center;
    }

    .features h2, .testimonial h2, .gallery h2, .location h2 {
      font-size: 2rem;
      margin-bottom: 2rem;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem;
    }

    .features-grid div {
      padding: 1rem;
    }

    .testimonial {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
    }

    .testimonial blockquote {
      max-width: 400px;
      font-style: italic;
    }

    .testimonial img {
      width: 200px;
      height: auto;
      margin-left: 2rem;
    }

    .gallery-images {
      display: flex;
      justify-content: center;
      gap: 1rem;
    }

    .gallery-images img {
      width: 200px;
      height: auto;
      border-radius: 8px;
    }

    .location-content {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
    }

    .location-content iframe {
      border: none;
      width: 300px;
      height: 200px;
    }
    footer img{
      width: 360px;
      height: auto;

    }

    footer {
      background: #111;
      color: white;
      padding: 1rem;
      text-align: center;
    }

    footer nav a {
      color: white;
      margin: 0 1rem;
      text-decoration: none;
    }

    .About {
      background-color: black;
      padding: 5px  5px;
      border-radius: 5px 5px;
      color: white;
      margin: 5px;
    }

    .About:hover {
      background-color: yellow; 
      color: black;
    }
    
    .Services {
      background-color: black;
      padding: 5px  15px;
      border-radius: 5px 5px;
      color: white;
      margin: 5px;
    }

    .Services:hover {
      background-color: yellow; 
      color: black;
    }
    
    .Contact {
      background-color: black;
      padding: 5px  15px;
      border-radius: 5px 5px;
      color: white;
      margin: 5px;
    }

    .Contact:hover {
      background-color: yellow; 
      color: black;
    }
    
    .Register {
      background-color: black;
      padding: 5px  5px;
      border-radius: 5px 5px;
      color: white;
      margin: 5px;
    }

    .Register:hover {
      background-color: yellow; 
      color: black;
    }

  </style>
</head>
<body>
  <header>
    
    <h1>Welcome to<br><img src="image/FUERZA LOGO 2.png" alt=""></h1>
    <p>Train Smart. Live Strong.</p>
    <div class="cta-buttons">
      <a href="https://gym.werbest.xyz/register" class="register">Register</a>
      
      <a href="https://gym.werbest.xyz/login" class="login">Log in</a>
      
    </div>
  </header>

  <section class="features">
    <h2>Features</h2>
    <div class="features-grid">
      <div>
        <img src="image/qr-code.png" alt="QR Code">
        <h3>QR Code Equipment Scanning</h3>
        <p>Instant access to instructions</p>
      </div>
      <div>
        <img src="image/dumbbell.png" alt="Scheduling">
        <h3>Workout Recommendation</h3>
        <p>Get custom plans based on your goals</p>
      </div>
      <!--<div>
        <img src="https://img.icons8.com/ios-filled/50/diet.png" alt="Meal Plan">
        <h3>Meal Plans</h3>
        <p>Personalized based on fitness goals</p>
      </div>-->
      <div>
        <img src="image/combo-chart--v1.png" alt="Tracker">
        <h3>Progress Tracker</h3>
        <p>Visualize your fitness journey</p>
      </div>
    </div>
  </section>

  <!--<section class="testimonial">
    <h2>Testimonials</h2>
    <blockquote>
      “Fuerza Fitness Gym has transformed my workouts. The QR code scanning feature is incredibly convenient!”
    </blockquote>
    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d" alt="User Testimonial">
  </section>-->

 <!-- <section class="gallery">
    <h2>Gallery Preview</h2>
    <div class="gallery-images">
      <img src="https://images.unsplash.com/photo-1583454110551-21cf3c4d5d38" alt="Gym 1">
      <img src="https://images.unsplash.com/photo-1598970434795-0c54fe7c0642" alt="Gym 2">
      <img src="https://images.unsplash.com/photo-1617022459649-d5b151b7a2f5" alt="Gym 3">
    </div>
  </section>-->

  <section class="location">
    <h2>Gym Location & Hours</h2>
    <div class="location-content">
      <div>
        <p>Mon–Fri: 6am – 10pm<br>Sat–Sun: 6am – 8pm</p>
        <p>(122) 456-7890</p>
      </div>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3872.739040064942!2d121.49317797491054!3d13.914540386494542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd49abc72eab6b%3A0x33ded92298e3c0e!2sVilladiego&#39;s%20Bakery%20%26%20Pasalubong!5e0!3m2!1sen!2sph!4v1746607841184!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>

  <footer >
    <img src="image/FUERZA LOGO 2.png" alt="FUERZA">
    <nav>
      <a href="AboutUs.html" class = "About">AboutUs</a>
      <a href="#" Class = "Contact">Contact</a>
      <a href="#" Class = "Register">Register</a>
    </nav>
  </footer>
</body>
</html>