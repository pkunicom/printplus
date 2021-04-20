<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\EmailTemplateModel;
use App\Models\SupplierModel;
use Config;

class ForgotPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $token;
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // dd(Config("auth.user_mode"));
        $url = url(Config("auth.user_mode").'/reset_password').'/'.$this->token;
        // $url = url('/').'/admin/reset_password/'.$this->token;

         $verification_url = '<a target="_blank" style="border: 1px solid #ff4747; color: #ffffff; display: block; font-size: 18px; letter-spacing: 0.5px; background-color: #ff4747;
              margin: 0 auto; max-width: 200px; padding: 11px 6px; height: initial; text-align: center; text-transform: capitalize; text-decoration: none; width: 100%; border-radius: 5px;" href='.$url.'>Reset Password</a><br/>';

              // dd($verification_url);

        $arr_email_data = [];

        $obj_email_data = EmailTemplateModel::where('id','3')->first();

        if($obj_email_data)
        {
            $arr_email_data = $obj_email_data->toArray();
        }

        $content   = '';
        $content   .= $arr_email_data['template_html'];

        $content   = str_replace('##SUBJECT##', $arr_email_data['template_subject'], $content);
        $content   = str_replace('##USERNAME##', $notifiable->company_name, $content);
        $content   = str_replace('##VERIFICATION_URL##', $verification_url, $content);

        return (new MailMessage)->view('user.email.general', array('content'=>$content))->subject(config('app.project.name').' :Forgot Password');
 }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */



public function toArray($notifiable)
{
    return [
            //
    ];
}
}
