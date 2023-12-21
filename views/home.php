<?php 
// var_dump($_SESSION)
;
ob_start()?>
<section class="banner">
                <div class = "banner_text ">
                    <h2> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae consequuntur amet accusamus inventore fugit.</h2>
                    <p>Lorem ipsum dolor, sit amet consectetur</p>
                    <button> Réserver</button>
                </div>
                <div class="banner_img">
                    <img src="./assets/img/7732616_5243.svg" alt="" width="700px">
                </div>
        </section>
        <section class="gallery_slide">
            <h2 class="text-center last_model_title">Derniers modèles</h2>
            <!-- <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="./assets/img/velo1.jpg" alt="">
                        </div>
                        <div class="swiper-slide">
                             -->
</section>
<section id="bike_more_info">
    <h3>NOTRE GALERIE PHOTO</h3>
    <div class="Info">     
            <div class="more_info">
                <div class="img_info">
        
                </div>
                <div class="info_text">3
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident modi non molestiae alias? Ullam, debitis labore tenetur nam dolore officiis dolorem harum adipisci rem quae alias doloribus minima aperiam suscipit!
                </div>
            </div>
            <div class="more_info">
                <div class="img_info">
        
                </div>
                <div class="info_text">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident modi non molestiae alias? Ullam, debitis labore tenetur nam dolore officiis dolorem harum adipisci rem quae alias doloribus minima aperiam suscipit!
                </div>
            </div>
    </div>
</section>
<?php  $content = ob_get_clean()?>
