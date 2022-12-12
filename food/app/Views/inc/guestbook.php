<section class="testimonials testimonials-layout1 bg-overlay" style="background-image: url('/assets/images/backgrounds/1.jpg'); background-size: cover; background-position: center center;">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
        <div class="heading heading-layout1 text-center mb-50">
          <span class="heading__subtitle">People Talk</span>
          <h2 class="heading__title color-white">Our Guestbook</h2>
          <div class="heading__icon">
            <img src="/assets/images/shapes/shape2.png" alt="heading img">
          </div>
        </div><!-- /.heading -->
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <div class="row">

      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="carousel owl-carousel carousel-dots carousel-dots-light owl-loaded owl-drag" data-slide="3" data-slide-md="2" data-slide-sm="1" data-autoplay="true" data-nav="false" data-dots="true" data-space="30" data-loop="true" data-speed="800">
          <div class="owl-stage-outer">
            <div class="owl-stage" style="transform: translate3d(-1600px, 0px, 0px); transition: all 0.25s ease 0s; width: 3840px;">
              <?php foreach ($message as $ms): ?>
              <div class="owl-item cloned" style="width: 290px; margin-right: 30px;">
                <div class="testimonial-item">
                  <div class="testimonial__content">
                    <p class="testimonial__desc">“ <?= $ms['comment']; ?>”</p>
                    </div>
                    <div class="testimonial__meta">
                      <div class="testimonial__thumb">
                      </div>
                      <h5 class="testimonial__meta-title"><? $ms['uname'] ?></h5>
                    </div>
                  </div>

                </div>
                <?php endforeach; ?>
              </div>
            </div>
            </div><!-- /.carousel -->
          </div><!-- /.col-lg-12 -->

          <?php
          $uid =session()->get('uid');
           if($uid): ?>
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
          Post Comment</button>
        <?php endif; ?>
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section>
