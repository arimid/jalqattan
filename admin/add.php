<?php 
    $assets = '../assets/';
    $styles = ['bootstrap-rtl','header','addmember','footer','classic','classic.date'];
    $scripts = ['picker','picker.date','picker.time','ar','datepick'];
    $pageTitle = 'إضافة موظف';
    $pages = ['إلادارة',$pageTitle];
    $Qulis = ['إبتداى','متوسط','ثانوى','دبلوم','بكالوريس','دبلوم عالى','ماجستير','دكتوراه'];
    require_once $assets . 'includes/head.php';
    require_once $includes . 'connect.php';
    /* @var $db PDO */
    if(isset($_SESSION['username'])){
        if($_SESSION['rank'] == 0){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $User = $_POST['mName'];
                $IDNum = $_POST['ID'];
                $Degree = $_POST['mDegree'];
                $Pos = $_POST['mPos'];
                $Courses = $_POST['mCourses'];
                $Birth = $_POST['mBirth_submit'];
                $Birth = str_replace('/','', $Birth);
                $Exp = $_POST['mDate_submit'];
                $Exp = str_replace('/','', $Exp);
                // code of image uploading to database
                $image = addslashes($_FILES["mImage"]["tmp_name"]);
                $image = addslashes(file_get_contents($image));
                if(!isset($Degree)){
                    $_SESSION['error'] = 'لم يتم اختيار مؤهل يرجى إختيار مؤهل و إعادة المحاولة';
                    $_SESSION['error'] .= '<br>';
                    header('location: ' . $_SERVER['PHP_SELF']);
                }
                $getID = 'SELECT COUNT(*) FROM Users';
                $getID = $db->query($getID);
                $getID = $getID->fetchColumn();
                $getID = $getID + 1;
                try {
                    $insertOne = "INSERT INTO Users (ID,Name,Birth_Date,image,ID_Number,Expiry_Date,Quli,Courses,Job_Name) VALUES";
                $insertOne .= "('$getID','$User','$Birth','$image','$IDNum','$Exp','$Degree','$Courses','$Pos')";
                $insertOne = $db->prepare($insertOne);
                $insertOne->execute();
                $_SESSION['success'] = 'تم إضافة الموظف بنجاح';
                } catch (Exception $exc) {
                   $_SESSION['error'] .= $exc->getMessage();
                   header('location: '. $_SERVER['PHP_SELF']);
                }
                
                header('location: '. $_SERVER['PHP_SELF']);
            }else{
?>
<!--stat admin area-->
				<div class="container">
					<div class="row" >	
							<div class="adpart col-lg-12 col-md-12 col-sm-12 ">
                                                            <h1 class='text-center'><?php echo $pageTitle ?></h1>
                                                            <?php if(isset($_SESSION['error'])){ ?>
                                                            <div class="text-center alert alert-danger"><?php echo $_SESSION['error'] ?></div>
                                                            <?php }elseif(isset($_SESSION['success'])){ ?>
                                                            <div class="text-center alert alert-success"><?php echo $_SESSION['success'] ?></div>
                                                            <?php } ?>
                                                            <form id="form1" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                                                                
									<div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-3 ">
										<label for="cname">الاسم</label>
										<input name="mName" id="cname" type='text' placeholder="الاسم" minlength="5" required>

										<label for="cemail">الهوية</label>
										<input name="ID" id="cemail" type='text' placeholder="الهوية" minlength="2" required>

										<label for="degree">المؤهل</label>
                                                                                <select name="mDegree" id="degree" type='text' placeholder="المؤهل" required>
                                                                                    <option value="none" selected disabled>إختر مؤهل</option>
                                                                                    <?php foreach($Qulis as $Quli){ ?>
                                                                                    <option value="<?php echo $Quli?>"><?php echo $Quli?></option>
                                                                                    <?php } ?>
                                                                                </select>

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
										<input  name="mBirth" id="birth" type='text' class="datepicker" placeholder="الميلاد" required>

										<label for="cdate">تاريخ الانتهاء</label>
										<input  name="mDate" id="cdate" type='text' class="datepicker" placeholder="تاريخ الانتهاء" required>
										<button type="submit" class="sub">تسجيل</button>
									</div>
									
								</form>

							</div>
					</div>
				</div>
				
				
				<!--end admin area-->
                <?php
            require_once $includes . 'footer.php';
            unset($_SESSION['error']);
            unset($_SESSION['success']);
            }}
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