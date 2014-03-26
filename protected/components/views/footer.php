<?php
$footer = $this->getFooter();
if (!empty($footer)) {
    foreach ($footer as $item) {
        echo $item->content_1;
    }
} else {
    ?>
    Liên hệ • Giới thiệu • FAQ • Điều khoản

	© 2014 O2.net.vn - Giấy phép MXH số abcxyz..
    <?php
}
?>
