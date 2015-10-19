       </div><!--container-->

       <div id="site-footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-9 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-1">

                    <div class="row">

        <div class="col-lg-4">
            <h5 class="fw-400 gil">Features</h5>
            <?php wp_nav_menu(array('theme_location' => 'new-footer1', 'menu_class' => 'list-unstyled')); ?>

        </div><!--col 4-->

        <div class="col-lg-4">
            <h5 class="fw-400 gil">Reviews</h5>
            <?php wp_nav_menu(array('theme_location' => 'footer2', 'menu_class' => 'list-unstyled')); ?>

        </div><!--col 4-->

        <!--<div class="col-lg-2">
            <h5 class="fw-400 gil">Performance</h5>
            <ul class="list-unstyled">
                <li></li>
            </ul>
        </div><!--col 4

        <div class="col-lg-2">
            <h5 class="fw-400 gil">National</h5>
            <ul class="list-unstyled">
                <li></li>
            </ul>
        </div><!--col 4-->

        <div class="col-lg-4">
            <h1 class="dancing" id="footer-logo">exeunt</h1>
            <?php wp_nav_menu(array('theme_location' => 'footer4', 'menu_class' => 'list-unstyled')); ?>
            
        </div><!--col 4-->

        </div><!--row-->

        </div><!--col lg 8-->

        </div><!--row-->
        </div><!--container-->
       </div><!--site footer-->


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <!--<script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>-->
        <?php wp_footer(); ?>
    </body>
</html>