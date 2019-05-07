  <script src="<?= base_url('assets/js/jquery/jquery-3.3.1.min.js'); ?>"></script>
  <script src="<?= base_url('assets/boostrap4/popper.min.js'); ?>"></script>
  <script src="<?= base_url('assets/boostrap4/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/slick/slick.min.js'); ?>"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <script>
  
  $(document).ready(function(){
    $('.slider').slick({
      accessibility: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
    });
  });

  </script>

</body>
</html>