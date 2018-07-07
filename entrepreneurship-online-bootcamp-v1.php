<?php
session_start();
$_SESSION["token"] 	= md5(uniqid(mt_rand(), true));
?>
<!DOCTYPE html>
<html>
<head>
	<title>MIT Entrepreneurship Online Bootcamp: From Idea To Startup In Eight Week</title>
	<meta charset="utf-8" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content="MIT Entrepreneurship Online Bootcamp: From Idea To Startup In Eight Week">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon.xpro.ico">
	<meta name="theme-color" content="#ffffff">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">

	<meta name="keywords" content=""/>

	<meta property="og:title" content="MIT Entrepreneurship Online Bootcamp: From Idea To Startup In Eight Week"/>

	<meta property="og:description" content=""/>

	<meta property="og:image" content="https://eim.mit.edu/bootcamp-assets/images/banner-desk.jpg"/>

	<meta name="twitter:card" content=""/>

	<meta name="twitter:description" content=""/>

	<meta name="twitter:title" content="MIT Entrepreneurship Online Bootcamp: From Idea To Startup In Eight Week" />

	<meta name="twitter:image" content="https://eim.mit.edu/bootcamp-assets/images/banner-desk.jpg" />	
	<link rel="stylesheet" type="text/css" href="https://eim.mit.edu/bootcamp-assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://eim.mit.edu/bootcamp-assets/css/style_v1.css?v=0.0.1">
	<link rel="stylesheet" type="text/css" href="https://eim.mit.edu/bootcamp-assets/css/responsive_v1.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">		<link rel="stylesheet" href="https://emeritus.org/programmes/common/gdpr.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
	<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
<style>.async-hide { opacity: 0 !important} </style>
	<!-- Tracking Code start-->

        <script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
        h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
        (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
        })(window,document.documentElement,'async-hide','dataLayer',4000,
        {'GTM-PZHRQJ3':true});</script>

        <script>
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
   m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
   })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-71668354-1', 'auto', {'allowLinker': true});
	  ga('require', 'linker');
	  ga('linker:autoLink', ['www.emeritus.org','www2.emeritus.org','emeritus.gsb.columbia.edu','execed-emeritus.wharton.upenn.edu'] );
	  ga('set', 'anonymizeIp', true);
	  ga('require', 'GTM-PZHRQJ3');
      ga('send', 'pageview');

	</script>
	<!--Google tracking code ends-->
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NX2MRZJ');</script>
	<!-- End Google Tag Manager -->
	<!-- Tracking Code end-->
	<script>
		function trackEvent(event, category, action, label) {
			ga('send', 'event', category, action, label);
			console.log('GA==' + event + '==' + category + '==' + action + '==' + label);
		}
		
		function populateOTP()
		{
			$('#resendBtn').html('Resend');
			$('#otpcode_section').fadeIn(1000);
			$('#hid_otpcode').val('');
			$('#skip_verify').val('0');
		}

		function generateOTPValue()
		{
			$('#hid_otpcode').val('');
			$('#skip_verify').val('0');
			$('#skip-verify').hide();
			$('#otpText').html('');
			
			$('#otpcode_section').show();
			$.post("sendOtp.php",$( "input[name=\'mobile\']" ).closest("form").serialize(), function (data) {				
				if (data.msg == "success") { 
					//alert(data.error);
					$('#otpText').html(data.error);
					$("#hid_otpcode").val(data.code);
					$("#hid_phoneno").val(data.phone);
					
					$('#resendBtn').html('Resend');
					generateOTP = 1;
					setTimeout(function(){ $('#skip-verify').show(); }, 10000);
				}
				else
				{
					$('#skip_verify').val('2');
					$('#otpcode_section').fadeOut(1000);
					$("#hid_phoneno").val(data.phone);
					$('#resendBtn').html('Resend');
					//alert(data.error);
					return false;
				}
			}, "json");
		}
		
		function skipVerify()
		{
			$('#otpcode_section').fadeOut(1000);
			$('#otpcode').attr('disabled','disabled');
			$('#skip_verify').val('1');
		}
		
		
		$(document).ready(function (){
			var is_otp_required = "0";
			var submitted = false;
			$("#frm").validate({ 
				rules: {
					first_name: {
						required: true,
						specialChar:true
					},
					last_name: {
						required: true,
						specialChar:true
					},
					country:{
						required: true,
						notEqual: "-1"
					},
					city: {
						required: true,
						specialChar:true
					},
					workexp: {
						required: true,
					},
					email:{
						required: true,
						email:true,
						customemail:true
					},
					mobile: {
						required: true,
						digits: true,
						rangelength:  function(element){
										if($("#country").val()=='India'){
											return [10, 10];
										}
										else{
											return [5, 20];
										}
									},			
					}/*,
					terms:{
						required: true,
					}*/
				}, 
				messages: {
					salutation: {
						required: "Please provide salutation"
					},
					first_name: {
						required: "Please provide your first name",
						specialChar:"Please provide only alphanumeric values",
					},
					last_name: {
						required: "Please provide your last name",
						specialChar:"Please provide only alphanumeric values",
					},
					company:{
						required: "Please provide company name",
						specialChar:"Please provide only alphanumeric values",
					},
					country:{
						required: "Please provide country name",
						notEqual: "Please provide country name",
					},
					state:{
						required: "Please provide state name",
					},
					city:{
						required: "Please provide city name",
						specialChar:"Please provide only alphanumeric values",
					},
					workexp: {
						required: "Please provide work exp",
					},
					email:{
						required: "Please provide your email",
						email: "Please provide valid email",
						customemail: "Please provide valid email",
					},
					code: {
						required: "Please provide country code",
						digits: "Please provide only digits (0 - 9) in country code",
						rangelength: "Please provide valid country code",			
					},
					mobile: {
						required: "Please provide your phone no",
						digits: "Please provide only digits (0 - 9) in phone no",
						rangelength: "Please provide valid phone no",		
					},
					otpcode: {
						required: "Please provide OTP Code / enter your phone no to generate new OTP code",
						equalTo: "Please provide valid OTP / enter your phone no to to generate new OTP code"
					},
					terms:{
						required: 'Please accept terms & condition',
					}				
				},
				/*showErrors: function(errorMap, errorList) {
					if (submitted) {
						var summary = "You have the following errors: \n";
						$.each(errorList, function() { summary += " * " + this.message + "\n"; });
						alert(summary);
						submitted = false;
					}
					this.defaultShowErrors();
				},          
				invalidHandler: function(form, validator) {
					submitted = true;
				},*/
				 errorPlacement: function(error, element){
					if(element.attr("name") == 'otpcode')
					{
						$('#otpText').html('');
						error.appendTo( element.parent().siblings('.error-text') );
					}
					else
					{
						error.appendTo( element.siblings(".error-text") );;
					}
				},
				submitHandler: function(form){
					//$('#frm')[0].submit(); // 
					trackEvent('click','EOB V1','FormSubmit','Form_Submit')
					
					var btn = $('input[type="submit"]');
					btn.val("Processing...");
					btn.attr("disabled",true);
					form.submit();
					
				}
            });
											
			//custom validation rule
			$.validator.addMethod("customemail", 
				function(value, element) {
					if ($.trim(value) != ""){
						var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
					return pattern.test(value);
					}     
					else
					{
						return true;
					}
				}, 
				"Please provide valid email format"
			);
			
			jQuery.validator.addMethod("specialChar", function(value, element) {
				 return this.optional(element) || /([0-9a-zA-Z\s])$/.test(value);
			  }, "Please Fill Correct Value in Field.");

			jQuery.validator.addMethod("notEqual", function(value, element, param) {
			  return this.optional(element) || value != param;
			},"Please select valid country");

		});

		

		</script>
