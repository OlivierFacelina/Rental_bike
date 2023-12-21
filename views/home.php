<?php 
// var_dump($_SESSION)
;
ob_start()?>
<section id="banner">
                <div class = "banner__text ">
                    <h2>Lorem Ipsum</h2>
                    <h3> <span>Lorem ipsum dolor,</span> sit amet <br>consectetur adipisicing elit Repudiandae.<br> Repudiandae <span>consequuntur amet.</span></h3>
                    <p>Lorem ipsum dolor, sit amet consectetur</p>
                    <button class="btn btn-success"> Réserver</button>
                </div>
                <div class="banner_img">
                    <img src="./assets/img/7732616_5243.svg" alt="" width="650px">
                </div>
        </section>
        <section id="gallery_slide">
            <h2 class="text-center last_model_title">Derniers modèles</h2>
            <div class="slider">
                <img src="./assets/img/bike1.jpg" alt="" srcset="" width="300px">
                <img src="./assets/img/bike1.jpg" alt="" srcset="" width="300px">
                <img src="./assets/img/bike1.jpg" alt="" srcset="" width="300px">
                <img src="./assets/img/bike1.jpg" alt="" srcset="" width="300px">
                <img src="./assets/img/bike1.jpg" alt="" srcset="" width="300px">
                <img src="./assets/img/bike1.jpg" alt="" srcset="" width="300px">
            </div>
            <!-- <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="./assets/img/velo1.jpg" alt="">
                        </div>
                        <div class="swiper-slide">
                            -->
</section>
<section id="bike_more_info">
    <h3 class="text-center mt-5 mb-3">NOTRE GALERIE PHOTO</h3>
    <div class="Info">     
            <div class="more_info">
                <div class="img_info">
                <img src="./assets/img/bike1.jpg" alt="" srcset="" width="600px" height="400px">
                </div>
                <div class="info_text">
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident modi non molestiae alias? Ullam, debitis labore tenetur nam dolore officiis dolorem harum adipisci rem quae alias doloribus minima aperiam suscipit!
                        rem quae alias doloribus minima aperiam suscipit!
                    </p>
                </div>
            </div>
            <div class="more_info">
                <div class="info_text">
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident modi non molestiae alias? Ullam, debitis labore tenetur nam dolore officiis dolorem harum adipisci rem quae alias doloribus minima aperiam suscipit!
                        rem quae alias doloribus minima aperiam suscipit!
                    </p>
                </div>
                <div class="img_info">
                <img src="./assets/img/bike1.jpg" alt="" srcset="" width="600px">
                </div>
            </div>
    </div>
</section>
<?php  $content = ob_get_clean()?>
