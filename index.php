<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AgroPark | Smart Agro E-Commerce</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <style>
    /* Hero Section */
    .hero {
      height: 90vh;
      background: linear-gradient(rgba(44, 95, 45, 0.65), rgba(44, 95, 45, 0.65)),
        url('assets/silo.jpg') center/cover no-repeat;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      animation: fadeIn 1.2s ease-in;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 1rem;
      letter-spacing: 1px;
    }

    .hero p {
      font-size: 1.2rem;
      max-width: 600px;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    .hero .btn {
      background: #97bc62;
      color: white;
      padding: 0.8rem 1.5rem;
      border-radius: 50px;
      font-weight: 600;
      text-decoration: none;
      transition: background 0.3s ease, transform 0.2s;
    }

    .hero .btn:hover {
      background: #7fa14c;
      transform: scale(1.05);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* About Section */
    .about {
      padding: 4rem 2rem;
      max-width: 1000px;
      margin: auto;
      text-align: center;
      animation: fadeIn 1s ease-in;
    }

    .about h2 {
      color: #2c5f2d;
      margin-bottom: 1rem;
      font-size: 2rem;
    }

    .about p {
      color: #444;
      line-height: 1.7;
      font-size: 1.1rem;
    }

    /* Featured Products Section */
    .featured {
      background: #f5f9f4;
      padding: 4rem 2rem;
    }

    .featured h2 {
      text-align: center;
      color: #2c5f2d;
      margin-bottom: 2rem;
    }

    .product-preview-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 2rem;
      max-width: 1100px;
      margin: auto;
    }

    .product-preview {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-preview:hover {
      transform: translateY(-8px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .product-preview img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .product-preview h3 {
      color: #2c5f2d;
      margin: 1rem 0 0.5rem;
    }

    .product-preview p {
      color: #666;
      margin-bottom: 1rem;
    }

    .product-preview a {
      display: inline-block;
      background: url('assets\silo.jpg');
      color: #fff;
      padding: 0.6rem 1.2rem;
      border-radius: 5px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    .product-preview a:hover {
      background: #7fa14c;
    }

    /* Footer */
    footer {
      background: #2c5f2d;
      color: white;
      text-align: center;
      padding: 1.5rem;
      margin-top: 3rem;
    }
    /* Featured Products Slider */
.slider-container {
  position: relative;
  overflow: hidden;
  max-width: 1000px;
  margin: 0 auto;
}

.slider {
  display: flex;
  transition: transform 0.6s ease-in-out;
}

.slide {
  min-width: 100%;
  box-sizing: border-box;
  background: #fff;
  border-radius: 10px;
  margin: 0 10px;
  text-align: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  padding-bottom: 1rem;
}

.slide img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  border-radius: 10px 10px 0 0;
}

.slide h3 {
  margin: 1rem 0 0.5rem;
  color: #2c5f2d;
}

.slide p {
  color: #666;
  margin-bottom: 1rem;
}

.slide a {
  display: inline-block;
  background: #97bc62;
  color: #fff;
  padding: 0.6rem 1.2rem;
  border-radius: 5px;
  text-decoration: none;
  font-weight: 500;
  transition: 0.3s;
}

.slide a:hover {
  background: #7fa14c;
}

/* Slider Controls */
.prev, .next {
  position: absolute;
  top: 45%;
  background: rgba(44, 95, 45, 0.7);
  color: white;
  border: none;
  padding: 0.8rem;
  border-radius: 50%;
  cursor: pointer;
  font-size: 1.5rem;
  transition: background 0.3s;
}

.prev:hover, .next:hover {
  background: rgba(151, 188, 98, 0.9);
}

.prev { left: 10px; }
.next { right: 10px; }

  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <nav class="navbar">
      <div class="logo">🌾 AgroPark</div>
      <ul class="nav-links">
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="cart.php">Cart 🛒</a></li>
       <!-- <li><a href="register.php">Register</a></li>-->
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <h1>Welcome to AgroPark</h1>
    <p>Connecting farmers, suppliers, and customers in one smart marketplace for quality agricultural products.</p>
    <a href="products.php" class="btn">Shop Now</a>
  </section>

  <!-- About Section -->
  <section class="about">
    <h2>About AgroPark</h2>
    <p>
      AgroPark is a next-generation agro-industrial e-commerce platform dedicated to empowering local farmers and agri-suppliers. We make it easy to buy and sell seeds, fertilizers, livestock, and agricultural tools — helping grow your business sustainably and efficiently.
    </p>
  </section>

<!-- Featured Products — Modern Fade Carousel -->
<section class="featured-carousel">
  <h2>Featured Products</h2>

  <?php
  // load products (server-side)
  include 'db_connect.php';
  $res = $conn->query("SELECT id,name,price,image,description FROM products ORDER BY id DESC LIMIT 6");
  $slides = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];

  // default fallback images (use existing assets you already have)
  $defaults = [
    'assets/SeedCo.webp',
    'assets/urea.jpg',
    'assets/yoghurt.webp',
    'assets/mashona.webp',
    'assets/hoe.webp',
    'assets/SeedCo.webp'
  ];
  ?>

  <div class="carousel-wrap" id="fadeCarousel">
    <div class="slides">
      <?php
      $i = 0;
      if (!empty($slides)) {
        foreach ($slides as $row) {
          // resolve image path safely
          $img = $row['image'] ?? '';
          $imgPath = '';

          // try exact value (if stored as full path)
          if ($img && file_exists(__DIR__ . '/' . $img)) {
            $imgPath = $img;
          }
          // try in uploads folder
          elseif ($img && file_exists(__DIR__ . '/uploads/' . $img)) {
            $imgPath = 'uploads/' . $img;
          }
          // try in assets
          elseif ($img && file_exists(__DIR__ . '/assets/' . $img)) {
            $imgPath = 'assets/' . $img;
          }
          // fallback to default images by index
          else {
            $imgPath = $defaults[$i % count($defaults)];
          }

          $title = htmlspecialchars($row['name']);
          $price = number_format((float)$row['price'], 2);
          $desc = htmlspecialchars(strlen($row['description'])>120 ? substr($row['description'],0,120)."..." : $row['description']);
          echo "
            <div class='slide' data-index='{$i}' style='background-image:url(\"{$imgPath}\")'>
              <div class='overlay'>
                <div class='meta'>
                  <h3>{$title}</h3>
                  <p class='desc'>{$desc}</p>
                  <p class='price'>\${$price}</p>
                  <a class='btn' href='products.php'>View Collection</a>
                </div>
              </div>
            </div>
          ";
          $i++;
        }
      } else {
        // no products — show default slides
        foreach ($defaults as $k => $d) {
          echo "
            <div class='slide' data-index='{$k}' style='background-image:url(\"{$d}\")'>
              <div class='overlay'>
                <div class='meta'>
                  <h3>Quality Agricultural Goods</h3>
                  <p class='desc'>Explore seeds, fertilizers, tools and more — directly from AgroPark suppliers.</p>
                  <a class='btn' href='products.php'>Shop Now</a>
                </div>
              </div>
            </div>
          ";
        }
      }
      ?>
    </div>

    <!-- controls -->
    <button class="cnav prev" id="carouselPrev" aria-label="Previous slide">‹</button>
    <button class="cnav next" id="carouselNext" aria-label="Next slide">›</button>

    <!-- dots -->
    <div class="dots" id="carouselDots">
      <?php for ($d=0;$d<$i;$d++): ?>
        <button class="dot" data-index="<?= $d ?>"></button>
      <?php endfor; ?>
    </div>
  </div>
</section>

<style>
/* ===== Carousel Styles ===== */
.featured-carousel { padding: 2rem 1rem 4rem; max-width:1200px; margin: 0 auto; }
.featured-carousel h2 { text-align:center; color:#2c5f2d; margin-bottom:1rem; font-size:1.8rem; }

/* carousel container */
.carousel-wrap { position: relative; overflow: hidden; border-radius:12px; }

/* slides container (stacked) */
.slides { position: relative; height: 420px; }
.slide {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  opacity: 0;
  transform: scale(1.02);
  transition: opacity 900ms ease, transform 900ms ease;
  display: flex;
  align-items: center;
  justify-content: center;
}
.slide.active { opacity: 1; transform: scale(1); z-index: 2; }

/* gradient overlay for legibility */
.slide .overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.45) 60%, rgba(0,0,0,0.6) 100%);
  display:flex;
  align-items:center;
  justify-content:flex-start;
}
.slide .meta {
  color: #fff;
  padding: 2rem;
  max-width: 560px;
  margin-left: 4%;
  border-radius: 8px;
  backdrop-filter: blur(4px);
}
.slide .meta h3 { margin: 0 0 0.5rem; font-size: 1.8rem; letter-spacing:0.4px; }
.slide .meta .desc { margin: 0 0 0.7rem; color: rgba(255,255,255,0.9); font-size:0.96rem; line-height:1.45; }
.slide .meta .price { font-weight:700; margin-bottom:0.8rem; font-size:1.05rem; }
.slide .meta .btn { display:inline-block; background:#97bc62; color:#fff; padding:0.6rem 1rem; border-radius:6px; text-decoration:none; font-weight:600; }
.slide .meta .btn:hover { background:#7fa14c; transform:translateY(-2px); }

/* nav buttons */
.cnav { position:absolute; top:50%; transform:translateY(-50%); background:rgba(44,95,45,0.8); color:#fff; border:none; width:44px; height:44px; border-radius:50%; font-size:26px; cursor:pointer; display:flex; align-items:center; justify-content:center; z-index:5; }
.cnav:hover { background:rgba(44,95,45,1); }
.prev { left: 16px; }
.next { right: 16px; }

/* dots */
.dots { position: absolute; left:50%; transform:translateX(-50%); bottom:14px; display:flex; gap:8px; z-index:6; }
.dot { width:10px; height:10px; border-radius:50%; border:1px solid rgba(255,255,255,0.7); background:transparent; cursor:pointer; padding:0; }
.dot.active { background:#97bc62; border-color:#97bc62; }

/* responsive */
@media (max-width:900px) {
  .slides { height: 300px; }
  .slide .meta { padding:1rem; margin-left:3%; max-width:70%; }
  .slide .meta h3 { font-size:1.2rem; }
}
@media (max-width:480px) {
  .slides { height: 240px; }
  .cnav { width:38px; height:38px; font-size:20px; }
  .slide .meta { display:none; } /* hide overlay text on tiny screens for clarity */
}
</style>

<script>
// ===== Carousel JS =====
(function(){
  const carousel = document.getElementById('fadeCarousel');
  if (!carousel) return;
  const slides = carousel.querySelectorAll('.slide');
  const prev = document.getElementById('carouselPrev');
  const next = document.getElementById('carouselNext');
  const dotsWrap = document.getElementById('carouselDots');
  const dots = dotsWrap ? dotsWrap.querySelectorAll('.dot') : [];
  let idx = 0;
  const total = slides.length || 1;
  let autoplay = true;
  let timer = null;
  const interval = 4500;

  function setActive(i) {
    slides.forEach(s => s.classList.remove('active'));
    if (dots) dots.forEach(d => d.classList.remove('active'));
    idx = (i + total) % total;
    slides[idx].classList.add('active');
    if (dots[idx]) dots[idx].classList.add('active');
  }

  // init
  if (total>0) {
    setActive(0);
    if (dots.length === 0 && total>1) {
      // create dot controls if not rendered
      const dotsContainer = document.getElementById('carouselDots');
      for (let i=0;i<total;i++){
        const b = document.createElement('button'); b.className='dot'; b.dataset.index=i;
        dotsContainer.appendChild(b);
        b.addEventListener('click', () => { setActive(i); resetTimer(); });
      }
    }
  }

  prev.addEventListener('click', ()=> { setActive(idx-1); resetTimer(); });
  next.addEventListener('click', ()=> { setActive(idx+1); resetTimer(); });

  // dot clicks
  dots.forEach((d,i)=> d.addEventListener('click', ()=> { setActive(i); resetTimer(); }));

  function startTimer(){
    if (!autoplay || total<=1) return;
    timer = setInterval(()=> { setActive(idx+1); }, interval);
  }
  function resetTimer(){
    if (timer) clearInterval(timer);
    startTimer();
  }
  // pause on hover
  carousel.addEventListener('mouseenter', ()=> { if (timer) clearInterval(timer); });
  carousel.addEventListener('mouseleave', ()=> { resetTimer(); });

  // start
  startTimer();
})();
</script>



  <!-- Footer -->
  <footer>
    © 2025 Agro Industrial Park | All Rights Reserved
  </footer>

  <script>
const slider = document.getElementById("featuredSlider");
const slides = document.querySelectorAll(".slide");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

let index = 0;
function showSlide(i) {
  if (i >= slides.length) index = 0;
  else if (i < 0) index = slides.length - 1;
  else index = i;
  slider.style.transform = `translateX(${-index * 100}%)`;
}

nextBtn.addEventListener("click", () => showSlide(index + 1));
prevBtn.addEventListener("click", () => showSlide(index - 1));

// Auto-slide every 5 seconds
setInterval(() => showSlide(index + 1), 5000);
</script>

</body>
</html>

