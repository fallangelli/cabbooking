<? require_once('includes/main.inc.php');
@extract($_GET);
$res_user = db_scalar("select mem_email from coaches_members where mem_id = '$coaches_order_user_id'");
if (is_post_back()) {
    $HEADERS = "MIME-Version: 1.0\r\n";
    $HEADERS .= "Content-type: text/plain; charset=iso-8859-1\r\n";
    $HEADERS .= "From:  <" . ADMIN_EMAIL . ">\n";
    @mail($res_user, $welcome_subject, $welcome_message, $HEADERS);//@mail('sb@localhost.com', $welcome_subject, $welcome_message, $HEADERS);$_SESSION['error_msg'] = "Message Sent Sucessfully!";}?>
    <link href="styles.css" rel="stylesheet" type="text/css"><?php include("top.inc.php"); ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td id="pageHead">
                <div id="txtPageHead">Welcome Message To: <?= $res_user ?></div>
            </td>
        </tr>
    </table>
    <div align="right"><a href="orders_list.php?course_event_id=<?= $course_event_id ?> ">Back to Order List</a>&nbsp;
    </div>
<form name="form1" method="post" enctype="application/x-www-form-urlencoded" <?= validate_form() ?>>
    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
        <div class="errorMsg"><?php if ($_SESSION['error_msg'] != '') {
                echo $_SESSION['error_msg'];
                unset($_SESSION['error_msg']);
            } ?></div>
        <tr>
            <td width="141" class="tdLabel">To:</td>
            <td width="270" class="tdData"><?= $res_user ?></td>
        </tr>
        <tr>
            <td width="141" class="tdLabel">Subject:</td>
            <td width="270" class="tdData"><input name="welcome_subject" type="text" value="<?= $welcome_subject ?>"
                                                  size="50" maxlength="50" alt="blank"
                                                  emsg="Please enter event subject."></td>
        </tr>
        <tr>
            <td width="141" class="tdLabel">Message:</td>
            <td width="270" class="tdData">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" class="tdLabel"><span
                        class="tdData"><?= get_fck_editor("welcome_message", $welcome_message) ?></span></td>
        </tr>
        <tr>
            <td class="tdLabel">&nbsp;</td>
            <td class="tdData"><input type="hidden" name="course_event_id" value="<?= $course_event_id ?>"><input
                        type="hidden" name="course_event_program_id" value="<?= $course_event_program_id ?>">
                <!--following field is Just for navigation purpose--><input type="hidden" name="course_program_id"
                                                                            value="<?= $_REQUEST['course_program_id'] ?>"><input
                        type="image" name="imageField" src="images/buttons/submit.gif"/></td>
        </tr>
    </table></form><?php include("bottom.inc.php"); ?>