</head>
<body>
	<div class="wrapper">
		<div class="container-fluid" id="header">
			<div class="container">
				<header class="header">
					<div class="row">
						  <div class="col-sm-6">
							<a href="https://eim.mit.edu/entrepreneurship-online-bootcamp-v1.php" onclick="trackEvent('click','EOB V1','Reload','Partner Logo')"><img src="https://eim.mit.edu/bootcamp-assets/images/logo.png" alt="MIT's Entrepreneurship Bootcamp" title="MIT's Entrepreneurship Bootcamp" class="img-responsive"></a>
						</div>						
					</div>
				</header>
			</div>	
		</div>
		<div class="banner"> 
			<div class="banner-bg">
				<div class="container df">
					<div class="col-md-7 no_pad">
						<div class="banner-content p-l-7">
							<h1>MIT ENTREPRENEURSHIP ONLINE BOOTCAMP</h1>
							<h2>FROM IDEA TO STARTUP IN 8 WEEKS</h2>
						</div>
					</div>
					<div id="2" class="col-md-5 form-div no_pad form-section">
							<form class="form-horizontal contact-form" role="form" id="frm" name="frm" method="POST" action="submit-bootcamp-v1.php">
								<h2>Request program info</h2>
								<div id="fields">
									<?php
									if(strtolower(trim($_GET['utm_source'])) == 'linkedin')
									{
										?>
										
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label class="control-label col-xs-4 col-sm-3 col-md-4"></label>
													<div class="col-xs-8 col-sm-9 col-md-8">
														<script src="https://www.linkedin.com/autofill/js/autofill.js" type="text/javascript" async></script><script type="IN/Form2" data-form="frm" data-field-firstname="first_name" data-field-lastname="last_name" data-field-phone="mobile" data-field-email="email" data-field-country="country"></script>
													</div>
												</div>
											</div>
										</div>
										<?php
									}										
									?>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">First Name*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="first_name" placeholder="" name="first_name">
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Last Name*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="last_name" placeholder="" name="last_name">
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Email*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="email" class="text" id="email" placeholder="" name="email">
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Work Experience (in years)*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<select  id="workexp" name="workexp" title="Work Experience" class="select">
												<option value=""></option>
												<option value="Less than 5 Years">Less than 5 Years</option>
												<option value="5-10 Years">5-10 Years</option>
												<option value="10-15 Years">10-15 Years</option>
												<option value="15-20 Years">15-20 Years</option>
												<option value="&gt; 20 Years">> 20 Years</option>
											</select>
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Mobile No.*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="mobile" placeholder="" name="mobile">
											<span class="error-text"></span>
											<span class="small"><!--(e.g.: 9988776623)--></span>
										</div>
										
									</div>
									
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Country*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<select type="text" id="country" name="country" class="select">
											</select>
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">City*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="city" placeholder="" name="city">
											<span class="error-text"></span>
										</div>
									</div>
									<!-- <div class="form-group small pd-checkbox">
											<label class="control-label col-xs-4 col-sm-3 col-md-4"></label>
											<div class="col-xs-8 col-sm-9 col-md-8">
												<span class="value"><span><input type="checkbox" name="terms" id="terms" value="I allow MIT Sloan to send me email updates on Executive Education Programs"><label class="inline" for="terms" >I allow MIT Sloan to send me email updates on Executive Education Programs</label>
												</span></span>
											</div>
									</div> -->
									<div class="form-group" id="gdpr-consent" style="display:none;"> 
										
										<div class="col-sm-12">
											<label class="checkbox-inline">
											  <input type="checkbox" value="I would like to receive email & other communications from EMERITUS & its university partners about this course and other relevant courses." name="agree" id="agree">I would like to receive email & other communications from EMERITUS & its university partners about this course and other relevant courses.
											</label>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="submit" class="btn btn-default download-btn" value="DOWNLOAD BROCHURE >"/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<p><small>Your details will not be shared with third parties.</small>
											<strong><small><a href="https://emeritus.org/privacy-policy/" target="_blank">Privacy Policy</a></small></strong>
											</p>
										</div>
									</div>
									<input type="hidden" name="skip_verify" id="skip_verify" value="0">
									<input type="hidden" name="utm_source" value="<?php echo $_GET['utm_source'];?>">
									<input type="hidden" name="utm_medium" value="<?php echo $_GET['utm_medium'];?>">
									<input type="hidden" name="utm_term" value="<?php echo $_GET['utm_term'];?>">
									<input type="hidden" name="utm_content" value="<?php echo $_GET['utm_content'];?>">
									<input type="hidden" name="utm_campaign" value="<?php echo $_GET['utm_campaign'];?>">
									<input type="hidden" name="matchtype" value="<?php echo $_GET['matchtype'];?>">
									<input type="hidden" name="network" value="<?php echo $_GET['network'];?>">
									<input type="hidden" name="creative" value="<?php echo $_GET['creative'];?>">
									<input type="hidden" name="keyword" value="<?php echo $_GET['keyword'];?>">
									<input type="hidden" name="placement" value="<?php echo $_GET['placement'];?>">
									<input type="hidden" name="random" value="<?php echo $_GET['random'];?>">
									<input type="hidden" name="copy" value="<?php echo $_GET['copy'];?>">
									<input type="hidden" name="adposition" value="<?php echo $_GET['adposition'];?>">
									<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>">
									<input type="hidden" name="csrf" value="<?php echo $_SESSION["token"];?>">
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container info-row">
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="https://eim.mit.edu/bootcamp-assets/images/start.png" alt="Starts on" title="Starts on">
					</div>
					<div class="img-content">
						<h3>Starts on</h3>
						<p><b>August 9, 2018</b></p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="https://eim.mit.edu/bootcamp-assets/images/duration.png" alt="Duration" title="Duration">
					</div>
					<div class="img-content">
						<h3>Duration</h3>
						<p><b>Eight weeks</b>, online<br class="mobile-show"> 
						<span class="f18">8-10 hours per week</span>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="https://eim.mit.edu/bootcamp-assets/images/fee.png" alt="Program Fees" title="Program Fees">
					</div>
					<div class="img-content">
						<h3>program fees</h3>
						<p><b>$2,950</b></p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container padtop">
				<h1 class="heading">Entrepreneurs: Learn What It Takes</h1>
				<p class="text-left intro-text">
					Innovation doesn't grow in the comfort zone. It takes courage to breathe life into a new idea. But there's a common belief that entrepreneurs are born, not made. At Massachusetts Institute of Technology (MIT), we know that this is a myth. MIT graduates have started over 33,000 active companies that generate over $1.2 trillion in annual revenue and employ over 3.3 million people, making MIT the 10th largest economy in the world. And in just three years of the residential MIT Bootcamps, its graduates have raised over $70 million in funding for ventures incubated in the Bootcamps. Entrepreneurship can be taught. The journey starts with knowledge, not genetics. So in this online Bootcamp you will develop a systematic toolkit for venture creation and gain a disciplined mindset of the successful entrepreneur.
				</p>
				<div class="row counter-row">
						<div class="col-md-4 col-sm-4">
							<div class="abt-content bb-a">
								<div class="img-center-section">
									<h3>$70 Million</h3>
								</div>
								<p>Funding for participants in MIT Bootcamps in 3 years.</p>
								</div>
						</div>
						<div class="col-md-4 col-sm-4 b-r-f-1">
							<div class="abt-content bb-a">
								<div class="img-center-section">
									<h3>52%</h3>
								</div>
								<p> The world is operating at 52% of its entrepreneurial capacity.</p>
								<p class="text-center"style="color:#ccc5c5; font-size:10px; margin-top: -9px;">SOURCE: CNBC</p>
								</div>
							</div>
						<div class="col-md-4 col-sm-4">
								<div class="abt-content">
								<div class="img-center-section">
									<h3>8 Weeks</h3>
								</div>
									<p>Go from idea to startup at the MIT Entrepreneurship Online Bootcamp.</p>
								</div>
						</div>
				</div>
					<div class="mb92">
						<a href="#2" onclick="trackEvent('click','EOB V1','ScrollUp','Download Brochure')"><button class="btn btn-default download-btn"> DOWNLOAD BROCHURE</button></a>
					</div>
				</div>
			
			<div class="video-wrapper youtubevideo">
				<div class="aspect-ratio" style="position: relative;width: 100%; height: 0;padding-bottom: 55%;">
					<div id="player"></div>
				</div>
			</div>
			
				<div class="bg_grey">
					<div class="content-wrapper container">
						<h1 class="heading">Your Learning Journey</h1>
						<div class="row icon-row text-center display_desktop">
							<img src="https://eim.mit.edu/bootcamp-assets/images/your-learning-journey-graphic1-new.png" class="img-responsive" alt="Your Learning Journey" title="Your Learning Journey">
						</div>
						<div class="text-center clearfix">
							<ul class="no-style">
								<li class="col20">
									<div class="box-section blue">
									<img src="https://eim.mit.edu/bootcamp-assets/images/icon1.png" alt="Video Lectures" title="Video Lectures">
									</div>
									<p class="data-section">184 Video Lectures</p>
								</li>
								<li class="col20">
									<div class="box-section">
									<img src="https://eim.mit.edu/bootcamp-assets/images/icon2.png" alt="Live Sessions With MIT Faculty" title="Live Sessions With MIT Faculty">
									</div>
									<p class="data-section">4 Live Sessions With MIT Faculty</p>									
								</li>
								<li class="col20">
									<div class="box-section blue">
									<img src="https://eim.mit.edu/bootcamp-assets/images/icon3.png" alt="Feedback Sessions With MIT Bootcamps Coaches" title="Feedback Sessions With MIT Bootcamps Coaches">
									</div>
									<p class="data-section">5 Feedback Sessions With an MIT-trained Bootcamp Coach</p>
								</li>
								<li class="col20">
									<div class="box-section blue">
									<img src="https://eim.mit.edu/bootcamp-assets/images/icon4.png" alt="Capstone Project" title="Capstone Project">
									</div>
									<p class="data-section">1 Capstone Project</p>
								</li>
								<li class="col20">
									<div class="box-section blue">
									<img src="https://eim.mit.edu/bootcamp-assets/images/icon5.png" alt="Discussions" title="Discussions">
									</div>
									<p class="data-section">6 Discussions</p>
								</li>
								<li class="col20">
									<div class="box-section blue">
									<img src="https://eim.mit.edu/bootcamp-assets/images/icon6.png" alt="Group Assignments" title="Group Assignments">
									</div>
									<p class="data-section">4 Group Assignments</p>
								</li>
							</ul>							
						</div>
						<div class="row clearfix padding-up">
							<div class="col-md-6 col-sm-6">
								<div class="syllabus">
									<ul>
										<li><span class="ul-head">Orientation Module:</span> Program Overview
										</li>
										<li><span class="ul-head">Module 1:</span> Where Do Innovative Startup Ideas Come From?</li>
										<li><span class="ul-head">Module 2:</span> Problem Discovery and Problem Solving</li>
										<li><span class="ul-head">Module 3:</span> Market Segmentation and Primary Market Research</li>
										<li><span class="ul-head">Module 4:</span> Knowing Your Customer</li>
									</ul>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 your-learning-mt">
								<div class="syllabus">
									<ul>
										<li><span class="ul-head">Module 5:</span> Bullseye: Quantifying the Value Proposition</li>
										<li><span class="ul-head">Module 6:</span> Where the Rubber Meets the Road: Startup Sales</li>
										<li><span class="ul-head">Module 7:</span> Design a Business Model and Project Unit Economics</li>
										<li><span class="ul-head">Module 8:</span> The Pitch: Bringing Ideas to Center Stage</li>
									</ul>
								</div>
							</div>
						</div>
					</div>		
					<div class="marb92">	
						<a href="#2" onclick="trackEvent('click','EOB V1','ScrollUp','Download Syllabus')" target="_blank"><button class="btn btn-default download-btn">DOWNLOAD SYLLABUS</button></a>
					</div>	
				</div>
				
			<!-- <div class="container online-bootcamp">
				<h1 class="heading">Online Bootcamp Tracks</h1>	
					<div class="row p-50 container-row">
					<div class="clearfix">
						<p class="text-left datatext padd-lf">With MIT’s online Bootcamp, there are many paths to success. You can either participate in the most popular group
								format, bringing your own team or joining a team of other entrepreneurs. New for June 2018 — you can choose the solo track for individuals who wish to protect their intellectual property and receive private coaching sessions from MIT-trained coaches.
						</p>
						<p class="text-center right-path">Which path is right for you?</p>
					</div>
					
					<div class="col-sm-12 hidden-xs icon-row path-image">
							<img src="https://eim.mit.edu/bootcamp-assets/images/right-path-new.png" class="img-responsive" alt="Online Bootcamp Tracks" title="Online Bootcamp Tracks">
					</div>
					<div class="col-sm-12 visible-xs icon-row path-image">
							<img src="https://eim.mit.edu/bootcamp-assets/images/right-path-mob-new.png" class="img-responsive" alt="Online Bootcamp Tracks" title="Online Bootcamp Tracks">
					</div>
						
				</div>
			
			</div>	 -->
			
			<div class="container-fluid" id="Faculty">
				<h1 class="heading">Faculty</h1>	
					<div class="row container clearfix featured-coaches">
					<div class="col-md-4 col-sm-4">
						<fieldset class="featured_faculty">
    						<legend align="center" class="img-circle"><img src="https://eim.mit.edu/bootcamp-assets/images/William-Aulet.png" alt="William Aulet" title="William Aulet"></legend>
    						    <h5 class="user-name">William Aulet</h5>
								<h5>Professor of the Practice at MIT Sloan School of Management; Managing Director, Martin Trust Center for MIT Entrepreneurship</h5>
								 <p class="data-featured">
									Bill holds a bachelor's degree in engineering from Harvard University...</p> 
								<a class="txt-color" data-toggle="modal" data-target="#myModal11" onclick="trackEvent('click','EOB V1','Pop Up','Faculty')">More info</a>
  						</fieldset>
					</div>
					<!-- Modal -->
					<div class="modal fade" id="myModal11" role="dialog">
					    <div class="modal-dialog modal-lg">
					    	 <!-- Modal content-->
					     	<div class="modal-content">
					        	<div class="modal-header text-center">
					         		<button type="button" class="close" data-dismiss="modal">×</button>
					          		<img src="https://eim.mit.edu/bootcamp-assets/images/William-Aulet.png" alt="William Aulet" title="William Aulet" class="img-circle">
					          		<!-- <h4 class="modal-title">Modal Header</h4> -->
					        	</div>
					       		<div class="modal-body">
					          		<p class="text-center  profile">
					          			</p><h5 class="user-name">William Aulet</h5>
									<h5>Professor of the Practice at MIT Sloan School of Management; Managing Director, Martin Trust Center for MIT Entrepreneurship</h5>

									<p>Bill holds a bachelor's degree in engineering from Harvard University and an SM from the MIT Sloan School of Management. Bill is the managing director of the Martin Trust Center for MIT Entrepreneurship at MIT and Professor of the Practice at the MIT Sloan School of Management. The Center is responsible for entrepreneurship across all five schools at MIT starting with education but also extending well outside the classroom with student clubs, conferences, competitions, networking events, awards, hackathons, student trips, and most recently, accelerators.</p>
									<p class="faculty_gap">
									Bill teaches at least three different classes per year (introductory to advanced entrepreneurship classes) in addition to his responsibilities of running the Center. His work has won numerous awards, including the Adolf F. Monosson Prize for Entrepreneurial Mentoring at MIT. He is the author of <i> Disciplined Entrepreneurship: 24 Steps to a Successful Startup</i> and the accompanying workbook.
									</p>
					        	</div>
					        	<!-- <div class="modal-footer">
					          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        	</div> -->
					    	</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<fieldset class="featured_faculty">
    						<legend align="center" class="img-circle"><img src="https://eim.mit.edu/bootcamp-assets/images/Eric-von-Hippel.png" alt="Professor Eric von Hippel" title="Professor Eric von Hippel"></legend>
    							<h5 class="user-name">Professor Eric von Hippel</h5>
								<h5>T. Wilson (1953) Professor in Management; Professor of Management of Innovation and Engineering Systems</h5>
								<p class="data-featured">	
								Eric is the T. Wilson (1953) Professor in Management and a Professor of Management...</p>
								<a class="txt-color" data-toggle="modal" data-target="#myModal12" onclick="trackEvent('click','EOB V1','Pop Up','Faculty')">More info</a>
  						</fieldset>
					</div>
					<div class="modal fade" id="myModal12" role="dialog">
					    <div class="modal-dialog modal-lg">
					    	 <!-- Modal content-->
					     	<div class="modal-content">
					        	<div class="modal-header text-center">
					         		<button type="button" class="close" data-dismiss="modal">×</button>
					          		<img src="https://eim.mit.edu/bootcamp-assets/images/Eric-von-Hippel.png" alt="Professor Eric von Hippel" title="Professor Eric von Hippel" class="img-circle">
					          		<!-- <h4 class="modal-title">Modal Header</h4> -->
					        	</div>
					       		<div class="modal-body">
					          		<p class="text-center profile">
					          			</p><h5 class="user-name">Professor Eric von Hippel</h5>
									<h5>T. Wilson (1953) Professor in Management; Professor of Management of Innovation and Engineering Systems</h5>
									
									<p>Eric is the T. Wilson (1953) Professor in Management and a Professor of Management of Innovation and Engineering Systems at the MIT Sloan School of Management. He holds a BA in economics from Harvard College, an SM in mechanical engineering from MIT, and a PhD in business and engineering from Carnegie-Mellon University.</p>
 
									<p class="faculty_gap">
									Eric's research discovers and explores patterns in the sources of innovation and develops new processes to improve the "fuzzy front end" of the innovation process—the end where ideas for breakthrough new products and services are developed. In his book, <i>Democratizing Innovation,</i> von Hippel shows how communities of users are actually becoming such powerful innovation engines that they are increasingly driving manufacturers out of product development altogether—pattern he documents in fields ranging from Open source software to sporting equipment. This discovery has been used for a better understanding of the innovation process and for the development of new innovation processes for industry.</p>
									</p>
									
									<p class="faculty_gap">
									He is currently leading a major research project to discover how these user innovation communities work, and how and whether the same principles might extend to many areas of product and service development.</p>
									</p>
					       		</div>
					        	<!-- <div class="modal-footer">
					         		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        	</div> -->
					    	</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<fieldset class="featured_faculty">
    						<legend align="center" class="img-circle"><img src="https://eim.mit.edu/bootcamp-assets/images/Erdin-Beshimov.png" alt="Erdin Beshimov" title="Erdin Beshimov"></legend>
    							<h5 class="user-name">Erdin Beshimov</h5>
								<h5>Lecturer at MIT and Founder & Director of the MIT Bootcamps Program; MIT Open Learning Lecturer</h5>
								<p class="data-featured">
									Erdin Beshimov is a Founder of the MIT Bootcamps and Lecturer in MIT's online courses...</p>
								<a class="txt-color" data-toggle="modal" data-target="#myModal13" onclick="trackEvent('click','EOB V1','Pop Up','Faculty')">More info</a>
  						</fieldset>
					</div>
					<div class="modal fade" id="myModal13" role="dialog">
					    <div class="modal-dialog modal-lg">
					    	 <!-- Modal content-->
					     	<div class="modal-content">
					        	<div class="modal-header text-center">
					         		<button type="button" class="close" data-dismiss="modal">×</button>
					          		<img src="https://eim.mit.edu/bootcamp-assets/images/Erdin-Beshimov.png" alt="Erdin Beshimov" title="Erdin Beshimov" class="img-circle">
					          		<!-- <h4 class="modal-title">Modal Header</h4> -->
					        	</div>
					       		<div class="modal-body">
					          		<p class="text-center profile">
					          			</p><h5 class="user-name">Erdin Beshimov</h5>
										<h5>Lecturer at MIT and Founder & Director of the MIT Bootcamps Program; MIT Open Learning Lecturer</h5>
									

									<p>Erdin is a Founder of the MIT Global Entrepreneurship Bootcamp and Lecturer in MIT's online courses "You Can Innovate: User Innovation & Entrepreneurship", "Entrepreneurship 101: Who Is Your Customer?", "Entrepreneurship 102: What Can You Do For Your Customer", and "Entrepreneurship 103: Show Me The Money." For his work in entrepreneurship and contributions to student life at MIT, Erdin was awarded the Patrick J. McGovern Entrepreneurship Award, the Carol and Howard Anderson Fellowship, and the MIT Sloan Peer Recognition Award.</p>
 
									<p class="faculty_gap">
									Erdin is a graduate of the MIT Sloan School of Management. Before returning to work at MIT, Erdin served a Principal in the VentureLabs of Flagship Ventures where he focused on ventures in water and sustainability. Prior to that, Erdin co-founded Ubiquitous Energy, a solar startup catalyzed in the MIT course, "New Enterprises."
									</p>
					       		 </div>
					       		<!-- <div class="modal-footer">
					          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        	</div> -->
					    	</div>
						</div>
					</div>
				</div>
				</div>	
		
			
			
			<div class="container featured-alumini-speak">
				<h1 class="heading">Featured Alumni</h1>	
					<div class="row p-50 container-row">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="https://eim.mit.edu/bootcamp-assets/images/david_anderton.png" alt="David Anderton" title="David Anderton" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    						    <h5 class="alumni_featured_name">David Anderton</h5>
								 <p class="alumni_featured_data">
									From Financial Times journalist to MIT startup Chief Technology Officer
								</p> 
							</div>		
  						</div>
					</div>
					
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="https://eim.mit.edu/bootcamp-assets/images/Anders-Ropke.png" alt="Anders Ropke" title="Anders Ropke" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Anders Ropke</h5>
								 <p class="alumni_featured_data">
									From Wind Power to Machine Learning
								</p>
							</div>		
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="https://eim.mit.edu/bootcamp-assets/images/iman_urooj.png" alt="Iman Urooj" title="Iman Urooj" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Iman Urooj</h5>
								 <p class="alumni_featured_data">
									Innovating in a Family Business
								</p>
							</div>									
  						</div>
					</div>
					
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="https://eim.mit.edu/bootcamp-assets/images/Jamshid-Hashimi.png" alt="Jamshid Hashimi" title="Jamshid Hashimi" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    						    <h5 class="alumni_featured_name">Jamshid Hashimi</h5>
								 <p class="alumni_featured_data">
									Software Engineer in Afghanistan Turned Global Social Entrepreneur
								</p> 
							</div>		
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="https://eim.mit.edu/bootcamp-assets/images/Rodrigo-Macias.png" alt="Rodrigo Macias" title="Rodrigo Macias" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Rodrigo Macias</h5>
								 <p class="alumni_featured_data">
									Medical Doctor Turned Entrepreneur
								</p>
							</div>		
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="https://eim.mit.edu/bootcamp-assets/images/luciano_araujo.png" alt="Luciano Da Silveira Araujo" title="Luciano Da Silveira Araujo" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Luciano Da Silveira Araujo</h5>
								 <p class="alumni_featured_data">
									From Building Drones to Building a Drones Business
								</p>
							</div>									
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="https://eim.mit.edu/bootcamp-assets/images/michael_mccausland.png" alt="Michael McCausland" title="Michael McCausland" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Michael McCausland</h5>
								 <p class="alumni_featured_data">
									Nuclear operator turned Entrepreneurship Educator
								</p>
							</div>									
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="https://eim.mit.edu/bootcamp-assets/images/inga_stasiulionyte.png" alt="Inga Stasiulionyte" title="Inga Stasiulionyte" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Inga Stasiulionyte</h5>
								 <p class="alumni_featured_data">
									From Olympian to Bootcamper to Entrepreneur
								</p>
							</div>									
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="https://eim.mit.edu/bootcamp-assets/images/paul_lam.png" alt="Paul Lam" title="Paul Lam" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Paul Lam</h5>
								 <p class="alumni_featured_data">
									Investment Analyst leaves the World Bank and turns Entrepreneur
								</p>
							</div>									
  						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 col-sm-12 col-xs-12 text-right loadm">
						<a href="" onclick="trackEvent('click','EOB V1','Expand','Load More Alumni')" class="load_more" id="loadMore">Load more</a>
					</div>
				</div>
			
				</div>	
		
			
			<div class="container-fluid" id="Alumni">	
				<div class="container Alumni-speak" >
						<h1 class="heading mart50 marb0">Alumni Speak</h1>
						<div class="row p-50 container-row text-center">	
							<div class="carousel slide" data-ride="carousel" id="quote-carousel" tabindex="-1">
								<!-- Carousel Slides / Quotes -->
								<div class="carousel-inner text-center">
									
									<!-- Quote 1 -->
									<div class="item active left">
										<blockquote>
											<div class="row">
												<div class="col-sm-12">
													<p class="speak_data">"The MIT Global Entrepreneurship Bootcamp I attended was life-changing and continues to provide value to my professional and personal life years after I attended. The experience itself will transform you. It has Opened career opportunities I would not have expected. I've also found friendships with incredibly smart and talented people from every corner of the globe."
													</p>
													<div class="testimonial-details hidden-xs">
														<ul>
															<li><p class="disription text-left data"><b> Renee, MIT Global Entrepreneurship Bootcamp, Class 1</b>
																</p>	
															</li>
														</ul>
													</div>
													<p class="disription text-left data visible-xs"><b>— Renee, MIT Global Entrepreneurship Bootcamp, Class 1</b>
													</p>
												</div>
											</div>
										</blockquote>
									</div>
									<!-- Quote 2 -->
									<div class="item next left">
										<blockquote>
											<div class="row">
												<div class="col-sm-12">
													<p class="speak_data">"The 24 steps that I learned in the online Bootcamp opened my eyes to the reality of how to bring a product from concept to commercialisation.”
													</p>
													<div class="testimonial-details hidden-xs">
														<ul>
															<li><p class="disription text-left data"><b> Joalin Lim, Managing Director, Agape</b>
																</p>	
															</li>
															<li><p class="disription text-left data"><b>SINGAPORE</b></p>
															</li>
														</ul>
													</div>
													<p class="disription text-left data visible-xs"><b>— Joalin Lim, Managing Director, Agape</b>
													</p>
													<p class="disription text-left data visible-xs"><b>SINGAPORE</b>
													</p>
												</div>
											</div>
										</blockquote>
									</div>
									<!-- Quote 3 -->
									<div class="item">
										<blockquote>
											<div class="row">
												<div class="col-sm-12">
													<p class="speak_data">"The online Bootcamp exposed me to common and current practices that I can use or refer back to when I need to commercialise and start up a company in the future.”
													</p>
													<div class="testimonial-details hidden-xs">
														<ul>
															<li><p class="disription text-left data"><b> Hareth Wassiti, PhD Candidate, Monash University</b>
																</p>	
															</li>
															<li><p class="disription text-left data"><b>AUSTRALIA</b></p>
															</li>
														</ul>
													</div>
													<p class="disription text-left data visible-xs"><b>— Hareth Wassiti, PhD Candidate, Monash University</b>
													</p>
													<p class="disription text-left data visible-xs"><b>AUSTRALIA</b>
													</p>
												</div>
											</div>
										</blockquote>
									</div>		
									<!-- Quote 4 -->
									<div class="item">
										<blockquote>
											<div class="row">
												<div class="col-sm-12">
													<p class="speak_data">"I’ve already started another company and closed my first 3 million dollar contract with the government.”
													</p>
													<div class="testimonial-details hidden-xs">
														<ul>
															<li><p class="disription text-left data"><b> Gerhard Rickert, Chief Engineer-Cyber Security, Deloitte</b>
																</p>	
															</li>
															<li><p class="disription text-left data"><b>JAPAN</b></p>
															</li>
														</ul>
													</div>
													<p class="disription text-left data visible-xs"><b>— Gerhard Rickert, Chief Engineer-Cyber Security, Deloitte</b>
													</p>
													<p class="disription text-left data visible-xs"><b>JAPAN</b>
													</p>
												</div>
											</div>
										</blockquote>
									</div>
									<!-- Quote 5 -->
									<div class="item">
										<blockquote>
											<div class="row">
												<div class="col-sm-12">
													<p class="speak_data">"Several concepts of this program were new to my knowledge. All of them are really valuable. I will apply everything I’ve learned in my new ventures. Thanks MIT!”
													</p>
													<div class="testimonial-details hidden-xs">
														<ul>
															<li><p class="disription text-left data"><b> Jose Ravines, Manager, Invenio Consultoria</b>
																</p>	
															</li>
															<li><p class="disription text-left data"><b>PERU</b></p>
															</li>
														</ul>
													</div>
													<p class="disription text-left data visible-xs"><b>— Jose Ravines, Manager, Invenio Consultoria</b>
													</p>
													<p class="disription text-left data visible-xs"><b>PERU</b>
													</p>
												</div>
											</div>
										</blockquote>
									</div>
									<!-- Quote 6 -->
									<div class="item">
										<blockquote>
											<div class="row">
												<div class="col-sm-12">
													<p class="speak_data">“I am working on my personal idea now and hope to test it against the market this year. Thank you for the learning experience.”
													</p>
													<div class="testimonial-details hidden-xs">
														<ul>
															<li><p class="disription text-left data"><b> Larry Ndanga, Software Engineer, Auctor Corporation</b>
																</p>	
															</li>
															<li><p class="disription text-left data"><b>UNITED STATES</b></p>
															</li>
														</ul>
													</div>
													<p class="disription text-left data visible-xs"><b>— Larry Ndanga, Software Engineer, Auctor Corporation</b>
													</p>
													<p class="disription text-left data visible-xs"><b>UNITED STATES</b>
													</p>
												</div>
											</div>
										</blockquote>
									</div>
									<!-- Quote 7 -->
									<div class="item">
										<blockquote>
											<div class="row">
												<div class="col-sm-12">
													<p class="speak_data">"The MIT Entrepreneurship Online Bootcamp helped me understand all what I was doing wrong in my existing ventures and refocus them to success.”
													</p>
													<div class="testimonial-details hidden-xs">
														<ul>
															<li><p class="disription text-left data"><b> Francisco Sanchez Arroyo, Founder, The Beach Lab</b>
																</p>	
															</li>
															<li><p class="disription text-left data"><b>SPAIN</b></p>
															</li>
														</ul>
													</div>
													<p class="disription text-left data visible-xs"><b>— Francisco Sanchez Arroyo, Founder, The Beach Lab</b>
													</p>
													<p class="disription text-left data visible-xs"><b>SPAIN</b>
													</p>
												</div>
											</div>
										</blockquote>
									</div>
									<!-- Quote 8 -->
									<div class="item">
										<blockquote>
											<div class="row">
												<div class="col-sm-12">
													<p class="speak_data">"Thank you for letting prospective entrepreneurs of the future get exposed to what MIT has to offer and thank you for introducing us to Bill Aulet. This course was a great start. Now I'm looking for the next learning and practice opportunity."
													</p>
													<div class="testimonial-details hidden-xs">
														<ul>
															<li><p class="disription text-left data"><b> Alperen Ozalp, Install Base Product Manager, Accuray</b>
																</p>	
															</li>
															<li><p class="disription text-left data"><b>UNITED STATES</b></p>
															</li>
														</ul>
													</div>
													<p class="disription text-left data visible-xs"><b>— Alperen Ozalp, Install Base Product Manager, Accuray</b>
													</p>
													<p class="disription text-left data visible-xs"><b>UNITED STATES</b>
													</p>
												</div>
											</div>
										</blockquote>
									</div>
								
								</div>
								<!-- Carousel Buttons Next/Prev -->
								<a data-slide="prev" href="#quote-carousel" class="left carousel-control" onclick="trackEvent('click','EOB V1','Slide','Alumni Speak')"><i class="fa fa-chevron-left" ></i></a>
								<a data-slide="next" href="#quote-carousel" class="right carousel-control" onclick="trackEvent('click','EOB V1','Slide','Alumni Speak')"><i class="fa fa-chevron-right"></i></a>
							</div>
						</div>
				</div>
			</div>
			
			
			<div class="container featured-coch">
				<h1 class="heading">Featured Coaches</h1>	
				<div class="row p-50 container-row clearfix featured-coaches">
					<div class="col-md-4 col-sm-4">
						<fieldset class="featured_coaches">
    						<legend align="center" class="img-circle"><img src="https://eim.mit.edu/bootcamp-assets/images/Luciano-da-Silveira-Araujo.png" alt="Luciano da Silveira Araujo" title="Luciano da Silveira Araujo"></legend>
    						    <h5 class="user-name">Luciano da Silveira Araujo</h5>
								
								 <p class="data-featured">
									Luciano da Silveira Araujo has worked in the fields of design and innovation for almost tw...</p> 
								<a class="txt-color" data-toggle="modal" data-target="#myModal21" onclick="trackEvent('click','EOB V1','Pop Up','More Info Coaches')">More info</a>
  						</fieldset>
					</div>
					<!-- Modal -->
					<div class="modal fade" id="myModal21" role="dialog">
					    <div class="modal-dialog modal-lg">
					    	 <!-- Modal content-->
					     	<div class="modal-content">
					        	<div class="modal-header text-center">
					         		<button type="button" class="close" data-dismiss="modal">×</button>
					          		<img src="https://eim.mit.edu/bootcamp-assets/images/Luciano-da-Silveira-Araujo.png" alt="Luciano da Silveira Araujo" title="Luciano da Silveira Araujo" class="img-circle">
					          		<!-- <h4 class="modal-title">Modal Header</h4> -->
					        	</div>
					       		<div class="modal-body">
					          		<p class="text-center  profile">
					          			</p><h5 class="user-name">Luciano da Silveira Araujo</h5>
									<p></p>

									<p>Luciano da Silveira Araujo has worked in the fields of design and innovation for almost two decades. He studied architecture at FAU-USP (2001) and is an autodidact inventor, with experience in industrial design and aeronautical equipment. He is the co-founder of OVO DESIGN LTDA (2003) and Professor of Design at IED-SP (2005-2012).</p>
									<p class="faculty_gap">
									As Architect and designer, Luciano worked at Cauduro Martino Arquitetos Associados with top brands like Banco do Brasil, and Bunge developing complex corporate visual identity manuals, and developed with his team at OVO DESiGN projects creating logos, graphic design, packaging, web design, way find design, product design, scenography, etc.
									</p>
					        	</div>
					        	<!-- <div class="modal-footer">
					          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        	</div> -->
					    	</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<fieldset class="featured_coaches">
    						<legend align="center" class="img-circle"><img src="https://eim.mit.edu/bootcamp-assets/images/Simon-Berman.png" alt="Simon Berman" title="Simon Berman"></legend>
    							<h5 class="user-name">Simon Berman</h5>
								<p class="data-featured">	
									Simon Berman is a serial tech entrepreneur who is currently the CEO of social education c...</p>
								<a class="txt-color" data-toggle="modal" data-target="#myModal22" onclick="trackEvent('click','EOB V1','Pop Up','More Info Coaches')">More info</a>
  						</fieldset>
					</div>
					<div class="modal fade" id="myModal22" role="dialog">
					    <div class="modal-dialog modal-lg">
					    	 <!-- Modal content-->
					     	<div class="modal-content">
					        	<div class="modal-header text-center">
					         		<button type="button" class="close" data-dismiss="modal">×</button>
					          		<img src="https://eim.mit.edu/bootcamp-assets/images/Simon-Berman.png" alt="Simon Berman" title="Simon Berman" class="img-circle">
					          		<!-- <h4 class="modal-title">Modal Header</h4> -->
					        	</div>
					       		<div class="modal-body">
					          		<p class="text-center profile">
					          			</p><h5 class="user-name">Simon Berman</h5>
									
									<p>Simon Berman is a serial tech entrepreneur who is currently the CEO of social education company On a Roll 21. Having engaged in a wide range of educational systems from formal higher education to self-directed online study, Simon's mission is to create an educational platform which synthesizes the most engaging and effective aspects of these modalities.</p>
 
									<p class="faculty_gap">
									Simon is currently formalizing his development knowledge with a postgraduate degree in Computer Science from RMIT, where he also studied his undergrad in computer art. It is through his work as a professional artist that Simon deepened his knowledge of software and technology, namely by creating unlikely, impractical and, what the market ultimately deemed to be, undesirable artefacts.
									</p>
					       		</div>
					        	<!-- <div class="modal-footer">
					         		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        	</div> -->
					    	</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<fieldset class="col-4 featured_coaches">
    						<legend align="center" class="img-circle"><img src="https://eim.mit.edu/bootcamp-assets/images/Inga-Stasiulionyte.png" alt="Inga Stasiulionyte" title="Inga Stasiulionyte"></legend>
    							<h5 class="user-name">Inga Stasiulionyte</h5>
								<p class="data-featured">
									Inga Stasiulionyte is an Olympian athlete and javelin thrower, who was coached by the best...</p>
								<a class="txt-color" data-toggle="modal" data-target="#myModal23" onclick="trackEvent('click','EOB V1','Pop Up','More Info Coaches')">More info</a>
  						</fieldset>
					</div>
					<div class="modal fade" id="myModal23" role="dialog">
					    <div class="modal-dialog modal-lg">
					    	 <!-- Modal content-->
					     	<div class="modal-content">
					        	<div class="modal-header text-center">
					         		<button type="button" class="close" data-dismiss="modal">×</button>
					          		<img src="https://eim.mit.edu/bootcamp-assets/images/Inga-Stasiulionyte.png" alt="Inga Stasiulionyte" title="Inga Stasiulionyte" class="img-circle">
					          		<!-- <h4 class="modal-title">Modal Header</h4> -->
					        	</div>
					       		<div class="modal-body">
					          		<p class="text-center profile">
					          			</p><h5 class="user-name">Inga Stasiulionyte</h5>

									<p>Inga Stasiulionyte is an Olympian athlete and javelin thrower, who was coached by the best coaches in Europe and the U.S. for over 20 years, and competed at the Beijing Olympic Games. Besides developing her career in sports, Inga simultaneously pursued a career in business, working with executives as a brain training coach.</p>
 
									<p class="faculty_gap">
									Inga's dream is to provide access to everyone to the knowledge, tools and training that she received in sports that helped her win. She cooperated with a motivational writer to create Onbotraining, an online mind coaching program that trains people skills needed to reach desired goals in life.
									</p>
					       		 </div>
					       		<!-- <div class="modal-footer">
					          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        	</div> -->
					    	</div>
						</div>
					</div>
				</div>
			</div>	
		
			
			
			
		<div class="margin-section clearfix">
			<div class="clearfix certificate">
				<h1 class="heading padl80 hide-destop">Certificate</h1>
					<div class="col-md-5 col-sm-5 text-center pull-right">
						<div class="padr80">
							<img src="https://eim.mit.edu/bootcamp-assets/images/certificate.png" alt="MIT Entrepreneurship Online Bootcamp" title="MIT Entrepreneurship Online Bootcamp"class="img-responsive">
						</div>	
					</div>
					<div class="col-md-7 col-sm-7 certificate-text-section">
						<div class="padl80">
							<h1 class="heading no-marg">Certificate</h1>
							<p class="text-left padl80">Get recognized! Upon successful completion of the program, MIT grants a verified digital certificate of completion to participants. This program is graded as a pass or fail; participants must receive 60% to pass and obtain the certificate of completion.
							</p>
							<a href="#2" onclick="trackEvent('click','EOB V1','ScrollUp','Earn Your Certificate')" target="_blank"><button class="btn btn-default download-btn">EARN YOUR CERTIFICATE</button></a>
						</div>
					</div>
			</div>
		</div>
		<div class="top-footer">
			<div class="text-center">
				<a href="https://emeritus-admissions.secure.force.com/StudentPrograms?pid=01t0I0000042WWp" onclick="trackEvent('click','EOB V1','Redirect','Apply Now')" target="_blank"><button class="btn btn-default apply-btn">APPLY NOW</button></a>
				<h3>Early applications are encouraged. Seats fill up quickly!</h3>
				<h5>Flexible payment options available. <a href="#" onclick="trackEvent('click','EOB V1','Pop Up','Flexi Pay')" class="applynow" data-toggle="modal" data-target="#myModal">Click here</a> to know more.</h5>
			</div>
		</div>
		<footer class="text-center">
			<div class="container m-tb-50 nav-left-logo">
						<p class="faq-section"> For any further queries regarding the online Bootcamp, <a href="https://eim.mit.edu/files/online-bootcamp-faq.html" onclick="trackEvent('click','EOB LP','Redirect','FAQs page')"  target="_blank">please refer the FAQs page</a>.</p>
						<a href="javascript:void(0)"> <img src="https://eim.mit.edu/bootcamp-assets/images/footer-logo.png" class="img-responsive" style="display:inline;"  alt="Emeritus Institue of Management" title="Emeritus Institue of Management"/>
						</a>
				<div class="container clearfix">		
					<p class="footer_p text-center">
						Massachusetts Institute of Technology (MIT) is collaborating with online education provider EMERITUS Institute of Management to offer a portfolio of high-impact online programs. These programs leverage MIT's thought leadership in management practice developed over years of research, teaching, and practice. By collaborating with EMERITUS, we are able to broaden access beyond our on-campus offerings in a collaborative and engaging format that stays true to the quality of MIT.
					</p>
				</div>	
			</div>
		</footer>
	</div>
	<div class="model_box">
		<div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body flexi">
            <div class="clearfix content_h5">
              <h5>The Flexible payment option allows a student to pay the course fee in installments. This option is made available in the application form and should be selected before making the payment.</h5>
            </div>
            <div class="clearfix content_p">
            	<h5>The following payment options are available for the <i>MIT Entrepreneurship Online Bootcamp program</i>:</h5>
				<ul class="ul_style">Pay in Full</ul>
					<li>Pay the entire course fee of <b>$2,950</b> at once.
					</li>
				</ul>

				<ul class="ul_style">Pay in 2 installments</ul>
					<li>The first installment of <b>$1,132</b> is <b>due immediately</b>.
					</li>
					<li>The final installment of <b>$1,847</b> is to be paid by <b>September 01, 2018</b>.
					</li>
				</ul>

				<ul class="ul_style">Pay in 3 installments</ul>
					<li>The first installment of <b>$1,124</b> is <b>due immediately</b>.
					</li>
					<li>The second installment of <b>$1,124</b> is to be paid by <b>September 01, 2018</b>.
					</li>
					<li>The final installment of <b>$790</b> is to be paid by <b>September 29, 2018</b>.
					</li>
				</ul>
            </div>
    </div>
	
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://eim.mit.edu/bootcamp-assets/js/com.js?v=0.0.1"></script>
<script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0071/5326.js" async="async"></script>

