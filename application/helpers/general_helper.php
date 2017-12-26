<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 

//si no existe la función invierte_date_time la creamos
if(!function_exists('esta_logueado'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function esta_logueado()
    {
        $CI =& get_instance();

        if(!$CI->session->userdata('usuario_tesoreria'))
            redirect(base_url()."index.php/login/logout");
            
    }
}

 

if(!function_exists('enviar_email'))
{
    function enviar_email($email_to, $mensaje, $asunto )
    {   
        $CI =& get_instance();
    
        $CI->load->library('email'); // load library 

        $config['mailtype'] = 'html';

        $CI->email->initialize($config);
        
        $CI->email->from('info@lemonclub.com.ar', 'Lemon Club');
        $CI->email->to($email_to);
        //$CI->email->cc("contacto@3ddos.com.ar");
        //$CI->email->cc('another@another-example.com');
        //$CI->email->bcc('them@their-example.com');

        $CI->email->subject($asunto);
        $CI->email->message($mensaje); 

        if ( ! $CI->email->send())
        {
            return false;
        }
        return true;
    }
}

// Mensaje de error de las variables flash session
if(!function_exists('mensaje_resultado'))
{
    function mensaje_resultado($mensaje)
    {
        if ($mensaje): ?>
            <div class="col-md-12" style="padding: 0px;  ">
               

            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            
               <?=$mensaje?>
              </div>


        <? endif;  


    }
}