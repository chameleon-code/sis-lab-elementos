<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use phpDocumentor\Reflection\Types\This;

class StudentMailController extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $modeMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$modeMail)
    {
        $this->data = $data;
        $this->modeMail = $modeMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->modeMail) {
            case 'register':
                return $this->from('chameleon.code.soft@gmail.com')->subject('Registro Estudiantil')
                ->view('mails.templateCreateStudent')->with('data',$this->data)->with('modeMail',$this->modeMail);
                break;
            case 'edit':
                return $this->from('chameleon.code.soft@gmail.com')->subject('Modificación de Registro Estudiantil')
                ->view('mails.templateCreateStudent')->with('data',$this->data);
                break;
            default:
                break;
        }
        
            
    }
}
