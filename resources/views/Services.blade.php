<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services</title>
  <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css')}}">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f3f3f3;
    }

    .container {
      padding: 20px;
    }

    h2 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #000;
    }

    .slick-slide {
      padding: 10px;
    }

    .card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 16px;
      text-align: center;
    }

    .card p {
      font-size: 16px;
      color: #333;
    }

    .card button {
      margin-top: 12px;
      background: #000;
      color: #fff;
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .card button:hover {
      background: #444;
    }

    .coming-soon {
      position: relative;
      background: #444;
      color: #fff;
      height: 120px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 8px;
    }

    .coming-soon::after {
      content: "Coming soon! Stay tuned";
      font-size: 18px;
      position: absolute;
    }
  </style>
</head>
<body>
  <div class="container">
    <section>
      <h2>Places to Stay</h2>
      <div class="slider">
        <!-- Hotel Cards -->
        <div class="card">
          <p>Hotel A - Comfortable and cozy rooms in the city center.</p>
          <button onclick="bookNow('Hotel A', 120)">Book now!</button>
        </div>
        <!-- Repeat for Hotel B, C, etc. -->
      </div>
    </section>

    <section>
      <h2>Booking Cars</h2>
      <div class="slider">
        <!-- Car Cards -->
        <div class="card">
          <p>Car A - Compact and efficient for city travel.</p>
          <button onclick="bookNow('Car A', 50)">Book now!</button>
        </div>
        <!-- Repeat for Car B, C, etc. -->
      </div>
    </section>

    <section>
      <h2>Plane Tickets</h2>
      <div class="slider">
        <!-- Coming Soon Cards -->
        <div class="coming-soon"></div>
        <!-- Repeat for other "coming soon" placeholders -->
      </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 5,
            },
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
            },
          },
        ],
      });
    });

    function bookNow(title, price) {
      alert(`Booking ${title} for $${price}`);
    }
  </script>
</body>
</html>