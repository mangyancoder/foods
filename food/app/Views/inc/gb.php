<section class="testimonials testimonials-layout2 bg-overlay" style="background-image: url('/assets/images/backgrounds/15.jpg'); background-size: cover; background-position: center center;">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
        <div class="heading heading-layout1 text-center mb-50">
          <span class="heading__subtitle">People Talk</span>
          <h2 class="heading__title color-white">Our Guestbook</h2>
          <div class="heading__icon">
            <img src="assets/images/shapes/shape2.png" alt="heading img">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2">
        <div class="carousel owl-carousel owl-loaded owl-drag" data-slide="1" data-slide-md="1" data-slide-sm="1" data-autoplay="true" data-nav="false" data-dots="false" data-space="30" data-loop="true" data-speed="800">

          <div class="owl-stage-outer">
              <div class="owl-stage" style="transform: translate3d(-6080px, 0px, 0px); transition: all 0s ease 0s; width: 9120px;">
                <?php foreach ($message as $msg): ?>
                <div class="owl-item cloned" style="width: 730px; margin-right: 30px;"><div class="testimonial-item">
                  <div class="testimonial__content">
                    <div class="testimonial__rating">
                      <?php if($msg['rating'] =='1'): ?>
                        <i class="fa fa-star"></i>
                      <?php elseif($msg['rating'] =='2'): ?>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      <?php elseif($msg['rating'] =='3'): ?>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      <?php elseif($msg['rating'] =='4'): ?>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      <?php elseif($msg['rating'] =='5'): ?>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      <?php endif; ?>
                    </div>
                    <p class="testimonial__desc">“ <?= $msg['comment'] ?> ”</p>
                  </div>
                  <div class="testimonial__meta">
                    <!-- <div class="testimonial__thumb">
                    <img src="assets/images/testimonials/thumbs/2.png" alt="author thumb">
                  </div> -->
                  <h5 class="testimonial__meta-title"><?= $msg['uname'] ?></h5>
                  <p class="testimonial__meta-desc">Guest</p>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>

      </div>

      <center>
        <?php
        $cm = new \App\Models\Booking;

        $dg = $cm->where('userID', $uid)->where('bstatus', 'approved')->findAll();
        if($dg):
         ?>
        <button type="button" class="btn btn-info btn-lg selct" data-toggle="modal" data-target="#comment" >Rate Us</button>
      <?php endif; ?>
      </center>
      <div class="owl-nav disabled">
        <button type="button" role="presentation" class="owl-prev">
          <span aria-label="Previous">‹</span></button>
          <button type="button" role="presentation" class="owl-next">
            <span aria-label="Next">›</span></button>
          </div>
          <div class="owl-dots disabled"></div>
          <div class="owl-thumbs"></div>

        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="/comment" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12 col-md-6" style="font-size: 2em;">
                <h5>Rating</h5>
                <div id="review"></div>
            </div>

            <div class="col-12 col-md-6">
                <input type="hidden" name="rating" id="starsInput" class="form-control form-control-sm">

            </div>


        </div>
        <label>Comment</label>
        <textarea name="comment" rows="8" cols="80" placeholder="comment" class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Post</button>
      </div>
      </form>
    </div>
  </div>
</div>
