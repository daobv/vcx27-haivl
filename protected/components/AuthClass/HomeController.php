<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class HomeController extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'main';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    
    public function actionFetchTree($id = 'admin') {
        $categories = Menu::model()->findAll(array('order' => 'root,lft'));
        $level = 0;
        foreach ($categories as $n => $category) {
            if ($category->level == $level)
                echo CHtml::closeTag('li') . "\n";
            elseif ($category->level > $level)
                echo CHtml::openTag('ul', array('id' => 'navmenu-v')) . "\n";
            else {
                echo CHtml::closeTag('li') . "\n";
                for ($i = $level - $category->level; $i; $i--) {
                    echo CHtml::closeTag('ul') . "\n";
                    echo CHtml::closeTag('li') . "\n";
                }
            }
            echo CHtml::openTag('li', array('id' => 'node_' . $category->id, 'rel' => $category->name));
            if ($id == 'index')
                echo CHtml::openTag('a', array('href' => $this->createUrl('/products', array('id' => $category->id, 'title' => $category->name))));
            else
                echo CHtml::openTag('a', array('href' => '#'));
            echo CHtml::encode($category->name);
            echo CHtml::closeTag('a');
            $level = $category->level;
        }
        for ($i = $level; $i; $i--) {
            echo CHtml::closeTag('li') . "\n";
            echo CHtml::closeTag('ul') . "\n";
        }
    }

    protected function _loadBreadcrumbs($model, $menu_id = '') {
        $o = Menu::model()->findAll(array('select' => 'id,name', 'condition' => 'lft<' . $model->lft . ' AND rgt>' . $model->rgt, 'order' => 'lft'));
        if (!empty($o)) {
            foreach ($o as $value) {
                $b[] = $value->attributes;
            }
            foreach ($b as $value) {
                $this->breadcrumbs[$value['name']] = $this->createUrl('/products', array('id' => $value['id'], 'title' => $value['name']));
            }
        }
        $p = array(
            'Products' => $this->createUrl('products/random'),
        );
        $this->breadcrumbs = $p + $this->breadcrumbs;
        if (!empty($menu_id))
            $this->breadcrumbs[$model->name] = $this->createUrl('/products', array('id' => $menu_id, 'title' => $model->name));
        else
            array_push($this->breadcrumbs, $model->name);
    }

    
}