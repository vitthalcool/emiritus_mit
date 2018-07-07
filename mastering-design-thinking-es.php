	<!DOCTYPE html>
<html>

<head>
		<title>Mastering Design Thinking | MIT Sloan</title>
		<meta charset="utf-8" /> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="title" content="Mastering Design Thinking by MIT Sloan | Enroll Now">
		<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
		<link rel="manifest" href="favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<link rel="stylesheet" type="text/css" href="assets/css/style_new.css?v=0.0.3">
		<link rel="stylesheet" type="text/css" href="assets/css/responsive_new.css?v=0.0.4">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">				<link rel="stylesheet" href="https://emeritus.org/programmes/common/gdpr.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
		<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="e71576a1-0522-411a-b664-6e273d169185" type="text/javascript" async></script>
		<!--Google tracking code new starts-->
		<style>.async-hide { opacity: 0 !important} </style>
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
					trackEvent('click','MDT LP','FormSubmit','Form_Submit')
					
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
							<a href="./mastering-design-thinking-es.php" onclick="trackEvent('click','MDT LP','Reload','Partner Logo')"><img src="https://eim.mit.edu/assets/images/logo.png" alt="MIT Sloan" title="MIT Sloan" class="img-responsive"></a>
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
							<h1>MASTERING DESIGN THINKING</h2>
						</div>
					</div>
						<div id="2" class="col-md-5 form-div no_pad form-section">
							<form class="form-horizontal contact-form" role="form" id="frm" name="frm" method="POST" action="submit-es.php">
								<h2>&nbsp;&nbsp;GET PROGRAM INFO</h2>
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
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Mobile No.*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="mobile" placeholder="" name="mobile">
											<span class="error-text"></span>
											<span class="small"><!--(e.g.: 9988776623)--></span>
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Work Experience*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<select  id="workexp" name="workexp" title="Work Experience" class="select">
												<option value=""></option>
												<option value="Less than 5 Years">Less than 5 Years</option>
												<option value="5-10 Years">5-10 Years</option>
												<option value="10-15 Years">10-15 Years</option>
												<option value="15-20 Years">15-20 Years</option>
												<option value="&gt; 20 Years">&gt; 20 Years</option>
											</select>
											<span class="error-text"></span>
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
										<div class="col-sm-12 margin-bottom">
											<input type="submit" class="btn btn-default download-btn" value="DOWNLOAD BROCHURE >"/>
										</div>
									<div class="col-sm-12 privacy-section">
										<p><small>Your details will not be shared with third parties.</small>
											<strong><small><a href="http://emeritus.org/privacy-policy/" target="_blank" style="color:#000000;">Privacy Policy</a></small></strong>
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
						<img src="assets/images/start.png" alt="Starts on" title="Starts on">
					</div>
					<div class="img-content">
						<h3>Starts on</h3>
						<p><b>June 28, 2018</b></p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="assets/images/duration.png" alt="Duration" title="Duration">
					</div>
					<div class="img-content">
						<h3>Duration</h3>
						<p><b>3 months, online</b><br class="mobile-show"> 
						<span class="f18">6-8 hours per week</span>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="assets/images/fee.png" alt="Program Fees" title="Program Fees">
					</div>
					<div class="img-content">
						<h3>program fees</h3>
						<p><b>$2,600</b></p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container padtop">
				<h1 class="heading">Why Master Design Thinking?</h1>
				<p class="text-left intro-text">
					Design thinking is a powerful process of problem solving that begins with understanding unmet customer needs. From that insight emerges a process for innovation that encompasses concept development, applied creativity, prototyping, and experimentation. When design thinking approaches are applied to business, the success rate for innovation improves substantially.
				</p>
				<div class="mb92">
						<a href="#2" onclick="trackEvent('click','MDT LP','ScrollUp','Download Brochure')"><button class="btn btn-default download-btn"> DOWNLOAD BROCHURE</button></a>
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
							<img src="assets/images/your-learning-journey-graphic1.png" class="img-responsive" alt="Your Learning Journey" title="Your Learning Journey">
						</div>
						<div class="text-center clearfix">
							<ul class="no-style">
								<li class="col20">
									<div class="box-section blue">
									<img src="assets/images/icon1.png" alt="Video Lectures" title="Video Lectures">
									</div>
									<p class="data-section">128 Video Lectures</p>
								</li>
								<li class="col20">
									<div class="box-section">
									<img src="assets/images/icon2.png" alt="Live Teaching Sessions" title="Live Teaching Sessions">
									</div>
									<p class="data-section">3 Live Teaching Sessions</p>									
								</li>
								<li class="col20">
									<div class="box-section blue">
									<img src="assets/images/icon3.png" alt="Group Projects" title="Group Projects">
									</div>
									<p class="data-section">3 Group Projects</p>
								</li>
								<li class="col20">
									<div class="box-section blue">
									<img src="assets/images/icon4.png" alt="Assignments" title="Assignments">
									</div>
									<p class="data-section">10 Assignments</p>
								</li>
								<li class="col20">
									<div class="box-section blue">
									<img src="assets/images/icon5.png" alt="Capstone Project" title="Capstone Project">
									</div>
									<p class="data-section">1 Capstone Project</p>
								</li>
								<li class="col20">
									<div class="box-section blue">
									<img src="assets/images/icon6.png" alt="Real World Applications" title="Real World Applications">
									</div>
									<p class="data-section">7 Real World Applications</p>
								</li>
							</ul>							
						</div>
						<div class="row clearfix padding-up">
							<div class="col-md-6 col-sm-6">
								<div class="syllabus">
									<ul>
										<li><span class="ul-head">Orientation Module:</span> Welcome to your Online Campus
										</li>
										<li><span class="ul-head">Module 1:</span> Design Thinking Skills</li>
										<li><span class="ul-head">Module 2:</span> Identifying Customer Needs</li>
										<li><span class="ul-head">Module 3:</span> Product Specifications</li>
										<li><span class="ul-head">Module 4:</span> Applied Creativity</li>
										<li><span class="ul-head">Module 5:</span> Prototyping</li>
									</ul>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 your-learning-mt">
								<div class="syllabus">
									<ul>
										
										<li><span class="ul-head">Module 6:</span> Design for Services</li>
										<li><span class="ul-head">Module 7:</span> Product Architecture</li>
										<li><span class="ul-head">Module 8:</span> Financial Analysis</li>										
										<li><span class="ul-head">Module 9:</span> Design for Environment</li>
										<li><span class="ul-head">Module 10:</span> Product Development Processes</li>
									</ul>
								</div>
							</div>
						</div>
					</div>		
					<div class="marb92">	
						<a href="#2" onclick="trackEvent('click','MDT LP','ScrollUp','Download Syllabus')" target="_blank"><button class="btn btn-default download-btn">DOWNLOAD SYLLABUS</button></a>
					</div>	
				</div>
				
			
			<div class="container-fluid" id="Faculty">
				<h1 class="heading">Faculty</h1>	
					<div class="row container clearfix featured-coaches">
					<div class="col-md-4 col-sm-4">
						<fieldset class="featured_faculty">
    						<legend align="center" class="img-circle"><img src="assets/images/Steven-Eppinger.png" alt="Steve Eppinger" title="Steve Eppinger"></legend>
    						    <h5 class="user-name">Steve Eppinger</h5>
								<h5>General Motors Leaders for Global Operations Professor of Management</h5>
								 <p class="data-featured">
									Professor Steve Eppinger is the Professor of Management Science & Engineering...</p> 
								<a class="txt-color" data-toggle="modal" data-target="#myModal11" onclick="trackEvent('click','MDT LP','Pop Up','Faculty')">More info</a>
  						</fieldset>
					</div>
					<!-- Modal -->
					<div class="modal fade" id="myModal11" role="dialog">
					    <div class="modal-dialog modal-lg">
					    	 <!-- Modal content-->
					     	<div class="modal-content">
					        	<div class="modal-header text-center">
					         		<button type="button" class="close" data-dismiss="modal">×</button>
					          		<img src="assets/images/Steven-Eppinger.png" alt="Steve Eppinger" title="Steve Eppinger" class="img-circle">
					          		<!-- <h4 class="modal-title">Modal Header</h4> -->
					        	</div>
					       		<div class="modal-body">
					          		<p class="text-center  profile">
					          			</p><h5 class="user-name">Steve Eppinger</h5>
										<h5>General Motors Leaders for Global Operations Professor of Management</h5>

									<p>Professor Steve Eppinger is the Professor of Management Science & Engineering Systems as well as the Co-director for the System Design & Management Program. His research efforts are applied to improving product design and development practices. Conducted within MIT's Center for Innovation in Product Development, his work focuses on organizing complex design processes in order to accelerate industrial practices and has been applied primarily in the automotive, electronics, aerospace, and equipment industries.
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
    						<legend align="center" class="img-circle"><img src="assets/images/Matthew-Kressy.png" alt="Matthew Kressy" title="Matthew Kressy"></legend>
    							<h5 class="user-name">Matthew Kressy</h5>
								<h5>Director and Founder, MIT Integrated Design & Management (IDM), Senior Lecturer at MIT</h5>
								<p class="data-featured">	
								Matt Kressy is a Senior Lecturer at MIT System Design & Management and the...</p>
								<a class="txt-color" data-toggle="modal" data-target="#myModal12" onclick="trackEvent('click','MDT LP','Pop Up','Faculty')">More info</a>
  						</fieldset>
					</div>
					<div class="modal fade" id="myModal12" role="dialog">
					    <div class="modal-dialog modal-lg">
					    	 <!-- Modal content-->
					     	<div class="modal-content">
					        	<div class="modal-header text-center">
					         		<button type="button" class="close" data-dismiss="modal">×</button>
					          		<img src="assets/images/Matthew-Kressy.png" alt="Matthew Kressy" title="Matthew Kressy" class="img-circle">
					          		<!-- <h4 class="modal-title">Modal Header</h4> -->
					        	</div>
					       		<div class="modal-body">
					          		<p class="text-center profile">
					          			</p><h5 class="user-name">Matthew Kressy</h5>
										<h5>Director and Founder, MIT Integrated Design & Management (IDM), Senior Lecturer at MIT</h5>
									
									<p>Matt Kressy is a Senior Lecturer at MIT System Design & Management and the Principal at Designturn, Inc. Kressy believes in interdisciplinary, design-driven product development derived from deep user research, creative concept generation, and rapid prototype iteration. He is passionate about teaching this approach to the design process.
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
    						<legend align="center" class="img-circle"><img src="assets/images/David-Robertson.png" alt="David Robertson" title="David Robertson"></legend>
    							<h5 class="user-name">David Robertson</h5>
								<h5>Senior Lecturer at MIT</h5>
								<p class="data-featured">
									David Robertson is a Senior Lecturer at the MIT Sloan School of Management...</p>
								<a class="txt-color" data-toggle="modal" data-target="#myModal13" onclick="trackEvent('click','MDT LP','Pop Up','Faculty')">More info</a>
  						</fieldset>
					</div>
					<div class="modal fade" id="myModal13" role="dialog">
					    <div class="modal-dialog modal-lg">
					    	 <!-- Modal content-->
					     	<div class="modal-content">
					        	<div class="modal-header text-center">
					         		<button type="button" class="close" data-dismiss="modal">×</button>
					          		<img src="assets/images/David-Robertson.png" alt="David Robertson" title="David Robertson" class="img-circle">
					          		<!-- <h4 class="modal-title">Modal Header</h4> -->
					        	</div>
					       		<div class="modal-body">
					          		<p class="text-center profile">
					          			</p><h5 class="user-name">David Robertson</h5>
										<h5>Senior Lecturer at MIT</h5>							

									<p>David Robertson is a Senior Lecturer at the MIT Sloan School of Management where he teaches Product Development and Digital Product Management. David is the author of the award-winning book about LEGO’s near-bankruptcy and spectacular recovery: <i> Brick by Brick: How LEGO Rewrote the Rules of Innovation and Conquered the Global Toy Industry (Crown, 2013)</i>.
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
							<img src="assets/images/certificate-masteringdt_new.png" alt="Mastering Design Thinking" title="Mastering Design Thinking" class="img-responsive">
						</div>	
					</div>
					<div class="col-md-7 col-sm-7 certificate-text-section">
						<div class="padl80">
							<h1 class="heading no-marg">Certificate</h1>
							<p class="text-left padl80">Get a verified digital certificate of completion from MIT Sloan School of Management. This program also counts towards an MIT Sloan Executive Certificate. <a href="https://executive.mit.edu/executivecertificates#.WZwbPj4jHIW" target="_blank" onclick="trackEvent('click','MDT LP','Redirect','Learn More')">Learn More </a>
							</p>
							<a href="#2" onclick="trackEvent('click','MDT LP','ScrollUp','Earn Your Certificate')" target="_blank"><button class="btn btn-default download-btn">EARN YOUR CERTIFICATE</button></a>
						</div>
					</div>
			</div>
			<div class="col-md-12 padl80">
					<div class="padl80 padr80">
						<i class="note-section"> After successful completion of the program, your verified digital certificate will be emailed to you, at no additional cost, in the name you used when registering for the program. All certificate images are for illustrative purposes only and may be subject to change at the discretion of MIT Sloan. </i>
					</div>	
				</div>
		</div>	
		<div class="top-footer">
			<div class="text-center">
				<a href="https://emeritus-admissions.secure.force.com/StudentPrograms?pid=01t280000042Bbc" onclick="trackEvent('click','MDT LP','Redirect','Apply Now')" target="_blank"><button class="btn btn-default apply-btn">Apply Now</button></a>
				<h3>Early applications encouraged.</h3>
				<h5>Flexible payment options available. <a href="#" onclick="trackEvent('click','MDT LP','Pop Up','Flexi Pay')" class="applynow" data-toggle="modal" data-target="#myModal">Click here</a> to know more.</h5>
			</div>
		</div>
		<footer class="text-center">
			<div class="container m-tb-50 nav-left-logo">
			
				<!--<ul class="social-network social-circle  m-tb-50">
					<li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
				</ul>-->
						<img src="https://eim.mit.edu/assets/images/footer-logo.png?v=0.0.1" alt="EMERITUS Institute of Management" title="EMERITUS Institute of Management">
			
					<div class="container clearfix">		
						<p class="footer_p text-center">
							MIT Sloan Executive Education is collaborating with online education provider EMERITUS Institute of Management to offer a portfolio of high-impact online programs. These programs leverage MIT Sloan's thought leadership in management practice developed over years of research, teaching and practice. By working with EMERITUS, MIT Sloan Executive Education is able to broaden access beyond on-campus offerings in a collaborative and engaging format that stays true to the quality of MIT Sloan and MIT as a whole.
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
              <h5>The Flexible payment option allows a student to pay the program fee in installments. This option is made available in the application form and should be selected before making the payment.</h5>
            </div>
            <div class="clearfix content_p">
            <h5>The following payment options are available for the <i>Mastering Design Thinking program</i>:</h5>
				<ul class="ul_style">Pay in Full</ul>
					<li>Pay the entire course fee of <b>$2,600</b> at once</b>.
					</li>
				</ul>

				<ul class="ul_style">Pay in 2 installments</ul>
					<li>The first installment of <b>1,485</b> would be <b>due immediately</b>.
					</li>
					<li>The second installment of <b>$1,167</b> will be charged on <b>Jul 28, 2018</b>.
					</li>
				</ul>

				<ul class="ul_style">Pay in 3 installments</ul>
					<li>The first installment of <b>$983</b> would be <b>due immediately</b>.
					</li>
					<li>The second installment of <b>$874</b> will be charged on <b>Jul 28, 2018</b>.
					</li>
					<li>The third installment of <b>$874</b> will be charged on <b>Aug 22, 2018</b>.
					</li>
				</ul>
            </div>
    </div>
	

<script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
		<script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!--<script async type="text/javascript" src="https://eim.mit.edu/assets/js/common.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://eim.mit.edu/assets/js/jquery.inview.min.js"></script>
		<script src="https://eim.mit.edu/assets/js/jquery.youtube-inview-autoplay.js"></script>-->
		<script async type="text/javascript" src="https://eim.mit.edu/assets/js/com.js?v=0.0.1"></script>
		<script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0071/5326.js" async="async"></script>
		
<script type="text/javascript" src="https://emeritus.org/programmes/common/js/countries-new.js"></script>
<script async type="text/javascript" src="https://emeritus.org/programmes/common/gdpr.js?v=0.0.1"></script>
<script> 
		populateCountries("country");
		
		var tag = document.createElement('script'); 
		tag.src = "//www.youtube.com/player_api"; 
		var firstScriptTag = document.getElementsByTagName('script')[0]; 
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

		var player; 
		function onYouTubePlayerAPIReady() { 
		player = new YT.Player('player', { 
		height: '700', 
		width: '100%', 
		videoId: 'v99ww1pkxDk', 
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
				trackEvent('Play', 'MDT LP', 'Watch Video', 'Play Video');
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

		<!-- end Pardot Website Tracking code -->
	</body>
</html>