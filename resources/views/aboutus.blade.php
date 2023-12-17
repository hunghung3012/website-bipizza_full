@extends('layouts.layout1') 
@section('title', "About Us")  
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
<link rel="stylesheet" href="/css/navfoot.css">
<link rel="stylesheet" href="/css/aboutus.css">
<link rel="stylesheet" href="/css/grid.css">
@endsection
@section('js')
<script src="/js/navfoot.js" defer></script>
@endsection   
     
@section('content')
<div class="intro">
  <img
    src="images\pizza-slider-people-eating.jpg"
    alt=""
  />
  <p class="intro_text">
    <span class="text_title">About Us</span>
    <span class="text_sub"
      >BIẾT THÊM VỀ <br /><span class="special_text">Chúng Tôi</span> </span >
  </p>
</div>
      <section id="about-section" class="grid wide">
          <!-- about left  -->
          <div class="row">
              <div class="col l-6 m-12 c-12">
              <div class="about-left animation_item animate_item-left">
                  <div class="about-img">
                      <img src="https://i.pinimg.com/originals/d5/b0/4c/d5b04cc3dcd8c17702549ebc5f1acf1a.png" alt="">
                      <!-- <img src="https://catscanman.net/wp-content/uploads/2023/02/meme-meo-khoc-like-1024x1024.jpg" alt=""> -->
                  </div>
                  <div class="about_text">
                      <p class="first_text">Võ Nhật Hưng</p>
                      <p class="second_text">Tác Giả</p>
                      <div class="about_icon">
                          <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                          <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                          <a href="https://www.gmail.com/"><i class="fa-solid fa-envelope"></i></a>
  
                      </div>
                  </div>
              </div>
          </div>

          <!-- about right  -->
          <div class="col l-6 m-12 c-12">
          <div class="about-right animation_item animate_item-right">
              <h4>Chuyện Của Tôi</h4>
              <h1>Về Tôi</h1>
              <p>Cảm ơn bạn đã trải nghiệm trang web của tôi - Tác Giả
              </p>
              <div class="address">
                  <ul>
                      <li>
                          <span class="address-logo">
                              <i class="fas fa-paper-plane"></i>
                          </span>
                          <p>Address</p>
                          <span class="saprater">:</span>
                          <p>Trường Đại Học Việt Hàn</p>
                      </li>
                      <li>
                          <span class="address-logo">
                              <i class="fas fa-phone-alt"></i>
                          </span>
                          <p>Phone No</p>
                          <span class="saprater">:</span>
                          <p>+0123456789</p>
                      </li>
                      <li>
                          <span class="address-logo">
                              <i class="far fa-envelope"></i>
                          </span>
                          <p>Email ID</p>
                          <span class="saprater">:</span>
                          <p>vonhathung@gmail.com</p>
                      </li>
                  </ul>
              </div>
              <div class="expertise">
                  <h3>My Expertise</h3>
                  <ul>
                      <li>
                          <span class="expertise-logo">
                              <i class="fab fa-html5"></i>
                          </span>
                          <p>HTML</p>
                      </li>
                      <li>
                          <span class="expertise-logo">
                              <i class="fab fa-css3-alt"></i>
                          </span>
                          <p>CSS</p>
                      </li>
                      <li>
                          <span class="expertise-logo">
                              <i class="fab fa-node-js"></i>
                          </span>
                          <p>Java Script</p>
                      </li>
                      
                  </ul>
              </div></div></div>
          </div>
      </section>

      <section class="google-map animation_item animate_item-top">
          <div class="mapouter"><div class="gmap_canvas">
              <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Tr%C6%B0%E1%BB%9Dng%20%C4%91%E1%BA%A1i%20h%E1%BB%8Dc%20vi%E1%BB%87t%20h%C3%A0n&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://getasearch.com/fmovies"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:100%;}</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></div>
      </section>
      <div class="overlay"></div>
     
@endsection