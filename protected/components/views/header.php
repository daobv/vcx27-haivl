<?php
$header = $this->getHeader();
if (!empty($header)) {
    foreach ($header as $item) {
        echo $item->content_1;
    }
}
?>
