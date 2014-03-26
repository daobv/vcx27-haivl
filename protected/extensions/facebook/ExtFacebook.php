<?php

/**

 * Created by Fruity Solution Co.Ltd.

 * User: Only Love

 * Date: 10/23/13 - 9:10 AM

 * 

 * Please keep copyright headers of source code files when use it.

 * Thank you!

 */



require 'lib/facebook.php';

class ExtFacebook {

    const

        APP_ID = '813229395358714',

        APP_SECRET = '394eca8160ed70e5301cd5bdcd77af2e';

    private $userId;

    private $accessToken;

    private $userProfile;

    /* @var Facebook @facebook */

    private $facebook;



    public function __construct(){

        // Create our Application instance (replace this with your appId and secret).

        $this->facebook = new Facebook(array(

            'appId'  => self::APP_ID,

            'secret' => self::APP_SECRET,

        ));

    }



    public function setAccessToken($accessToken){

        $this->accessToken = $accessToken;

        $this->facebook->setAccessToken($accessToken);

    }



    public function loginFacebook(){

        $this->userId = $this->facebook->getUser();

        if($this->userId == null){

            return false;

        }



        $this->userProfile = $this->facebook->api('/me');

        if($this->userProfile == null){

            return false;

        }



        $user = new Users;

        $user->unsetAttributes();

        $user->user_social_id = $this->userProfile['id'];

        $user->user_email = $this->userProfile['email'];



        $_identity = new UserIdentity($user->user_email, $user->user_social_id);

        $duration = 0; // 3600*24*30 - 30 days

        $count = $user->selectCount($user);

        if($count == 1){

            $_identity->authenticate();

            if($_identity->errorCode===UserIdentity::ERROR_NONE)

                Yii::app()->user->login($_identity,$duration);

            else

                return false;

        }else{

            if($count > 1){

                $user->deleteList();

            }



            // Insert user's social information into database

            $user->user_id = DateTimeUtils::createInstance()->nowStr();

            $user->user_name = $this->userProfile['name'];

            $user->user_first_name = $this->userProfile['first_name'];

            $user->user_last_name = $this->userProfile['last_name'];

            $user->user_social_link = $this->userProfile['link'];

            $user->user_social_username = $this->userProfile['username'];

            $user->user_gender = $this->userProfile['gender'];

            $user->user_timezone = $this->userProfile['timezone'];

            $user->user_locale = $this->userProfile['locale'];

            $user->user_status = ConstantsUtils::USER_STATUS_ACTIVE;

            $user->user_type = ConstantsUtils::USER_TYPE_FACEBOOK;

            $user->user_point = 0;

            $user->created = $user->modified = DateTimeUtils::createInstance()->now();

            if($user->save()){

                $_identity->authenticate();

                if($_identity->errorCode===UserIdentity::ERROR_NONE)

                    Yii::app()->user->login($_identity,$duration);

                else

                    return false;

            }else{

                return false;

            }

        }

        return true;

    }

}