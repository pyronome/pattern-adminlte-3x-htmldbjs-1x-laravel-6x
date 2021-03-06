<!doctype html>
<html lang="en-US" class="no-js">
<head>
	<title>{{$emailFromName}}</title>
	<!-- meta -->
	<meta charset="UTF-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1">
	<!-- Uncomment the meta tags you are going to use! Be relevant and don't spam! -->
	<meta name="keywords" content="" />
	<meta name="description" content="">
</head>
<body style="font-size:15px;text-align:center;background-color:#0D47A1;margin:0px;padding:0px;font-family:'Calibri','Avant Garde','Geneva','Tahoma', 'Verdana';">
	<div style="">
		<div style="background-color:#0D47A1;padding:40px;text-align:center;"></div>
		<div style="font-family:'Calibri','Avant Garde','Geneva','Tahoma', 'Verdana';display:block;float:none;text-align:left;overflow:hidden;background-color:#0D47A1;text-align:left;padding:20px;color:white;">
			<table>
				<tr>
					<td style="padding: 5px;color:white;line-height:normal;font-size:15px;"><strong>Your new password</strong></td>
				</tr>
			</table>
		</div>
		<div style="font-family:'Calibri','Avant Garde','Geneva','Tahoma', 'Verdana';text-align:left;background-color:#fff;min-height:250px;display:block;float:none;font-size:15px;overflow:hidden;line-height:normal;padding:20px;">
			<table>
				<tr>
					<td style="padding: 5px;"><strong>Hello {{$name}},</strong></td>
				</tr>
				<tr>
					<td style="padding: 5px;">Your password has been reset. Please use the following information for your next login:</td>
				</tr>
				<tr>
					<td style="padding: 5px;">Email Address: {{$emailAddress}}</td>
				</tr>
				<tr>
					<td style="padding: 5px;">New Password: {{$newPassword}}</td>
				</tr>
				<tr>
					<td style="padding: 5px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="padding: 5px;">Best Regards,</td>
				</tr>
			</table>
		</div>
		<div style="font-family:'Calibri','Avant Garde','Geneva','Tahoma', 'Verdana';background-color:#0D47A1;padding:20px;text-align: left;font-size: 14px;color:white;">
			<table>
				<tr>
					<td style="padding: 5px;color:white;line-height:normal;"><span style="font-weight: bold;">{{$emailFromName}}</span><br><a style="color:#fff;" href="mailto:{{$emailReplyTo}}">{{$emailReplyTo}}</a></td>
				</tr>
				<tr>
					<td style="padding: 5px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="padding: 5px;color:white;line-height:normal;">This e-mail was sent from {{$emailFromName}} to <a style="color:#fff;" href="mailto:{{$emailAddress}}">{{$emailAddress}}</a>.</td>
				</tr>
			</table>
		</div>
	</div>
</body>