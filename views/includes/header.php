<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>imarket</title>
		<link rel="shortcut icon" href="images/title.png"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="keywords" content="skoolynk, schools, uneb, O'level, A'level, Teachers, Education, High schools, college, Admissions, Alumni, Advertisement, school events, students"/>
		<meta name="description" content="Sign up on skoolynk, manage your school, interact with administrators, teachers, students and parents. find schools, results, and join school forums."/>
		<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet"/>
		<link href="<?php echo base_url();?>css/animate.css" rel="stylesheet"/>
		<link href="<?php echo base_url();?>css/kcca.css" rel="stylesheet"/>
		<link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet"/>
		<style type="text/css">
			body{
				background:#fff;
			}
			.form-control{
				border-radius: 1px;
				box-shadow: none;
				margin-bottom:15px;
				border:none;
				color:green;
				font-size:12px;
			}
			.login-form{
				padding:25px;
				background:rgba(0,0,0,.2);
				width:80%; 
				border-bottom:1px solid #555;
				float:right;
			}

			.font-icons .col-md-4 i{
				color:green;
				font-size:30px;
				line-height:70px;
				margin-bottom:20px;
				text-align:center;
				border:1px solid #aaa;
				height:70px;
				width:70px;
				border-radius:100%;
			}
			.font-icons .col-md-4{
				color:#222;
				text-align:center;
			}
			.font-icons .col-md-4 h5{
				color:green;
				font-weight:bold;
				font-size: 15px;
				text-transform: uppercase;
				border-bottom:1px solid #999;
				padding:7px;
				margin-bottom:7px;	
				text-align:center;
			}
			#header{
				box-shadow:none;
				background:#3CB3F7 !important;
			}
			#side-links .fa{
				font-size:16px;
				color:#fff;
				margin-right:10px;
				background:rgba(0,0,0,.5);
				padding:7px;
				width:30px;
				height:30px;
				text-align:center;
			}
			#side-links{
				color:#fff !important;
			}
			.side-menu{
				background:#333; 
				height:100vh; 
			}
			.side-menu li{
				padding:0 !important;
				margin:0;
			}
			.side-menu li a{
				transition-duration: .4s;
				transition-property: background;
				padding:5px 10px 5px !important;
				margin:0 !important;
			}
			.side-menu li a:hover{
				background:rgba(0,0,0,.3); !important;
			}
			.main-risk{
				position: relative;
				height:310px; 
				background:url(<?php echo base_url();?>images/kampala.JPG); 
				margin-bottom: 6px;
				color:#fff; 
				font-family:Roboto-Thin; 
				border-radius:0; 
				border:none; 
				background-size:cover;
			}
			.otherRisks{
				color:#fff; 
				position: relative;
			}
			.otherRisks h3{
				font-size:17px;
				font-family:Roboto-Thin; 
			}
			#onRisk{
				position: absolute;
				bottom:30px;
				width:100%;
				left:30px;
			}
			#top-links{
				padding-top:7px !important;
				background: none;
				padding-bottom:7px !important;
				color:#fff;
			}
			.otherRisks .col-md-6 .thumbnail{
				margin-bottom: 6px;
			}
			.otherRisks h1{
				font-family: Roboto-Thin;
			}
			.navbar-brand{
				color:#fff !important;
			}
			#top-icons{
				color:#eee;
				font-size:16px;
				background: none;
				padding-top:20px !important;
				position:relative;
			}
			#top-icons .badge{
				position: absolute;
				top:6px;
				right: 1px;
				font-size:11px !important;
			}
			#myNavbar{
				margin-left:100px;
			}
			#top-icons-second{
				margin:0px 15px 0px;
				color:#fff;
				font-weight: lighter;
				background:none;
			}
			.side-navs li{
				border-bottom:1px solid #ddd;
				padding-bottom:0px;
			}
			.side-navs li a{
				color:#666;
			}
			.posts{
				border:1px solid #eef;
				padding:5px;
				border-radius:2px;
				background:#fbfbfb;
			}
			.posts .media{
				margin-top:7px;
			}
			.post .media h6{
				color:#999 !important;
			}
			.posts p{
				color:#888;
				font-size:12px;
				margin-top:10px;
			}
			.posts .table{
				color:#999;
				font-size:12px;
				margin-bottom: 0px;
			}
			.posts .table .fa{
				color:#999;
				margin-right:10px;
				font-size:17px;
				
			}

			#activeLink { background: #fff;  }
			#activeLink a { color: #444;  }

			#asideLinkActive {  background: #888; color:#fff; }
			#asideLinkActive a { color:#fff; }
		</style>
	</head>
	<body style="background-size:100%; background-attachment: fixed;">
	<nav class="navbar navbar-fixed-top" role="navigation" id="header">
		<div class="container-fluid" >
			<div class="navbar-header">
				<a href="<?php echo base_url();?>User/pageRoutes/dashboard" class="navbar-brand  animated rubberband">microx</a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<i class="fa fa-ellipsis-v" style="color:#fff;"></i>
					</button>
			</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <form class="navbar-form navbar-left" autocomplete="off" role="search" action="<?php echo base_url();?>School/search" id="makeSearch">
			<input type="text" id="searchField"  placeholder="Search..."  class="form-control" style=" margin-left:50px; border-radius:20px; background:#eee; border:1px solid #f1f1f1; height:28px; margin-top: 3px; color:#286090 !important;  margin-bottom:0; font-size: 12px; width: 250px;"/>
				<ul id="autoFill" class="cssarrow nav" style="background:snow; border-bottom: 1px solid #286090 text-align: left; display:none; width:350px; position:absolute; z-index:3000; top:50px; absolute; border-radius: 2px; padding: 3px 3px 3px; color:#286090;"></ul>
		  </form>
			<ul class="nav navbar-nav navbar-left">
				<li><a href="" id="top-icons"><i class="fa fa-envelope"></i><span class="badge badge-danger">5</span></a></li>
				<li><a href="" id="top-icons"><i class="fa fa-bell"></i><span class="badge badge-danger">5</span></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
		        <li class="dropdown">
		            <a class="dropdown-toggle" data-toggle="dropdown" id="top-links" href="#"><img src="<?php echo base_url();?>images/people/4.jpg" class="img-circle" style="width:35px; height:35px; border:2px solid #f1f1f1; margin-right:10px;"> kwizera innocent</a>
		            <ul class="dropdown-menu">
		               <li><a href="<?php echo base_url(); ?>Profile/index">Profile</a></li>
		               <li><a href="<?php echo base_url(); ?>Settings/index">Settings</a></li>
		               <li><a href="<?php echo base_url(); ?>People/index">People</a></li>
		               <li class="divider"></li>
		               <li><a href="<?php echo base_url(); ?>Login/logout">Logout</a></li>
		            </ul>
		         </li>
			</ul>
	   </div>
	   </div>
	</nav>
	<div class="thumbnail" style="width:100%; height:250px; background:#787; border:none; border-radius:0; margin-bottom:0; position:relative;">
	<nav class="navbar" role="navigation" id="header" style="position:absolute; width:100%; background:none !important; bottom:-10px; left:0;">
		<div class="container-fluid" >
			<div class="navbar-header">
				<a href="<?php echo base_url();?>User/pageRoutes/dashboard" class="navbar-brand  animated rubberband"><img src="<?php echo base_url();?>images/people/4.jpg" style="width:150px; height:150px; top:50px; margin-left:20px; position:absolute; z-index:10; top:-10px; padding:4px; background:rgba(253,253,253,.5);" class="img-circle"></a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<i class="fa fa-ellipsis-v" style="color:#fff;"></i>
					</button>
			</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<h4 style="color:#fff; margin-left:103px; font-family:Roboto-Thin;">Kwizera Innocent</h4>
			<h6 style="color:#fff; margin-left:103px; font-family:Roboto-Thin;">ziwktrance@gmail.com</h6>
			<ul class="nav navbar-nav navbar-left" style="margin-left:104px;">
				<li   <?php if( $this->uri->segment(1) == "Home" ){ echo "id='activeLink'";  }?>>
					<a href="<?php echo base_url()?>Home/index" id="top-icons-second"">Home</a>
				</li>
				<li  <?php if( $this->uri->segment(1) == "Messages" ){ echo "id='activeLink'"; }?>>
					<a href="<?php echo base_url()?>Messages/index" id="top-icons-second">Inbox</a>
				</li>
				<li  <?php if( $this->uri->segment(1) == "Network" ){ echo "id='activeLink'"; }?>>
					<a href="<?php echo base_url()?>Network/index" id="top-icons-second">Your network </a>
				</li>
				<li  <?php if( $this->uri->segment(1) == "People" ){ echo "id='activeLink'"; }?>>
					<a href="<?php echo base_url()?>People/index" id="top-icons-second">People</a>
				</li>
			</ul>
	   </div>
	   </div>
	</nav>
	</div>