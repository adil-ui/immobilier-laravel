<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<!-- If you delete this meta tag, Half Life 3 will never be released.-->
<!-- Template by marcosilva.co.uk, base on Zurb responsive templates and boiler plate, images and copy from http://www.hardgraft.com/ -->

<meta name="viewport" content="width=device-width"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Email </title>
<link rel="stylesheet" href="{{ asset('css/email.css') }}">

</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
    <img editable="true" />
<!------------------------------------ ---- HEADER -------------------------- ------------------------------------->
<table class="head-wrap" bgcolor="#f5f5f5">
<tr>
	<td>
	</td>
	<td class="header container">
		<div class="content">
			<table bgcolor="#f5f5f5" class="">
			<tr>
				<td>
					<img src="logo.jpg"/>
				</td>
				<td align="right">
					<h6 class="collapse">Lifestyle Accessories With A Down To Earth</h6>
				</td>
			</tr>
			</table>
		</div>
	</td>
	<td>
	</td>
</tr>
</table>
<!------------------------------------ ---- BODY -------------------------- ------------------------------------->
<table class="body-wrap">
<tr>
	<td>
	</td>
	<td class="container" bgcolor="#FFFFFF">
		<!-- content -->

		<!-- COLUMN WRAP -->

		<!------------------------------------ ---- BOTTOM BANNER -------------------------- ------------------------------------->
		<div class="content">
			<table>
			<tr>
				<td align="center">
                    <h4>Bonjour Nouveau Message</h4>
                    <div class="mb-4 "><span class="fw-bold" style="color:red">Name:</span> {{ $name }}</div>
                    <div class="mb-4"><span class="fw-bold">Email:</span> {{ $email }}</div>
                    <div class=""><span class="fw-bold">Message:</span> {{ $content }}</div>
				</td>
			</tr>
			</table>
		</div>
		<div class="clear">
		</div>
	</div>
</td>
<td>
</td>
</tr>
</table>
<!-- FOOTER -->
<table class="footer-wrap">
<tr>
<td>
</td>
<td class="container">
	<!-- content -->
	<div class="content">
		<table>
		<tr>
			<td align="center">
				<p>
					<a href="#">Terms</a> | <a href="#">Privacy</a> | <a href="#">Unsubscribe</a>
				</p>
			</td>
		</tr>
		</table>
	</div>
	<!-- /content -->
</td>
<td>
</td>
</tr>
</table>
<!-- /FOOTER -->
</body>
</html>




