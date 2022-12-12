<div class="col-md-12 col-lg-12">
<div class="row row-cols-1">
   <div class="overflow-hidden d-slider1 ">
      <ul  class="p-0 m-0 mb-2 swiper-wrapper list-inline">
         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
             <a href="<?=base_url()?>/admin/pbooking">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="10" data-type="percent">
                     <svg class="card-slie-arrow " width="24" height="24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Pending Booking </p>
                     <h4 class="counter"><?=$bookcount['count']?></h4>
                  </div>
               </div>
            </div>
            </a>
         </li>
         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
           <a href="<?=base_url()?>/admin/cbooking">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-03" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                     <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Incoming Appointment</p>
                     <h4 class="counter"><?=$scount['count']?></h4>
                  </div>
               </div>
            </div>
            </a>
         </li>
         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
           <a href="<?=base_url()?>/admin/pending">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                     <svg class="card-slie-arrow " width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Pending Orders</p>
                     <h4 class="counter"><?=$pcount['count']?></h4>
                  </div>
               </div>
            </div>
            </a>
         </li>
         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
           <a href="<?=base_url()?>/admin/processing">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                     <svg class="card-slie-arrow " width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Processing</p>
                     <h4 class="counter"><?=$pprocess['count']?></h4>
                  </div>
               </div>
            </div>
            </a>
         </li>
         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
           <?php $today = date('Y-m-d'); ?>
          <a href="<?= base_url() ?>/admin/dailysales/<?=$today?>">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-04" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                     <svg class="card-slie-arrow " width="24px" height="24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Daily Sales</p>
                     <h4 class="counter">₱ <?=$dsalescount['price']?></h4>
                  </div>
               </div>
            </div>
            </a>
         </li>
         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
           <a href="<?= base_url()?>/admin/netsales">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-05" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="50" data-type="percent">
                     <svg class="card-slie-arrow " width="24px" height="24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Net Sales</p>
                     <h4 class="counter">₱ <?=$net['sales']?></h4>
                  </div>
               </div>
            </div>
            </a>
         </li>
         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-06" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="40" data-type="percent">
                     <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Today</p>
                     <h4 class="counter">$4600</h4>
                  </div>
               </div>
            </div>
         </li>
         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-07" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="30" data-type="percent">
                     <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Members</p>
                     <h4 class="counter">11.2M</h4>
                  </div>
               </div>
            </div>
         </li>
      </ul>
      <div class="swiper-button swiper-button-next"></div>
      <div class="swiper-button swiper-button-prev"></div>
   </div>
</div>
</div>
