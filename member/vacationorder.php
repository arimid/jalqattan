<?php
    $assets = '../assets/';
    $pageTitle = 'طلب إجازة';
    $pages = ['الموظفين',$pageTitle];
    $pageStyle = 'inLine';
    $styles = ['header','addVacation','classic','classic.date','rtl','footer'];
    $scripts = ['picker','picker.date','ar','datepick'];
    require_once $assets . 'includes/head.php';
    require_once $includes . 'connect.php';
    if(isset($_SESSION['username'])){
    if($_SESSION['rank'] == 1){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                if(!isset(explode(' ', $_POST['date'])[1]) || !isset(explode(' ', $_POST['date'])[2])){
                    $_SESSION['error'] = 'لم يتم اختيار تاريخ يرجى اختيار تاريخ و إعادة المحاولة';
                    $_SESSION['error'] .= '<br>';
                }else{
                    $day = explode(' ', $_POST['date'])[2];
                    $month = explode(' ', $_POST['date'])[1];
                    $year = explode(' ', $_POST['date'])[0];
                    $months = ["يناير","فبراير","مارس","ابريل","مايو","يونيو","يوليو","اغسطس","سبتمبر","اكتوبر","نوفمبر","ديسمبر"];
                    if(in_array($month, $months)){
                    $month = array_search($month, $months) + 1;
                    if($month < 10){
                        $month = '0' . $month;
                    }
                }
            $date = $year . $month . $day;}
            $kind = $_POST['kind'];
            $dur = $_POST['dur'];
            $User = $_SESSION['id'];
            $getLast = 'SELECT MAX(order_ID) FROM vacas';
            $getLast = $db->query($getLast);
            /* @var $db PDO*/
            $getLast = $getLast->fetchColumn();
            $getLast = $getLast + 1;
            $insertQuery = "INSERT INTO vacas VALUES ('$User','$getLast','$kind','$dur','$date','0')";
            $insertQuery = $db->prepare($insertQuery);
            $insertQuery = $insertQuery->execute();
            if($insertQuery){
                $_SESSION['success'] = 'تم إضافة طلب ألاجازة بنجاح';
            }
            header('location: '.$_SERVER['PHP_SELF']);
    }else{
    ?>

<!--stat admin area-->
				<div class="container">
					<div class="row" >	
							<div class="adpart col-lg-12 col-md-12 col-sm-12 ">
                                                            <form id="form1" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
									<h2 class="text-center"><?php echo $pageTitle?></h2>
                                                                        <?php
                                                                            if(isset($_SESSION['error'])){ ?>
                                                                        <div class="text-center alert alert-danger"><?php echo $_SESSION['error']?></div>
                                                                            <?php }elseif (isset($_SESSION['success'])) {?>
                                                                                        <div class="text-center alert alert-success"><?php echo $_SESSION['success']?></div>
                                                                                    <?php }
                                                                        ?>
									<div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-3 ">
										<label for="daate">التاريخ</label>
										<input name="date" id="daate" type="date" class="datepicker" placeholder="التاريخ" minlength="2" required>
                                                                                
									<label for="kind-holyday">نوعها</label>
										<input name="kind" id="kind-holyday" type='text' placeholder="نوعها" minlength="5" required></div>
									<div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-3 ">
                                                                                

										<label for="timee">مدتها</label>
                                                                                <input name="dur" id="time" type='text' placeholder="ادخل المدة باليوم" minlength="1" required>

										<button type="submit" class="sub">إضافة</button>
									</div>
									
								</form>

							</div>
					</div>
				</div>
				
				
				<!--end admin area-->
<?php require_once $includes . 'footer.php'; 
    unset($_SESSION['error']);
    unset($_SESSION['success']);
    }}elseif($_SESSION['rank'] == 0){
        header('location: /admin/vacations');
    }else{
        header('location: /');
        session_unset();
        session_destroy();
    }}else{
        header('location: /');
    }
?>