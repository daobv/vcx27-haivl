<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="language" content="en"/>

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css"
              media="screen, projection"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/form.css"/>
 
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style>
            .login {
                background: none repeat scroll 0 0 #E24776;
                margin: 100px auto;
                overflow: hidden;
                padding: 20px;
                width: 300px;
            }
            h1 {
                color: #FFFFFF;
                margin: 0 0 5px;
            }
            label {
                color: #fff;
            }
            .control-group {
                clear: both;
                float: left;
                margin-top: 15px;
            }
            input {
                height: 20px;
                width: 185px;
            }
            input[type=submit] {
                cursor: pointer;
                height: 30px;
                width: 80px;
            }
        </style>
    </head>
    <body>
        <div class="login">
            <?php echo $content; ?>
        </div>
    </body>
</html>