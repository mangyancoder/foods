<?= $this->include('inc/top') ?>
<?= $this->include('inc/header') ?>
<section class="page-title page-title-layout3 text-center bg-overlay bg-parallax bg-img" style="background-image: url('/assets/images/backgrounds/17.jpg'); background-size: cover; background-position: center center;">

      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1">
            <span class="pagetitle__subheading">Discover</span>
            <h1 class="pagetitle__heading"><?= $categories['cname'] ?></h1>
          </div>
        </div>
      </div>
    </section>
    <section class="text-block">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading heading-layout1 text-center">
                  <span class="heading__subtitle">Taste The Best</span>
                  <h2 class="heading__title">Discover our Foods</h2>
                  <div class="heading__icon">
                    <img src="/assets/images/shapes/shape2.png" alt="heading img">
                  </div>
                  <p class="heading__desc">Products and ingredients are sure that freshly pick to bring best foods for you.</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="portfolio portfolio-gallery">
        <div class="container">
        <?php foreach ($product as $pr): ?>


        <div class="row filtered-items-wrap" id="MixItUpD34BD5">
          <div class="col-sm-6 col-md-6 col-lg-4 mix filter-restaurant" style="display: inline-block;">
            <div class="portfolio-item">
              <div class="portfolio__img">
                <img src="/<?= $pr['picture'] ?>" alt="portfolio img">
              </div>
              <div class="portfolio__hover">
                <!-- <a href="/<?= $pr['picture'] ?>" data-lightbox="lightbox" class="zoom__icon"></a> -->
                <a href="/view/<?= $pr['pid'] ?>"class="zoom__icon"></a>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          <!--end foreach  -->
        </div>

        </div>
        </section>

<?= $this->include('inc/footer') ?>