<script type="text/javascript" src="https://emeritus.org/programmes/common/js/countries-new.js"></script>
<script async type="text/javascript" src="https://emeritus.org/programmes/common/gdpr.js?v=0.0.1"></script>
<script> 
populateCountries("country");

var tag = document.createElement('script'); 
tag.src = "https://www.youtube.com/player_api"; 
var firstScriptTag = document.getElementsByTagName('script')[0]; 
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player; 
function onYouTubePlayerAPIReady() { 
player = new YT.Player('player', { 
height: '700', 
width: '100%', 
videoId: 'wbQDeP5w7C4', 
playerVars: {rel: 0},
events: { 
'onReady': onPlayerReady, 
'onStateChange': onPlayerStateChange 
} 
}); 
}
function onPlayerReady(event) { 
/// event.target.playVideo(); 
} 

function onPlayerStateChange(event) { 
	if (event.data ==YT.PlayerState.PLAYING) 
	{
		trackEvent('Play', 'EOB V1', 'Watch Video', 'Play Video');
	} 
} 
</script> 
   
<!-- Tracking Code Start--> 
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NX2MRZJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



<!-- Tracking Code end-->

<!-- begin Pardot Website Tracking code -->

<script type="text/javascript">
piAId = '64132';
piCId = '2042';
piHostname = 'pi.pardot.com'; 

