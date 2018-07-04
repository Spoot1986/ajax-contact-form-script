<?php
$to = 'my_email@site.com';
$from_email = 'robots@site.com';
$from_name = 'Org Name';
$files = '';

function multi_attach_mail($to, $subject, $message, $senderMail, $senderName, $files){

    $from = $senderName." <".$senderMail.">"; 
    $headers = "From: $from";

    $semi_rand = md5(time()); 
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 

    if(count($files) > 0){
        for($i=0;$i<count($files);$i++){
            if(is_file($files[$i])){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($files[$i],"rb");
                $data =  @fread($fp,filesize($files[$i]));
                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" . 
                "Content-Description: ".basename($files[$i])."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }
    }

    $message .= "--{$mime_boundary}--";
    $returnpath = "-f" . $senderMail;

    $mail = @mail($to, $subject, $message, $headers, $returnpath); 

    if($mail){ return TRUE; } else { return FALSE; }
}

if(isset($_POST["hash"]) && $_POST["hash"] == "2DkOqS"){
    
    if(isset($_POST["form_id"]) && $_POST["form_id"] == "1"){
        $name = strip_tags($_POST['name']);
        $phone = strip_tags($_POST['phone']);
        $page = strip_tags($_POST['page']);

        $subject = 'Subject';
        
        $msg = ' 
        <b>Name:</b> '.$name.'<br/>
        <b>Phone:</b> '.$phone.'<br/>
        <b>Page:</b> '.$page.'<br/>
        ';
        
        $send_email = multi_attach_mail($to, $subject, $msg, $from_email, $from_name, $files);
    }

    if(isset($_POST["form_id"]) && $_POST["form_id"] == "2"){
        $name = strip_tags($_POST['name']);
        $phone = strip_tags($_POST['phone']);
        $page = strip_tags($_POST['page']);

        $subject = 'Subject';
        
        $msg = ' 
        <b>Name:</b> '.$name.'<br/>
        <b>Phone:</b> '.$phone.'<br/>
        <b>Page:</b> '.$page.'<br/>
        ';
        
        $send_email = multi_attach_mail($to, $subject, $msg, $from_email, $from_name, $files);
    }
   
}
?>
