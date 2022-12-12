<header class="header header-transparent header-layout1">
  <nav class="navbar navbar-expand-lg sticky-navbar">
    <div class="container">
      <a class="navbar-brand" href="<?=base_url()?>">
        <img src="/assets/images/backgrounds/logo.png" width="180" class="logo-light" alt="logo">
        <img src="/assets/images/backgrounds/logo.png" width="180" class="logo-dark" alt="logo">
      </a>
      <button class="navbar-toggler" type="button">
        <span class="menu-lines"><span></span></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNavigation">
        <ul class="navbar-nav ml-auto">
          <li class="nav__item with-dropdown">
            <a href="<?=base_url()?>" data-toggle="dropdown" class="dropdown-toggle nav__item-link active">Home</a>
          </li>
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Menu</a>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="<?= base_url() ?>/products" class="nav__item-link">Food Products</a></li>
              <li class="nav__item"><a href="<?=base_url('packages')?>" class="nav__item-link">Bilao Packages</a></li>
            </ul>
          </li>
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Gallery</a>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="gallery-grid.html" class="nav__item-link">Gallery grid</a></li>
              <li class="nav__item"><a href="gallery-fullwidth.html" class="nav__item-link">Gallery Fullwidth</a>
              </li>
            </ul>
          </li>
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Blog</a>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="blog-carousel.html" class="nav__item-link">blog carousel</a></li>
              <li class="nav__item dropdown-submenu">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Blog Grid</a>
                <ul class="dropdown-menu">
                  <li class="nav__item">
                    <a href="blog-grid-sidebar.html" class="nav__item-link">Grid Sidebar</a>
                  </li>
                  <li class="nav__item">
                    <a href="blog-grid.html" class="nav__item-link">No Sidebar</a>
                  </li>
                </ul>
              </li>
              <li class="nav__item"><a href="blog-standard.html" class="nav__item-link">blog standard</a></li>

              <li class="nav__item"><a href="blog-single-post.html" class="nav__item-link">single post</a></li>
            </ul>
          </li>
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Shop</a>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="/orders" class="nav__item-link">our Shop</a></li>

              <li class="nav__item"><a href="/mybooking" class="nav__item-link">Shop with Sidebar</a></li>

              <li class="nav__item"><a href="shop-single-product.html" class="nav__item-link">Single Product</a>
              </li>
              <li class="nav__item"><a href="shopping-cart.html" class="nav__item-link">cart</a></li>

            </ul>
          </li>
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">About</a>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="our-story.html" class="nav__item-link">our story</a></li>

              <li class="nav__item"><a href="our-chefs.html" class="nav__item-link">Our chefs</a></li>

              <li class="nav__item"><a href="our-guestbook.html" class="nav__item-link">Our Guestbook</a></li>

              <li class="nav__item"><a href="contacts.html" class="nav__item-link">Contact Us</a></li>

              <li class="nav__item"><a href="events.html" class="nav__item-link">Events</a></li>

              <li class="nav__item"><a href="event-single.html" class="nav__item-link">Event Single</a></li>

              <li class="nav__item"><a href="faqs.html" class="nav__item-link">FAQs</a></li>
            </ul>
          </li>
          <?php
            $isLoggedIn = session()->get('isLoggedIn');
            $user =session()->get('type');
            $uid =session()->get('uid');
            if($isLoggedIn):
          ?>
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Account</a>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="/orders" class="nav__item-link">Orders</a></li>
              <li class="nav__item"><a href="/mybooking" class="nav__item-link">Booking</a></li>
              <li class="nav__item"><a href="shopping-cart.html" class="nav__item-link">Account Information</a></li>

            </ul>
          </li>
        <?php endif; ?>

        </ul><!-- /.navbar-nav -->
      </div><!-- /.navbar-collapse -->
      <div class="navbar-actions-wrap">
        <div class="navbar-actions d-flex align-items-center">
          <?php
            $isLoggedIn = session()->get('isLoggedIn');
            $user =session()->get('type');
            $uid =session()->get('uid');
            if($isLoggedIn):
          ?>
          <a href="<?=base_url()?>/cart" class="navbar__action-btn">Cart <em><?=$count['count']?></em></a>
          <?php endif; ?>
        </div>
      </div>
      <div class="navbar-actions-wrap">
        <div class="navbar-actions d-flex align-items-center">
          <?php
            $isLoggedIn = session()->get('isLoggedIn');
            $user =session()->get('type');
            $uid =session()->get('uid');
            if($isLoggedIn):
          ?>
          <a href="<?=base_url()?>/logout" class="navbar__action-btn">Logout</a>

        <?php else: ?>
          <a href="<?=base_url()?>/login" class="navbar__action-btn  hamburger-menu-trigger">Login</a>
        <?php endif; ?>
          <!-- <a href="#" class="navbar__action-btn hamburger-menu-trigger"><i class="fa fa-bars"></i></a> -->
        </div><!-- /.navbar-actions -->
      </div><!-- /.navbar-actions-wrap -->
    </div><!-- /.container -->
  </nav><!-- /.navabr -->
</header><!-- /.Header -->