(function() {
	function async_load(){
		var s = document.createElement('script'); s.type = 'text/javascript';
		s.src = ('https:' == document.location.protocol ? 'https://pi' : 'http://cdn') + '.pardot.com/pd.js';
		var c = document.getElementsByTagName('script')[0]; c.parentNode.insertBefore(s, c);
	}
	if(window.attachEvent) { window.attachEvent('onload', async_load); }
	else { window.addEventListener('load', async_load, false); }
})();
</script>
<script>
var sr = 3;
	$(function () {
    $(".load_more_show").slice(0, 0).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".load_more_show:hidden").slice(0, 3).slideDown();
		sr	= sr+3;
        if ($(".load_more_show:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
		if(sr == 9)
		{
			$("#loadMore").hide();
		}
    });
});

function resetHeight()
{
 var maxHeight = 0;
 $(".alumni_featured_band").each(function(){
    if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
 });
 $(".alumni_featured_band").height(maxHeight);
 $(".alumni_featured_band").css('background','#A31F34');
 $(".alumni_featured_band").css('padding-bottom','20px');
 $(".alumni_featured_band").css('padding-top','18px');
 $(".alumni_featured_band").css('margin-bottom','19px');
}

$(window).on('resize', function() {
 resetHeight()
});
resetHeight();
</script>
<!-- end Pardot Website Tracking code -->
</body>
</html>