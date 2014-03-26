<div class="categories">
    <ul>
        <?php foreach ($categories as $item) { ?>
            <li><?php echo CHtml::link($item->name, array('product/create')); ?></li>
        <?php } ?>
    </ul>
</div>