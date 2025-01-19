  <footer class="footer section" id="footer">
    <div class="section__content">
      <div class="footer__items">
        <div class="footer__items__menu">
          <h3>
            Покупателю
          </h3>
          <?php 
            wp_nav_menu( 
              array(
                'theme_location' => 'bottom-menu-1',
              )
            );
          ?> 
        </div>
        <div class="footer__items__info">
          <h3>
            Информация
          </h3>
          <?php 
            wp_nav_menu( 
              array(
                'theme_location' => 'bottom-menu-2',
              )
            );
          ?> 
        </div>
        <div class="footer__items__schedule">
            <h3>
              График работы
            </h3>
            <?php 
            wp_nav_menu( 
              array(
                'theme_location' => 'bottom-menu-3',
              )
            );
          ?> 
        </div>
        <div class="footer__items__contacts">
            <h3>
              Контакты
            </h3>
            <?php 
            wp_nav_menu( 
              array(
                'theme_location' => 'bottom-menu-4',
              )
            );
          ?> 
        </div>
      </div>
    </div>
  </footer>
  <?php wp_footer(); ?>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</body>
</html>