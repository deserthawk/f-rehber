<!DOCTYPE html>
<html>
<!-- Begin Head -->
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125243469-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125243469-1');
</script>
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
		<main-nav-bar color-class="g-color--dark"></main-nav-bar>
	</header>
	<!--========== PROMO BLOCK ==========-->
	<div class="g-fullheight--md js__parallax-window"
		style="background: url(img/site/index.jpg) 50% 0 no-repeat fixed;">
		<div class="g-container--md g-text-center--xs g-ver-center--md g-padding-y-150--xs g-padding-y-0--md">
                <div class="g-margin-b-60--xs">
                    <h1 class="g-font-size-24--xs g-color--dark g-letter-spacing--1  g-margin-b-30--xs">Mükemmel Düğününüz İçin, Mükemmel Fotoğrafçınızı Buldunuz Mu?</h1>
                    <p class="g-font-size-18--xs g-color--dark g-margin-b-20--xs">Sitedeki fotoğraflardan ilham alın</p>
                    <p class="g-font-size-18--xs g-color--dark g-margin-b-20--xs">İyi bir fotoğrafçı aramanın stresinden kurtulun</p>
                    <p class="g-font-size-18--xs g-color--dark g-margin-b-20--xs">Zamandan tasarruf edin</p>
                    <p class="g-font-size-18--xs g-color--dark g-margin-b-20--xs"><a href="fotografcilistesi.php">Fotoğrafçı aramak için tıklayın</a></p>
                </div>
            </div>
	</div>
	<!--========== END PROMO BLOCK ==========-->
</body>
</html>