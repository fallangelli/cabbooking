<?php require_once("includes/main.inc.php");

if ($_SESSION['sess_admin_id'] == '') {

    header("location:index.php");
}

?>


<link href="styles.css" rel="stylesheet" type="text/css">


<?php include("top.inc.php"); ?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">


    <tr>


        <td id="pageHead">
            <div id="txtPageHead">


                Manage Settings
            </div>
        </td>


    </tr>


</table>


<table width="100%" border="0" cellspacing="0" cellpadding="0">


    <tr>


        <td id="content">


            <div class="msg"><?= display_sess_msg() ?></div>


            <br/>


            <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tableList">


                <tr>


                    <th nowrap="nowrap" width="5%">SL</th>

                    <th nowrap="nowrap">Site Name</th>

                    <th nowrap="nowrap">Email</th>


                    <th>&nbsp;</th>


                </tr>


                <?php


                $sql = mysqli_query("select * from tbl_admin");

                $line_raw = mysqli_fetch_array($sql);

                @extract($line_raw);

                $css = ($css == 'trOdd') ? 'trEven' : 'trOdd';


                ?>

                <tr class="<?= $css ?>">


                    <td nowrap="nowrap" align="center"><?= $cnt ?></td>


                    <td nowrap="nowrap" align="center"><?= $admin_site_owner ?></td>


                    <td align="center"><?= $admin_email; ?></td>


                    <td align="center"><a href="edit_config.php?config_id=<?= $config_id ?>"><img
                                    src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0"/></a></td>


                </tr>


            </table>


            <?php include("paging.inc.php"); ?>    </td>


    </tr>


</table>


<?php include("bottom.inc.php"); ?>


