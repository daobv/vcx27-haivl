<?php

class RequestController extends Controller {

    /**
     * @return array actions
     */
    public function actions() {
        return array(
            'uploadFile' => array(
                'class' => 'ext.actions.XHEditorUpload',
            ),
        );
    }
}