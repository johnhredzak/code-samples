<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CACI Messenger - Message has been sent</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="John Hredzak">
<link type="text/css" rel="stylesheet" href="caci_mes.css">

<style type="text/css">
.bodyText {
  width: 500px;
  margin: 30px auto 35px;
  }
.leftAlign {
  text-align: left;
  }
.small {
  font-size: 85%;
  }
button {
  width: 120px;
  }
</style>

</head>
<body>

<!-- BEGIN Main Content -->

<?php
$result = $_GET['result'];
if ($result == 'success')
{ ?>

<div id="topbar">Messenger - Catholic Alumni Clubs International</div>
<div id="heading">Your message has been sent!</div>
<div class="bodyText">
  <p class="leftAlign">Please look for a confirmation message at the e-mail address you have just provided.</p>
  <p>Thank you for taking time to contact CAC.</p>
</div>
<button onClick="javascript:window.close();">Close Window</button>

<?php
}
else
{ ?>

<div id="heading">Sorry - the message could not be sent.</div>
<?php if ($result != 'fail' ) { echo "<p class=\"leftAlign small\">Reason: $result</p>"; } ?>
<div class="bodyText">
  <p>Please click Go Back and try to resend,<br>or contact us at 
  <script type="text/javascript" language="JavaScript">
  t='org';d='caci';r='webmaster';str=r+'@'+d+'.'+t;document.write('<a href="mailto:'+str+'">'+str+'</a>')</script>.</p>
</div>
<button type="button" onClick="javascript:window.history.back();">Go Back</button>
<button onClick="javascript:window.close();">Close Window</button>

<?php
} ?>

<!-- END Main Content -->

</body>
</html>