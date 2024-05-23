<!DOCTYPE html>
<html lang="en">

<?php include 'config.php'; ?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Theirma - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Fancybox CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
  <script>
    $('[data-fancybox="images"]').fancybox({
      beforeLoad: function(instance, current) {
        if (current.src === '#') {
          current.src = current.opts.$orig.find('img').attr('src');
        }
      }
    });
  </script>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <h1><a href="index.php">Theirma</a></h1>
        <!-- <a href="index.html"><img src="assets/img/about.png" alt="" class="img-fluid"></a>-->
      </div>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
          <li><a class="nav-link scrollto" href="index.php#events">Events</a></li>
          <li><a class="nav-link scrollto" href="index.php#testimonials">Testimonials</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <?php
          if (isset($_SESSION['user_id'])) {
          ?>
            <li class="dropdown">
              <a href="#"><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="user.php">Edit Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
          <?php
          } else {
          ?>
            <li><a class="nav-link" href="login.php"><span class="login">Login</span></a></li>
          <?php
          }
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>Welcome to <span>Theirma</span></h1>
      <h2>Your ultimate platform for discovering and sharing events</h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= What We Do Section ======= -->
    <section id="what-we-do" class="what-we-do">
      <div class="container">
        <div class="section-title">
          <h2>What We Do</h2>
          <p>We connect generous donors with individuals and families in need during Ramadan</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Sharing Takjil</a></h4>
              <p>We facilitate the distribution of iftar meals to ensure everyone can break their fast with dignity.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Providing Groceries</a></h4>
              <p>We supply essential groceries to those in need, alleviating their burdens during the holy month.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Community Support</a></h4>
              <p>We create a network of support and compassion, fostering a sense of community and belonging.</p>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section><!-- End What We Do Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <img src="assets/img/about.png" class="img-fluid" width="500rem" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <h3>About Us</h3>
            <p>
              Theirma is a dedicated platform established to facilitate the sharing of takjil (iftar meals), groceries, and other essentials during the holy month of Ramadan.
            </p>
            <ul>
              <li><i class="bx bx-check-double"></i> We connect generous donors with individuals and families in need, ensuring efficient distribution.</li>
              <li><i class="bx bx-check-double"></i> Our process is designed to respect the dignity and privacy of all recipients.</li>
            </ul>
            <div class="row icon-boxes">
              <div class="col-md-6">
                <i class="bx bx-receipt"></i>
                <h4>Community Support</h4>
                <p>We strive to create a compassionate community by encouraging acts of kindness and generosity during Ramadan.</p>
              </div>
              <div class="col-md-6 mt-4 mt-md-0">
                <i class="bx bx-cube-alt"></i>
                <h4>Integrity and Trust</h4>
                <p>We uphold the highest standards of integrity, ensuring all contributions are used appropriately and transparently.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg mt-3">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <p>Sharing Blessings During Ramadan</p>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="icon-box">
              <i class="bi bi-briefcase"></i>
              <h4><a href="#">Our Service</a></h4>
              <p>Our platform connects those who wish to donate with those in need, making it easy to share blessings during Ramadan. We provide a seamless experience for donors and recipients alike, ensuring that every contribution makes a meaningful impact.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="bi bi-card-checklist"></i>
              <h4><a href="#">Community Support</a></h4>
              <p>We aim to alleviate the burdens of those who are struggling by providing essential items like food and groceries. Our service is designed to reduce the stress and hardships faced by many during this sacred month.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4">
            <div class="icon-box">
              <i class="bi bi-bar-chart"></i>
              <h4><a href="#">Convenient and Accessible</a></h4>
              <p>We prioritize user convenience, offering a straightforward and efficient process for both donors and recipients. By minimizing barriers to giving and receiving, we enhance the overall experience of Ramadan for everyone involved.
              </p>
            </div>
          </div>
          <div class="col-md-6 mt-4">
            <div class="icon-box">
              <i class="bi bi-binoculars"></i>
              <h4><a href="#">Compassionate Engagement</a></h4>
              <p>Theirma promotes a compassionate community where the spirit of giving is at the forefront. We encourage acts of kindness and generosity, helping to create a supportive network that extends beyond Ramadan.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4">
            <div class="icon-box">
              <i class="bi bi-brightness-high"></i>
              <h4><a href="#">Integrity and Trust</a></h4>
              <p>We uphold the highest standards of integrity, ensuring that all donations are used appropriately and reach those who need them most. Our platform is built on trust, transparency, and a genuine desire to help others.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4">
            <div class="icon-box">
              <i class="bi bi-calendar4-week"></i>
              <h4><a href="#">Dignity and Respect</a></h4>
              <p>Every person deserves to break their fast with dignity. Our services are designed to respect the privacy and dignity of recipients, ensuring they receive the support they need without any stigma or shame.</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
      <div class="container">

        <div class="section-title">
          <h2>Events</h2>
          <p>Discover our upcoming events and activities aimed at fostering community support during Ramadan</p>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <ul id="events-filters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-available">Available</li>
              <li data-filter=".filter-sold">Sold</li>
            </ul>
          </div>
        </div>

        <div class="row events-container">
          <?php foreach ($events as $event) {
            $filterClass = strtolower($event['status']) === 'available' ? 'filter-available' : 'filter-sold';
          ?>
            <div class="col-lg-4 col-md-6 events-item <?= $filterClass ?> wow fadeInUp">
              <div class="events-wrap">
                <figure>
                  <img src="data:image/png|jpg;base64,<?= base64_encode($event['pic']) ?>" class="img-fluid" alt="">
                  <a href="data:image/png|jpg;base64,<?= base64_encode($event['pic']) ?>" data-fancybox="images" data-type="image" data-src="#" class="link-preview events-lightbox"><i class="bx bx-plus"></i></a>
                  <a href="detailEvent.php?id=<?= $event['id'] ?>" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>
                <div class="events-info">
                  <h4><a href="detailEvent.php?id=<?= $event['id'] ?>"><?= $event['nameEvent'] ?></a></h4>
                  <p><?= $event['status'] ?></p>
                </div>
              </div>
            </div>
          <?php } ?>

          <div class="col-lg-4 col-md-6 events-item filter-sold wow fadeInUp" data-wow-delay="0.1s">
            <div class="events-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-2.jpg" class="link-preview events-lightbox" data-gallery="eventsGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="detailEvent.php" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>
              <div class="events-info">
                <h4><a href="detailEvent.php">Community Iftar</a></h4>
                <p>Sold</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 events-item filter-sold wow fadeInUp" data-wow-delay="0.2s">
            <div class="events-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-3.jpg" class="link-preview events-lightbox" data-gallery="eventsGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="detailEvent.php" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="events-info">
                <h4><a href="detailEvent.php">Educational Workshop</a></h4>
                <p>Education</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 events-item filter-sold wow fadeInUp">
            <div class="events-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-4.jpg" class="link-preview events-lightbox" data-gallery="eventsGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="detailEvent.php" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="events-info">
                <h4><a href="detailEvent.php">Food Distribution</a></h4>
                <p>Charity</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 events-item filter-sold wow fadeInUp" data-wow-delay="0.1s">
            <div class="events-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-5.jpg" class="link-preview events-lightbox" data-gallery="eventsGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="detailEvent.php" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="events-info">
                <h4><a href="detailEvent.php">Volunteer Meetup</a></h4>
                <p>Community</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 events-item filter-sold wow fadeInUp" data-wow-delay="0.2s">
            <div class="events-wrap">
              <figure>
                <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
                <a href="assets/img/portfolio/portfolio-6.jpg" class="link-preview events-lightbox" data-gallery="eventsGallery" title="Preview"><i class="bx bx-plus"></i></a>
                <a href="detailEvent.php" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
              </figure>

              <div class="events-info">
                <h4><a href="detailEvent.php">Youth Seminar</a></h4>
                <p>Education</p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Events Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Testimonials</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title">
          <h2>Team</h2>
          <p>Sit sint consectetur velit quos quisquam cupiditate nemo qui</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/team/team-1.jpg" alt="">
              <h4>Walter White</h4>
              <span>Chief Executive Officer</span>
              <p>
                Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/team/team-2.jpg" alt="">
              <h4>Sarah Jhinson</h4>
              <span>Product Manager</span>
              <p>
                Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/team/team-3.jpg" alt="">
              <h4>William Anderson</h4>
              <span>CTO</span>
              <p>
                Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Magnam dolores commodi suscipit eius consequatur ex aliquid fuga</p>
        </div>

        <div class="row mt-5 justify-content-center">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>A108 Adam Street<br>New York, NY 535022</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>info@example.com<br>contact@example.com</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 51<br>+1 5589 22475 14</p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row mt-5 justify-content-center">
          <div class="col-lg-10">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer style="background-color: rgba(29, 161, 146, 1)" class="text-white text-center py-3">
    <div class="container">
      <p>&copy; 2024 Theirma. All rights reserved.</p>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>`