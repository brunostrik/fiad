<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    define("EMAIL_SEPAE", "sepae.astorga@gmail.com");
    define("EMAIL_COORDENACAO", "bruno.strik@ifpr.edu.br");
    define("NOME_COORDENADOR", "Bruno Henrique Strik");
    define("URL","http://campusastorga.com.br");


function safe($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);   
    return $data;
}
function FormataData($datastring){
    $date = new DateTime($datastring);
    return $date->format('d/m/Y');
}
function LimitText($text, $limit = 30){
    $novo = substr($text, 0, $limit-3);
    if(strlen($text)>strlen($novo)){
        $novo .= "...";
    }
    return $novo;
}
function SimNao($valorBooleano){
    if ($valorBooleano){
        return "Sim";
    }else{
        return "Não";
    }
}

function SendEmailHTML($destinatario, $remetente, $assunto, $mensagem){
    //IMPREMENTAR SENDGRID
    //API KEY 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
    $url = "https://api.sendgrid.com/v3/mail/send";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Authorization: Bearer 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",
    "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = '{"personalizations":[{"to":[{"email":"'.$destinatario->email.'","name":"'.$destinatario->nome.'"}],"subject":"'.$assunto.'"}],"content": [{"type": "text/html", "value": "'.$mensagem.'"}],"from":{"email":"bruno.strik@ifpr.edu.br","name":"Sistema FIAD"},"reply_to":{"email":"'.$remetente->email.'","name":"'.$remetente->nome.'"}}';

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp == "";
}
function SendEmailHTMLDireto($destinatarioEmail, $remetente, $assunto, $mensagem){
    //IMPREMENTAR SENDGRID
    //API KEY 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
    $url = "https://api.sendgrid.com/v3/mail/send";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Authorization: Bearer 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",
    "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = '{"personalizations":[{"to":[{"email":"'.$destinatarioEmail.'"}],"subject":"'.$assunto.'"}],"content": [{"type": "text/html", "value": "'.$mensagem.'"}],"from":{"email":"bruno.strik@ifpr.edu.br","name":"Sistema FIAD"},"reply_to":{"email":"'.$remetente->email.'"}}';

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp == "";
}

function SendEmailRecuperarSenha($destinatarioEmail, $assunto, $mensagem){
    //IMPREMENTAR SENDGRID
    //API KEY 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
    $url = "https://api.sendgrid.com/v3/mail/send";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Authorization: Bearer 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",
    "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = '{"personalizations":[{"to":[{"email":"'.$destinatarioEmail.'"}],"subject":"'.$assunto.'"}],"content": [{"type": "text/html", "value": "'.$mensagem.'"}],"from":{"email":"bruno.strik@ifpr.edu.br","name":"Sistema FIAD"}}';

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp == "";
}