<?php

// BEGIN Page-specific <head> values
$page_title = "Capasso Renovations - Pittsburgh - Contact Us";
$meta_description = "";
$meta_keywords = "";

// Add any local page styles
$page_style_spec = '
.contact {
  text-align: center;
  line-height: 1.7em;
  font-size: 100%;
}

noscript {
  display:block;
  text-align:center;
  color:#f00;
  font-size:15px;
  font-weight:bold;
}


/********* ENTRY FORM AND TABLE *********/
#entryForm {
  position: relative;
  top: 0;
  left: 220px;
  width: 450px;
  border: 2px solid #999999;
  padding: 15px;
  background-color: #DBC89A;
  }
#dataEntryTbl {
  margin: 0 auto;  /* no top/bottom margin + horiz. centered */
  border: 0;
  text-align: center;
  width: 100%;
  }
#dataEntryTbl td {
  padding: 4px 2px;
  }
#dataEntryTbl td.leftCol {
  width: 120px;
  text-align: right;
  font-size: 100%;
  font-weight: bold;
  }
#dataEntryTbl td.spanCol {
  text-align: left;
  padding-left: 20px;
  padding-top: 10px;
  font-size: 100%;
  font-weight: bold;
  }
#dataEntryTbl td.rightCol {
  width: 400px;
  text-align: left;
  font-family: Arial, Helvetica, Sans-Serif;
  }

/********* FORM CONTROLS *********/
#entryForm input, #entryForm textarea {
  font-family: Arial, Helvetica, Sans-Serif;
  font-size: 13px;
  font-weight: normal;
  }
#inpName, #inpPhone, #inpEmail {
  width: 250px;
  }
#taMessage {
  width: 90%;
  height: 168px;
  }
';
// END Page-specific <head> values

// Include common code above main content
// (Do not modify this line)
include("master_topcode.php");
?>

<!-- MAIN CONTENT -->

<h2>Contact us:</h2>

<!-- Abuse avoidance: encode form action attr -->
<script type="text/javascript">
formAction = '/sen'+'dscr'+'ipt.p'+'hp';
</script>
<noscript>
You must enable JavaScript in your web browser to use this form.<br />
Please adjust your settings, or contact us by phone.<br /><br />
</noscript>

<!-- E-MAIL FORM -->
<form name="entryForm" id="entryForm" method="post" action="" onsubmit="javascript:this.action=formAction;">
<table id="dataEntryTbl" border="0">
 <tr>
  <td class="leftCol">Name:</td>
  <td class="rightCol"><input name="inpName" id="inpName" type="text" /></td>
 </tr>
 <tr>
  <td class="leftCol">Phone:</td>
  <td class="rightCol"><input name="inpPhone" id="inpPhone" type="text" /></td>
 </tr>
 <tr>
  <td class="leftCol">E-mail:</td>
  <td class="rightCol"><input name="inpEmail" id="inpEmail" type="text" /></td>
 </tr>
 <tr>
  <td colspan="2" class="spanCol">How may we help you?</td>
 </tr>
 <tr>
  <td colspan="2"><textarea name="taMessage" id="taMessage" rows="" cols=""></textarea></td>
 </tr>
 <tr>
  <td colspan="2">
  <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" />
  </td>
 </tr>
</table>
</form> <!-- /E-MAIL FORM -->

<p class="contact">Phone:&nbsp; <strong>412-353-9784</strong><br />
E-mail:&nbsp; <strong>
<script type="text/javascript" language="JavaScript">
  {WriteEmailLink("info", "capassorenovations", "com");}
</script>
</strong></p>

<!-- end MAIN CONTENT -->

<?php
// Include common code below main content
// (Do not modify this line)
include("master_btmcode.php");
?>