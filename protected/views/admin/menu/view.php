<h1>Menu item&nbsp;:&nbsp;<?php echo $this->model->name;?></h1>
<?php $this->widget('zii.widgets.CDetailView',array(
    'data'=>$this->model,
    'attributes'=>array('name','description')
    ));?>