<?php
//include('../../config_app.php');
session_start();
include("connect.ini.php");
include("includes/functions.php");


global $user;	

require_once("classes/class.user.php");

$user = new User();

$get_param="";

if(isset($_GET['modul'])){

 $get_param=$_GET['modul'];

	

$tparts = explode("/", $_GET['modul']);

$parameter = explode("/", $_GET['modul']);

	$queryInclude = array();

						for($i=0; $i<=sizeof(explode("/", $_GET['modul'])); $i++){

							if(strlen(implode("/", $tparts))>0){

								$queryInclude[] .= "seo_name='" . implode("/", $tparts). "'";

							}	

							array_pop($tparts);

						}

						

						

					 $queryString="SELECT name,seo_name,module_filename FROM menu WHERE 1 and (" . implode(" or ", $queryInclude) . ") order by char_length(seo_name) DESC LIMIT 1";

					 $applyString=mysqli_query($connect,$queryString);

					 $resultString=mysqli_fetch_array($applyString);

					$modul=$resultString['module_filename'];
					$modul_name=$resultString['name'];
					//$modul_path=$resultString['module_path'];

					 

					

}	

else{

	$modul="mod_home.php";

}



if(empty($modul)){$modul="mod_404.php";}

//********************************
?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Car XML generator</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
     
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
		<link href="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="http://production.mkem.sk/domains/metronic_assets/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="http://production.mkem.sk/domains/metronic_assets/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="http://production.mkem.sk/domains/metronic_assets/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="http://production.mkem.sk/domains/metronic_assets/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="http://production.mkem.sk/domains/metronic_assets/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
		 <link href="http://production.mkem.sk/domains/metronic_assets/assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />
		 <script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		  
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="<?php if($user->isAuthenticated()){echo 'page-header-fixed page-sidebar-closed-hide-logo page-content-white';} ?>">
	
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="">
                            <img height="50" src="images/Logos/Logo-next.png" alt="logo" class="logo-default"  style="margin-top:0%; margin-left:-5%; padding-right:20px;"/> </a>
                        <div class="menu-toggler sidebar-toggler" style="margin-left:-25%;">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                            
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                            
                            <li class="nav-item start ">
                                <a href="index.php" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Domov</span>
                                    
                                </a>
                               
                            </li>
                            <li class="heading">
                                <h3 class="uppercase">Pridanie záznamu</h3>
                            </li>
                                <li class="nav-item  ">
                                        <a href="?modul=pridat-zaznam" class="nav-link ">
                                            <i class="fa fa-car"></i><span class="title">Pridať vozidlo</span>
                                        </a>
                                </li>
                                <li class="nav-item  ">
                                        <a href="?modul=pridat-cd" class="nav-link ">
                                            <i class='fa fa-dot-circle-o'></i><span class="title">Pridať CD</span>
                                        </a>
                                </li>    								  							
							
				            <li class="heading">
                                <h3 class="uppercase"><hr></h3>
                            </li>
							<li class="heading">
                                <h3 class="uppercase">Záznamy</h3>
                            </li>
                            <li class="nav-item  ">
                                        <a href="?modul=spravovat-zaznamy" class="nav-link ">
                                            <i class="fa fa-tasks"></i><span class="title">Spravovať vozidlá</span>
                                        </a>
                            </li> 	
                            <li class="nav-item  ">
                                        <a href="?modul=spravovat-cd" class="nav-link ">
                                            <i class="fa fa-files-o"></i><span class="title">Spravovať CD</span>
                                        </a>
                            </li>    
                          
                                </ul>
                          
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
				
                    <!-- BEGIN CONTENT BODY -->
		
                    <?php include("modules/".$modul); ?>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
               
                <!-- END QUICK SIDEBAR -->
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <div class="page-footer">
                <div class="page-footer-inner"> 2017 mkem, spol. s r.o.
                    
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div>

        <!--[if lt IE 9]>
<script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/respond.min.js"></script>
<script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/excanvas.min.js"></script> 
<script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->


        <!-- BEGIN CORE PLUGINS -->
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
		<script src="http://production.mkem.sk/domains/metronic_assets/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="http://production.mkem.sk/domains/metronic_assets/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
       <!--  TU DOPLNIT VLASTNY JAVASCRIPT NA GRAFY<script src="http://production.mkem.sk/domains/metronic_assets/assets/pages/scripts/charts-amcharts.min.js" type="text/javascript"></script>-->
        <!-- END PAGE LEVEL SCRIPTS -
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="http://production.mkem.sk/domains/metronic_assets/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
				<script>
		/*
     * LetterAvatar
     * 
     * Artur Heinze
     * Create Letter avatar based on Initials
     * based on https://gist.github.com/leecrossley/6027780
     */
    (function(w, d){


        function LetterAvatar (name, size) {

            name  = name || '';
            size  = size || 60;

            var colours = [
                    "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50", 
                    "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
                ],

                nameSplit = String(name).toUpperCase().split(' '),
                initials, charIndex, colourIndex, canvas, context, dataURI;


            if (nameSplit.length == 1) {
                initials = nameSplit[0] ? nameSplit[0].charAt(0):'?';
            } else {
                initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
            }

            if (w.devicePixelRatio) {
                size = (size * w.devicePixelRatio);
            }
                
            charIndex     = (initials == '?' ? 72 : initials.charCodeAt(0)) - 64;
            colourIndex   = charIndex % 20;
            canvas        = d.createElement('canvas');
            canvas.width  = size;
            canvas.height = size;
            context       = canvas.getContext("2d");
             
            context.fillStyle = colours[colourIndex - 1];
            context.fillRect (0, 0, canvas.width, canvas.height);
            context.font = Math.round(canvas.width/2)+"px Arial";
            context.textAlign = "center";
            context.fillStyle = "#FFF";
            context.fillText(initials, size / 2, size / 1.5);

            dataURI = canvas.toDataURL();
            canvas  = null;

            return dataURI;
        }

        LetterAvatar.transform = function() {

            Array.prototype.forEach.call(d.querySelectorAll('img[avatar]'), function(img, name) {
                name = img.getAttribute('avatar');
                img.src = LetterAvatar(name, img.getAttribute('width'));
                img.removeAttribute('avatar');
                img.setAttribute('alt', name);
            });
        };


        // AMD support
        if (typeof define === 'function' && define.amd) {
            
            define(function () { return LetterAvatar; });
        
        // CommonJS and Node.js module support.
        } else if (typeof exports !== 'undefined') {
            
            // Support Node.js specific `module.exports` (which can be a function)
            if (typeof module != 'undefined' && module.exports) {
                exports = module.exports = LetterAvatar;
            }

            // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
            exports.LetterAvatar = LetterAvatar;

        } else {
            
            window.LetterAvatar = LetterAvatar;

            d.addEventListener('DOMContentLoaded', function(event) {
                LetterAvatar.transform();
            });
        }

    })(window, document);
		</script>
   
	
</body>
	
	

</html>