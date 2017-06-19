<?php

require_once('includes/main.inc.php');

if ($_SESSION['sess_admin_id'] == '') {
    header("location:index.php");
}

$prod_query = db_query("select  * from tbl_product where product_id='$_REQUEST[product_id]'") or die(mysqli_error());

$fetch_record = mysqli_fetch_array($prod_query);

#	echo "<pre>"; print_r($fetch_record);

@extract($fetch_record);

?>

<html>

<head>

    <title>Product Details</title>

    <link href="styles.css" rel="stylesheet" type="text/css">

</head>

<body>

<table border="0" align="center" width="100%" cellpadding="2" cellspacing="0" class="tableSearch">

    <tr bgcolor="#f1f1f1">

        <td valign="top" class="tdLabel" colspan="2"><b><font color="#C05813">Product Details </font></b></td>

    </tr>

    <tr>

        <td valign="top" class="tdLabel" width="30%"><b>Category</b></td>

        <td class="tdLabel"><?= get_cat_name($product_cat_id); ?><?php if ($product_subcat_id != '') {
                echo "->" . get_cat_name($product_subcat_id);
            } ?></td>

    </tr>

    <tr>

        <td valign="top" class="tdLabel" width="30%"><b>Product Code</b></td>

        <td class="tdLabel"><?= stripslashes($product_code) ?></td>

    </tr>

    <tr>

        <td valign="top" class="tdLabel"><b>Product Name</b></td>

        <td class="tdLabel"><?= stripslashes($product_name) ?></td>

    </tr>

    <tr>

        <td valign="top" class="tdLabel" nowrap><b>Product Price</b></td>

        <td class="tdLabel"><?= CURRANCY_SYMBOL . $product_price ?></td>

    </tr>

    <?php

    if ($discount_price != '' && $discount_price != '0.00') {

        ?>

        <tr>

            <td valign="top" class="tdLabel" nowrap><b>Discount Price</b></td>

            <td class="tdLabel"><?= CURRANCY_SYMBOL . $discount_price ?></td>

        </tr>

        <?php

    }

    if ($prod_spec != '') {

        ?>

        <tr>

            <td valign="top" class="tdLabel" nowrap><b>Specifications</b></td>

            <td class="tdLabel"><?= stripslashes($prod_spec) ?></td>

        </tr>

        <?php

    }

    if ($product_series != '') {

        ?>

        <tr>

            <td valign="top" class="tdLabel" nowrap><b>Product Series</b></td>

            <td class="tdLabel"><?= stripslashes($product_series) ?></td>

        </tr>

        <?php

    }


    if ($product_part_type != '') {

        ?>

        <tr>

            <td valign="top" class="tdLabel" nowrap><b>Part Type</b></td>

            <td class="tdLabel"><?= stripslashes($product_part_type) ?></td>

        </tr>

        <?php

    }
    if ($promotion_text != '') {

        ?>

        <tr>

            <td valign="top" class="tdLabel" nowrap><b>Promotion Text</b></td>

            <td class="tdLabel"><?= stripslashes($promotion_text) ?></td>

        </tr>

        <?php

    }


    ?>

    <tr bgcolor="#f1f1f1">

        <td valign="top" class="tdLabel" colspan="2"><b><font color="#C05813">Product Gallery </font></b></td>

    </tr>

    <tr>

        <td valign="top" class="tdLabel" colspan="2">

            <table width="80%" cellspacing="0" cellpadding="0" align="center">

                <?php

                $cnt = 0;

                $product_arr = array($product_image1, $product_image2, $product_image3, $product_image4, $product_image5, $product_image6);


                for ($i = 0; $i < count($product_arr); $i++) {

                    if ($cnt == 0) {

                        ?>

                        <tr>

                    <?php } ?>

                    <td width="50%" align="center">

                        <?php

                        if (strlen($product_arr[$i]) && file_exists(UP_FILES_FS_PATH . "/product_image/" . $product_arr[$i])) {

                            $size = getimagesize(UP_FILES_FS_PATH . "/product_image/" . $product_arr[$i]);

                            $product_image2 = UP_FILES_WS_PATH . "/product_image/" . $product_arr[$i];

                            ?>

                            <img src="<?= $product_image2 ?>" border="0" width="102" height="102"><br>

                            <a href="javascript:;"
                               onClick="window.open('imageview.php?product_id=<?= $product_id; ?>&pos1=product_image<?= $i + 1 ?>','','width=<?= $size[0] + 30; ?>,height=<?= $size[1] + 50; ?>')">View
                                FullImage </a>

                            <?php

                        }

                        ?>

                    </td>

                    <?php

                    $cnt++;

                    if ($cnt == 2) {

                        $cnt = 0;

                        ?>

                        </tr>

                        <tr>

                            <td colspan="2">&nbsp;</td>

                        </tr>

                        <?php

                    }

                }

                if ($cnt == 1) {

                    echo '<td width="50%">&nbsp;</td></tr>';

                }

                ?>

            </table>

        </td>

    </tr>

    <?php


    if (strlen($product_brief_desc)) {

        ?>

        <tr>

            <td valign="top" class="tdLabel"><b>Brief Description</b></td>

            <td class="tdLabel"><?= nl2br(stripslashes($product_brief_desc)) ?></td>

        </tr>

        <?php

    }

    if (strlen($product_full_desc)) {

        ?>

        <tr>

            <td valign="top" class="tdLabel"><b>Full Description</b></td>

            <td class="tdLabel"><?= stripslashes($product_full_desc) ?></td>

        </tr>

        <?php

    }

    ?>

    <tr>

        <td>&nbsp;</td>

        <td align="center">&nbsp;</td>

    </tr>

</table>

<div align="center"><strong><a href="javascript:window.close();">Close Window</a></strong></div>


</body>

</html>

