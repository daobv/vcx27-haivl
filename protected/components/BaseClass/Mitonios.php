<?php
    /**
     * Created by $Mitonios Editor.
     * User: $Mitonios
     * Date: 1/03/13
     * Time: 2:45 PM
     */
    class Mitonios
    {
        public static function danhsachchuyenmuc()
        {
            //Trang chu
            $node       = '<ul>';
            $categories = Category::model()->findAll(array('condition' => 'parentId is NULL', 'order' => 'rank DESC'));
            foreach ($categories as $cat) {
                $node .= '<li>' . CHtml::link($cat->name, '#');
                if (isset($cat->categories)) {
                    $children = $cat->categories;
                    $node .= '<ul>';
                    foreach ($children as $child) {
                        $node .= '<li>' . CHtml::link($child->name, Yii::app()->urlManager->createUrl('/site/list', array('id' => $child->id))) . '</li>';
                    }
                    $node .= '</ul>';
                }
                $node .= '</li>';
            }
            $node .= '</ul>';
            echo $node;
        }
    }
