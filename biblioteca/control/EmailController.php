<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emailController
 *
 * @author PC
 */
class emailController {

    //put your code here
    function __construct($base_site, $email, $nome_user) {
        $this->base_site = $base_site;
        $this->email = $email;
        $this->nome_user = $nome_user;
//        $this->tipo = $tipo;

        $this->mail = new PHPMailer();
        date_default_timezone_set('America/Sao_Paulo');

        $this->data = date("d/m/Y");
        $this->hora = date("H:i");
        $this->ip = getenv("REMOTE_ADDR");

        $this->nome_empresa = $this->base_site->nome_empresa;
        $this->facebook = $this->base_site->facebook;
        $this->site = "www.blueskytosmile.com.br";

        $this->mail->IsSMTP();
        $this->mail->Host = "smtp.blueskytosmile.com.br";
        $this->mail->Port = 587;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "no-replay@blueskytosmile.com.br";
        $this->mail->Password = "bssemail1";
//	$this->mail->From = $this->email;
        $this->mail->From = "no-replay@blueskytosmile.com.br";
        $this->mail->FromName = $nome_user;
    }

    function emailConfirmacao($confirmacao, $modelo) {
        if ($modelo == "default")
            $modelo = "confirmacao.html";

        $this->mail->AddAddress($this->email, $this->nome_user);
        $this->mail->IsHTML(true);

        $this->mail->AddReplyTo($this->email, $this->nome_user);

        $msg = file_get_contents("inc/email/" . $modelo);
        $msg = str_replace("<URL>", URL, $msg);
        $msg = str_replace("<email_login>", $this->email, $msg);
        $msg = str_replace("<cod_confirmacao>", $confirmacao, $msg);
        $msg = str_replace("<site>", $this->site, $msg);
        $msg = str_replace("<link_confirmacao>", URL . "/confirmacao/" . $confirmacao, $msg);
        $this->mail->Subject = "Cadastro no $this->site";
        $this->mail->Body = $msg;

        if ($this->mail->Send())
            return true;
        else
            return false;
    }

    function emailRecuperacao() {
        
    }

}

?>
