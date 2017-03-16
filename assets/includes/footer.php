<!--start footer-->
				<div class="footer ">
					<div class="container">
						<div class="row">
							<div class="col-lg-3  col-xs-6 ">
								<p><a href=""> CTeam</a> تصميم وبرمجه </p>
							</div>
							<div class="col-lg-3 col-xs-6">
								<p>جميع الحقوق محفوظة لـ <a href="">جامع القطان</a> </p>
							</div>
						</div>
					</div>          
				</div>
			</div>
		</section>
        <!--end footer-->
        <!--end section 4-->
        <script src="<?php echo $js?>jquery-3.1.1.min.js"></script>
        <script src="<?php echo $js?>bootstrap.min.js"></script>
        <script src="<?php echo $js?>HijirC.js"></script>
        <script src="<?php echo $js?>plugins.js"></script>
        <?php
            if(isset($scripts)){
                if(is_array($scripts)){
                    foreach($scripts as $script){?>
                        <script src="<?php echo $js . $script ?>.js"></script>
                <?php }}else{ ?>
                        <script src="<?php echo $js . $scripts ?>.js"></script>
                    <?php }
                }
        ?>
	</body>
</html>