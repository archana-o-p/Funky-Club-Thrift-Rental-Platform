<?php
include('../Assets/connection/connection.php');
session_start(); 

if(isset($_POST['btn_submit']))
{
    $reply = $_POST['txt_reply'];
    $cid   = $_GET['cid'] ?? null;  // safer

    if ($cid) {
        $updQry = "UPDATE tbl_complaint 
                   SET complaint_reply = '$reply', complaint_status = 1 
                   WHERE complaint_id = '$cid'";
        if($con->query($updQry))
        {
            ?>
            <script>
            alert("Reply submitted successfully");
            window.location="Viewcomplaint.php";
            </script>
            <?php
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reply to Complaint</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="300" border="1" cellpadding="10" cellspacing="0">
    <tr>
      <td>Reply</td>
      <td><input type="text" name="txt_reply" id="txt_reply" required /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>
