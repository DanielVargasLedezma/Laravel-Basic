<?php

namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\User;
use Mail;

class CodeGen extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    public static function sendMail(User $user, $code)
    {
        Mail::to($user->email)->send(new CodeGen($user, $code));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //retorna la vista del correo con todas las variables que recibe desde el controlador de usuario
        return $this->from('laravel.email.articles@gmail.com', env('MAIL_FROM_NAME'))
            ->view('tempmailpass')
            ->subject('Creación de código para reiniciar la contraseña')
            ->with(['getMail' => $this->user->email, 'getName' => $this->user->name, 'getCode' => $this->code]);
    }
}
