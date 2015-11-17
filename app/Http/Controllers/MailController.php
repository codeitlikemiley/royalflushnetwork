<?php

namespace App\Http\Controllers;

use App\User;

class MailController extends Controller
{
    /**
     * Show the form to create a new resource.
     *
     * @return Response
     */
    public function send($user, $template, $data)
    {
        \Mail::send($template, $data, function ($message) use ($user, $data) {
            $message->from(env('CONTACT_EMAIL'), env('CONTACT_NAME'));
            $message->subject($data['subject']);
            $message->to($user->email, $user->username);
        });
    }

    /**
     * send the registration email.
     */
    public function registered(User $user)
    {
        $template = ('mail.registered');
        $data = $this->getSignupData($user);
        $this->send($user, $template, $data);
    }

    /**
     * send the activation email.
     */
    public function activated(User $user)
    {
        $template = ('mail.activated');
        $data = $this->getActivationData($user);
        $this->send($user, $template, $data);
    }

    /**
     * send the password reset email.
     */
    public function passwordLink(User $user)
    {
        $template = ('mail.restore');
        $data = $this->getResetData($user);
        $this->send($user, $template, $data);
    }

    /**
     * return the required data for the sign up email.
     *
     * @return array
     */
    public function getSignupData($user)
    {
        $data = array(
            'subject' => 'Activation required',
            'body' => 'Thanks for signing up into our system, please go to the link bellow to activate your account',
            'activation_code' => $user->activation_code,
            'title' => 'Thanks for you registration',
            'email' => $user->email,
        );

        return $data;
    }

    /**
     * return the required data for the activation email.
     *
     * @return array
     */
    public function getActivationData($user)
    {
        $data = array(
            'subject' => 'Account activated',
            'body' => 'Your account has been succsessfully activated.',
            'title' => 'Welcome to Royal Flush Network!',
            'email' => $user->email,
        );

        return $data;
    }

    /**
     * return the required data for the password reset email.
     *
     * @return array
     */
    public function getResetData($user)
    {
        $data = array(
            'subject' => 'Password reset',
            'body' => 'Please click to the link below to change your password',
            'activation_code' => $user->activation_code,
            'title' => 'Password reset',
            'email' => $user->email,
        );

        return $data;
    }

    public function passwordResend(User $user)
    {
        $template = ('mail.resend');
        $data = $this->getResendData($user);
        $this->send($user, $template, $data);
    }

    public function getResendData($user)
    {
        $data = array(
            'subject' => 'Password Activation Resend',
            'body' => 'Please click to the link below to activate your Account',
            'activation_code' => $user->activation_code,
            'title' => 'Password Resend',
            'email' => $user->email,
        );

        return $data;
    }
}
