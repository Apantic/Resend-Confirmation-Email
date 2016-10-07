<?php

class Apantic_ResendConfirmationMail_ControllerAdmin_User extends XFCP_Apantic_ResendConfirmationMail_ControllerAdmin_User
{
    public function actionConfirmResendEmail()
    {
        $userId = $this->_input->filterSingle('user_id', XenForo_Input::UINT);
        $user = $this->_getUserModel()->getUserById($userId);

        $viewParams = array('user' => $user);

        return $this->responseView('Apantic_ResendConfirmationMail_ViewAdmin_ResendConfirmationMail', 'ap_confirm_resend_activation_mail', $viewParams);
    }

    public function actionResendActivationEmail()
    {
        $userId = $this->_input->filterSingle('user_id', XenForo_Input::UINT);

        $userModel = $this->_getUserModel();
        $user = $userModel->getUserById($userId);

        $viewParams = array('user' => $user);

        if ($this->isConfirmedPost())
        {
            $this->_getUserConfirmationModel()->sendEmailConfirmation($user);

            return $this->responseRedirect(
                XenForo_ControllerResponse_Redirect::SUCCESS, '', new XenForo_Phrase('confirmation_email_has_been_resent')
            );
        }
        else
        {
            return $this->responseView('Apantic_ResendConfirmationMail_ViewAdmin_ResendConfirmationMail', 'ap_confirm_resend_activation_mail', $viewParams);
        }
    }

    protected function _getUserConfirmationModel()
    {
        return $this->getModelFromCache('XenForo_Model_UserConfirmation');
    }
}