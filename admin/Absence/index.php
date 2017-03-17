<?php
    $assets = '../../assets/';
    $pageTitle = 'الغياب';
    $pages =['إلادارة',$pageTitle];
    $styles = ['header','admin','footer'];
    require_once $assets . 'includes/head.php';
    if(isset($_SESSION['username'])){
        if($_SESSION['rank'] == 0){
            ?>
            <div class="container">
					<div class="row" >	
							<div class="adpart col-lg-12 col-md-12 col-sm-12 ">
								<form id="form1">
									<h2 class="text-center">الغياب</h2>
									<div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-3 ">
										<label for="kind-holyday">اسم الموظف</label>
										<input id="kind-holyday" type='text' placeholder="اسم الموظف" minlength="5" required>

										<label for="timee">بعذر</label>
										<input id="time" type='text' placeholder="بعذر" minlength="2" required>
									</div>
									<div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-3 ">


										<label for="daate">التاريخ</label>
										<input id="daate" type="date" class="datepicker" placeholder="التاريخ" minlength="2" required>
										
										<label for="timee">مقدار الخصم</label>
										<input id="time" type='text' placeholder="مقدار الخصم" minlength="2" required>

										<button type="submit" class="sub">طلب</button>
									</div>
									
								</form>

							</div>
					</div>
				</div>
   <?php require_once $includes.'footer.php';
}elseif($_SESSION['rank'] == 1){
    header('location: /member');
   }else{
                session_destroy();
                header('location: /');
            }
        }
    else{
        header('location: /');
    }
      