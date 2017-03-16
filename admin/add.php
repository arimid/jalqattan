<?php 
    $assets = '../assets/';
    $styles = ['bootstrap-rtl','header','addmember','footer'];
    $scripts = ['picker','picker.date','picker.time','ar'];
    $pageTitle = 'إضافة موظف';
    $pages = ['إلادارة',$pageTitle];
    require_once $assets . 'includes/head.php';
    require_once $includes . 'connect.php';
    if(isset($_SESSION['username'])){
        if($_SESSION['rank'] == 0){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo $_POST['mName'].
                        "<br>" . $_POST['ID'].
                        "<br>" . $_POST['mDegree'] .
                        "<br>" . $_POST['mPos'] .
                        "<br>" . $_POST['mCourses'] .
                        "<br>" . $_POST['mImage'] .
                        "<br>" . $_POST['mBirth'] .
                        "<br>" . $_POST['mDate'];
            }else{
?>
<!--stat admin area-->
				<div class="container">
					<div class="row" >	
							<div class="adpart col-lg-12 col-md-12 col-sm-12 ">
                                                            <form id="form1" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
									<div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-3 ">
										<label for="cname">الاسم</label>
										<input name="mName" id="cname" type='text' placeholder="الاسم" minlength="5" required>

										<label for="cemail">الهوية</label>
										<input name="ID" id="cemail" type='text' placeholder="الهوية" minlength="2" required>

										<label for="degree">المؤهل</label>
										<input name="mDegree" id="degree" type='text' placeholder="المؤهل" minlength="2" required>

										<label for="position">المسمى الوظيفى</label>
										<input name="mPos" id="position" type='text' placeholder="المسمى الوظيفى" minlength="2" required>

										<label for="courses">الدورات</label>
										<input name="mCourses" id="courses" type='text' placeholder="الدورات" minlength="2" required>
									</div>
									<div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-3 ">



										<div class="fileinputs">
											<input  name="mImage" type="file" class="file" id="imgInp" required/>
											<div class="fakefile">
												<div class="line"></div>
												<p class='pic'>صوره الموظف</p>
												<span class="lin">رفع</span>
												<i class="fa fa-user" aria-hidden="true"></i>
												<img id="blah" src="<?php echo $images?>empty.gif"/>
											</div>
										</div>


										<label for="birth">الميلاد</label>
										<input  name="mBirth" id="birth" type='text' class="datepicker" placeholder="الميلاد" minlength="2" required>

										<label for="cdate">تاريخ الانتهاء</label>
										<input  name="mDate" id="cdate" type='text' class="datepicker" placeholder="تاريخ الانتهاء" minlength="2" required>
										<button type="submit" class="sub">تسجيل</button>
									</div>
									
								</form>

							</div>
					</div>
				</div>
				
				
				<!--end admin area-->
                <?php
            require_once $includes . 'footer.php';}}
    elseif($_SESSION['rank'] == 1){
    header('location: /member');
    }else{
        session_unset();
        session_destroy();
        header('location: /');
    }
        }else{
            session_unset();
        session_destroy();
        header('location: /');
        }
                ?>