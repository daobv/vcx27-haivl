<?php
Yii::import('zii.widgets.CPortlet');

class Right extends CPortlet {
    
    public function getTopmem() {
        $criteria = new CDbCriteria;
        $criteria->compare('status', 1);
        $tmp_user = User::model()->findAll($criteria);        
           
        foreach ($tmp_user as $key => $info_user) {

            $tmp_user_meta = $info_user->user_meta;

            $criteria1 = new CDbCriteria;
            $criteria1->compare('status', 1);
            $criteria1->compare('user_id', $info_user->id);
            $tmp_post_total = Post::model()->findAll($criteria1);

            if (isset($tmp_post_total)) {
                $tmp_post_like = 0;
                $tmp_post_dislike = 0;
                $tmp_post_comment = 0;
                $tmp_post_view = 0;
                $tmp_post = 0;
                foreach ($tmp_post_total as $key => $info_post_total) {                    
                    $tmp_post_like      = $tmp_post_like + $info_post_total->post_like;
                    $tmp_post_dislike   = $tmp_post_dislike + $info_post_total->post_dislike;
                    $tmp_post_comment   = $tmp_post_comment + $info_post_total->post_comment;
                    $tmp_post_view      = $tmp_post_view + $info_post_total->post_view;
                    $tmp_post           = $tmp_post + 1;
                }

                if (($tmp_post != $tmp_user_meta->post) || ($tmp_post_like != $tmp_user_meta->post_like) || ($tmp_post_dislike != $tmp_user_meta->post_dislike) || ($tmp_post_comment != $tmp_user_meta->post_comment) || ($tmp_post_view != $tmp_user_meta->post_view)) {

                    $tmp_new = UserMeta::model()->findByPk($tmp_user_meta->id);

                    $tmp_new->post_like = $tmp_post_like;
                    $tmp_new->post_dislike = $tmp_post_dislike;
                    $tmp_new->post_comment = $tmp_post_comment;
                    $tmp_new->post_view = $tmp_post_view;
                    $tmp_new->post = $tmp_post;

                    $tmp_level = UserLevel::model()->findAll();
                    $tmp = 0;

                    for ($i=0; $i < count($tmp_level) - 1; $i++) { 
                        if ($tmp_level[$i+1]->post <= $tmp_post) {
                            $tmp = $i+1;
                        }
                    }

                    for ($i=0; $i < $tmp; $i++) { 

                        if ($tmp_level[$i+1]->post_comment <= $tmp_post_comment) {
                            $tmp = $i+1;
                        }
                    }

                    for ($i=0; $i < $tmp; $i++) { 

                        if ($tmp_level[$i+1]->post_like <= $tmp_post_like) {
                            $tmp = $i+1;
                        }
                    }

                    for ($i=0; $i < $tmp; $i++) { 

                        if ($tmp_level[$i+1]->post_view <= $tmp_post_view) {
                            $tmp = $i+1;
                        }
                    }


                    for ($i=0; $i < $tmp; $i++) { 

                        if ($tmp_level[$i+1]->ref_total <= $tmp_new->ref_total) {
                            $tmp = $i+1;
                        }
                    }

                    for ($i=0; $i < $tmp; $i++) { 
                        if ($tmp_level[$i+1]->op_total <= $tmp_new->op_total) {

                            $tmp_new->level_id = $tmp_level[$i+1]->id;
     
                        }

                    }

                    $tmp_new->save();

                }            
            }
        }

        $tmp_user2 = UserMeta::model()->findAll();

        $tmp_arr = array();

        foreach ($tmp_user2 as $key => $value) {
            $tmp_arr[$key]['id'] = $value->user_id;
            $tmp_arr[$key]['level'] = $value->level_id;
            $tmp_arr[$key]['post_like'] = $value->post_like;
            $tmp_arr[$key]['post'] = $value->post;
        }

        $tmp_arr = $this->orderby($tmp_arr, 'post');
        $tmp_arr = $this->orderby($tmp_arr, 'post_like');
        $tmp_arr = $this->orderby($tmp_arr, 'level');

        return $tmp_arr;
    }

    function orderby($array, $type){
        $temp = null;
        for($i = 0; $i < (count($array) - 1); $i++){
            for($j = ($i+1); $j < count($array); $j++){
                if($array[$j][$type] < $array[$i][$type]){
                    $temp = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $temp;
                }
            }
        }
        return $array;
    }

    public function getFanPage() {
        $criteria = new CDbCriteria;
        $criteria->compare('categoryId', 122);
        return Page::model()->findAll($criteria);
    }

    public function getNews() {
        $criteria = new CDbCriteria;
        $criteria->compare('status', 1);
        $criteria->limit = 5;
        $criteria->order = 'id DESC';
        return Post::model()->findAll($criteria);
    }

    protected function renderContent() {
        $this->render('right');
    }
}
?>
