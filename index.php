<!DOCTYPE html>
<html>
    <!-- Begin Head -->
    <head>
        <title>Ana Sayfa</title>
        <?php
        require_once ('userDahilDosyalar.html');
        ?>
    </head>
    <!-- End Head -->

    <!-- Body -->
    <body data-ng-app="fotografRehber">

        <!--========== HEADER ==========-->
       <header class="navbar-fixed-top s-header-v2 js__header-sticky">
       <main-nav-bar color-class= "g-color--dark"></main-nav-bar>
       </header>
      <!--========== PROMO BLOCK ==========-->
        <div class="g-fullheight--md js__parallax-window" style="background: url(img/site/index.jpg) 50% 0 no-repeat fixed;">
            <div class="g-container--md g-text-center--xs g-ver-center--md g-padding-y-150--xs g-padding-y-0--md">
                <div class="g-margin-b-60--xs">
                    <h1 class="g-font-size-40--xs g-font-size-50--sm g-font-size-60--md g-color--dark g-letter-spacing--1">Fotoğrafçı Ara</h1>
                    <p class="g-font-size-18--xs g-font-size-26--md g-color--dark g-margin-b-0--xs">
						�iftlerin kendileri i�in en uygun foto�raf��y� bulmas�, foto�raf��lar�n daha fazla ki�iye ula�alabilir olmas� ve m��teri portf�y�n� geni�letmesi 
						i�in kurulmu� bir web sitesidir. </p>
                </div>
            </div>
        </div>
        <!--========== END PROMO BLOCK ==========-->
</body>
</html>