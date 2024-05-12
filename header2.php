<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CaixaBank | Always giving you extra</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">
	<link rel="stylesheet"
		href="css/style.css?v=<?php echo time(); ?>">
	<link href="css/responsive.css" rel="stylesheet">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
	<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   =======================================================
    Theme Name: Gp
    Theme URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-templat/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->
	<script type="text/javascript">
		//handle hide button

		function handleShow() {
			const btn = document.getElementById("trans");
			btn.style.display = "block"
		}

		function handleHide() {
			const btn = document.getElementById("trans");
			btn.style.display = "none"
		}

		function blinktext() {
			var f = document.getElementById('announcement');
			setInterval(function() {
				f.style.visibility = (f.style.visibility == 'hidden' ? '' : 'hidden');
			}, 1000);
		}
		/*
The MIT License (MIT)

Copyright (c) 2015 William Hilton

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
		var $form = $('#payment-form');
		$form.find('.subscribe').on('click', payWithStripe);

		/* If you're using Stripe for payments */
		function payWithStripe(e) {
			e.preventDefault();

			/* Abort if invalid form data */
			if (!validator.form()) {
				return;
			}

			/* Visual feedback */
			$form.find('.subscribe').html('Validating <i class="fa fa-spinner fa-pulse"></i>').prop('disabled', true);

			var PublishableKey = 'pk_test_6pRNASCoBOKtIshFeQd4XMUh'; // Replace with your API publishable key
			Stripe.setPublishableKey(PublishableKey);

			/* Create token */
			var expiry = $form.find('[name=cardExpiry]').payment('cardExpiryVal');
			var ccData = {
				number: $form.find('[name=cardNumber]').val().replace(/\s/g, ''),
				cvc: $form.find('[name=cardCVC]').val(),
				exp_month: expiry.month,
				exp_year: expiry.year
			};

			Stripe.card.createToken(ccData, function stripeResponseHandler(status, response) {
				if (response.error) {
					/* Visual feedback */
					$form.find('.subscribe').html('Try again').prop('disabled', false);
					/* Show Stripe errors on the form */
					$form.find('.payment-errors').text(response.error.message);
					$form.find('.payment-errors').closest('.row').show();
				} else {
					/* Visual feedback */
					$form.find('.subscribe').html('Processing <i class="fa fa-spinner fa-pulse"></i>');
					/* Hide Stripe errors on the form */
					$form.find('.payment-errors').closest('.row').hide();
					$form.find('.payment-errors').text("");
					// response contains id and card, which contains additional card details            
					console.log(response.id);
					console.log(response.card);
					var token = response.id;
					// AJAX - you would send 'token' to your server here.
					$.post('/account/stripe_card_token', {
							token: token
						})
						// Assign handlers immediately after making the request,
						.done(function(data, textStatus, jqXHR) {
							$form.find('.subscribe').html('Payment successful <i class="fa fa-check"></i>');
						})
						.fail(function(jqXHR, textStatus, errorThrown) {
							$form.find('.subscribe').html('There was a problem').removeClass('success').addClass(
								'error');
							/* Show Stripe errors on the form */
							$form.find('.payment-errors').text('Try refreshing the page and trying again.');
							$form.find('.payment-errors').closest('.row').show();
						});
				}
			});
		}
		/* Fancy restrictive input formatting via jQuery.payment library*/
		$('input[name=cardNumber]').payment('formatCardNumber');
		$('input[name=cardCVC]').payment('formatCardCVC');
		$('input[name=cardExpiry').payment('formatCardExpiry');

		/* Form validation using Stripe client-side validation helpers */
		jQuery.validator.addMethod("cardNumber", function(value, element) {
			return this.optional(element) || Stripe.card.validateCardNumber(value);
		}, "Please specify a valid credit card number.");

		jQuery.validator.addMethod("cardExpiry", function(value, element) {
			/* Parsing month/year uses jQuery.payment library */
			value = $.payment.cardExpiryVal(value);
			return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
		}, "Invalid expiration date.");

		jQuery.validator.addMethod("cardCVC", function(value, element) {
			return this.optional(element) || Stripe.card.validateCVC(value);
		}, "Invalid CVC.");

		validator = $form.validate({
			rules: {
				cardNumber: {
					required: true,
					cardNumber: true
				},
				cardExpiry: {
					required: true,
					cardExpiry: true
				},
				cardCVC: {
					required: true,
					cardCVC: true
				}
			},
			highlight: function(element) {
				$(element).closest('.form-control').removeClass('success').addClass('error');
			},
			unhighlight: function(element) {
				$(element).closest('.form-control').removeClass('error').addClass('success');
			},
			errorPlacement: function(error, element) {
				$(element).closest('.form-group').append(error);
			}
		});

		paymentFormReady = function() {
			if ($form.find('[name=cardNumber]').hasClass("success") &&
				$form.find('[name=cardExpiry]').hasClass("success") &&
				$form.find('[name=cardCVC]').val().length > 1) {
				return true;
			} else {
				return false;
			}
		}

		$form.find('.subscribe').prop('disabled', true);
		var readyInterval = setInterval(function() {
			if (paymentFormReady()) {
				$form.find('.subscribe').prop('disabled', false);
				clearInterval(readyInterval);
			}
		}, 250);

		//progress bar

		var i = 0;

		function move() {
			if (i == 0) {
				i = 1;
				var elem = document.getElementById("myBar");
				var width = 10;
				var id = setInterval(frame, 10);

				function frame() {
					if (width >= 56) {
						clearInterval(id);
						i = 0;
					} else {
						width++;
						elem.style.width = width + "%";
						elem.innerHTML = width + "%";
					}
				}
			}
		}
	</script>
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API = Tawk_API || {},
			Tawk_LoadStart = new Date();
		(function() {
			var s1 = document.createElement("script"),
				s0 = document.getElementsByTagName("script")[0];
			s1.async = true;
			s1.src = 'https://embed.tawk.to/646363f374285f0ec46bbc9f/1h0i3ssj1';
			s1.charset = 'UTF-8';
			s1.setAttribute('crossorigin', '*');
			s0.parentNode.insertBefore(s1, s0);
		})();
	</script>
	<!--End of Tawk.to Script-->
	<style type="text/css">
		@media (max-width: 768px) {
			.navbar:not(.top-nav-collapse) {
				background: #424f95 !important;
			}
		}

		@media (max-width: 600px) {
			.index-loginbtn {
				display: none;
			}
		}

		@media only screen and (min-width: 600px) {
			.index-btn2 {
				display: none;
			}
		}

		h6 {
			line-height: 1.7;
		}

		#footer-t {
			display: none !important;
		}

		.footer-div {
			padding: 20px 30px;
			border-right: 1px solid white;
		}

		.hm-gradient .full-bg-img {
			background: -moz-linear-gradient(45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%);
			background: -webkit-linear-gradient(45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%);
			background: -webkit-gradient(linear, 45deg, from(rgba(42, 27, 161, 0.6)), to(rgba(29, 210, 177, 0.6)));
			background: -o-linear-gradient(45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%);
			background: linear-gradient(to 45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%);
		}

		@media (max-width: 450px) {
			.margins {
				margin-right: 1rem;
				margin-left: 1rem;
			}
		}

		@media (min-width: 600px) {
			#footer-t {
				display: block !important;
			}
		}

		@media (max-width: 760px) {
			.form-div {
				width: 100%;
			}
		}



		@media (max-width: 740px) {

			.full-height,
			.full-height body,
			.full-height header,
			.full-height header .view {
				height: 1040px;
			}
		}


		input:focus {
			color: green;
		}
	</style>
</head>

<body class="homepage">
	<header id="header">
		<nav class="navbar navbar-fixed-top" role="banner">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="panel.php"><img id="logo" class="img-fluid" src="./images/HSBC_UK.png"
							style="height: 60px;"></a>
				</div>

				<div class="collapse navbar-collapse navbar-right">
					<ul class="nav navbar-nav text-center">
						<?php
                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { //ALL CODE RUNS INSIDE THIS IF A USER IS LOGGED IN
                      echo '
            <li class="#"><a href="panel.php">Dashboard</a></li>
            <li><a href="intrabank.php">Local Transfer</a></li>
            <li><a href="billing-process.php">International Transfer</a></li>
            <li><a href="history.php">Transaction</a></li>
            
            <li><a href="personaldetails.php">Personal Details</a></li>
            <li><a href="signout.php">Sign Out</a></li>
            ';
                  } else {
                      echo '
                             <li><a href="signin.php">Sign In</a></li>
            <li><a href="signup.php">Sign Up</a></li>';
                  }
		?>
					</ul>
				</div>
			</div>
			<!--/.container-->
		</nav>
		<!--/nav-->

	</header>
	<!--/header-->