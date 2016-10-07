<?php

class Apantic_ResendConfirmationMail_Listener
{
    public static function load_class_controller($class, array &$extend)
    {
        if($class == 'XenForo_ControllerAdmin_User')
        {
            $extend[''] = 'Apantic_ResendConfirmationMail_ControllerAdmin_User';
        }
    }
}