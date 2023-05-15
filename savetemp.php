<?php
session_start();
$name = $tym = $message = $email = $phone  = $project = $source = $pid = "";
$err = [];


// echo '<pre>'; print_r($_REQUEST); die('END');
var_dump($_POST);

// if(!empty($_REQUEST))
// {
//   $post = [
//     'secret' => '6LcXy8QZAAAAAAWw4Ojepbj19aGVgxWJ8Lxgsyev',
//     'response' => $_REQUEST['g-recaptcha-response'],
//   ];
//   $ch = curl_init();

//   curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
//   curl_setopt($ch, CURLOPT_POST, 1);
//   curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//   $server_output = curl_exec($ch);
//   $json = json_decode($server_output);
//   curl_close ($ch);

// }

$name=filter_var($_REQUEST['name'],FILTER_SANITIZE_STRING);
$email=filter_var($_REQUEST['email'],FILTER_SANITIZE_EMAIL);
$mobile=filter_var($_REQUEST['phone'],FILTER_SANITIZE_NUMBER_INT);

$name = htmlspecialchars(strip_tags($name));
$email = htmlspecialchars(strip_tags($email));
$mobile = htmlspecialchars(strip_tags($mobile));
// $tym = $_REQUEST['tym'];
//$campaign=$_REQUEST['campaign'];
$projectId=$_REQUEST['pid'];
// $message=$_REQUEST['message'] . "$nbsp Calling Time:" . $tym ;
// $source=$_REQUEST['Source'];

// $project = array(
//  "560338377402839217"  =>"Palm Spring Tower" ,
// );

  // $project = $projects[$projectId];
$project ="Prospera";

if (isset($_REQUEST['EnquireNowPopUp'])) {
  $PopUp=$_REQUEST['EnquireNowPopUp'];
}
if (isset($_REQUEST['inlineContactForm'])) {
  $PopUp=$_REQUEST['inlineContactForm'];
}

if (isset($_REQUEST['EnquireNowMobilePopUp'])) {
  $PopUp=$_REQUEST['EnquireNowMobilePopUp'];
}



if(isset($_POST['name']) && !empty($_POST['name'])){
  $name = $_POST['name'];
}else{
  $err['name'] = "Name is Required";
}


// var_dump(strlen($_POST['email']) > 30);die();
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  $err['email'] = "Invalid email format";
}else if(isset($_POST['email']) && !empty($_POST['email'])){
  $email = $_POST['email'];
}else{
  $err['email'] = "Email is Required";
}

if (validate_phone_number($_POST['phone']) == true) {
  if(isset($_POST['phone']) && !empty($_POST['phone'])){
    $mobile = $_POST['phone'];
  }else{
    $err['phone'] = "Mobile number is Required";
  }
} else {
  $err['phone'] = "Invalid Mobile number";
}

if(isset($_POST['message']) && !empty($_POST['message'])){
  $message = $_POST['message'];
}else{
  $err['message'] = "Message is Required";
}

if(isset($_POST['pid']) && !empty($_POST['pid'])){
  $pid = $_POST['pid'];
}else{
  $err['pid'] = "Project Name is Required";
}


  // if (isset($_REQUEST['MobileEnquirePopUp'])) {
  //     $PopUp=$_REQUEST['MobileEnquirePopUp'];
  // }

if(isset($_COOKIE['__gtm_campaign_url'])){
  $utm_sourceUrl =$_COOKIE['__gtm_campaign_url'];    
}

  // parse_url() function to parse the URL
  // and return an associative array which
  // contains its various components
$utmUrl=parse_url($utm_sourceUrl);
  // var_dump(parse_url($utmUrl));

  // parse_str() function to parse the
  // string passed via URL
parse_str($utmUrl['query'], $params);
  // echo ' Hi '.$params['utm_campaign'].' your emailID is '.$params['utm_medium'];

$utmSource=$params['utm_source'];
$utmCampaign=$params['utm_campaign'];
$utmMedium=$params['utm_medium'];

if(is_null($utmSource)){
  $utmSource='Organic';
};
if (is_null($utmMedium)) {
  $utmMedium='';
};
if (is_null($utmCampaign)) {
  $utmCampaign='';
};
$siteUrl='https://www.kumarprospera.com';
if(is_null($utm_sourceUrl)){
  $utm_Url=$siteUrl;
}
else{
  $utm_Url=$utm_sourceUrl;
};
  // echo "<pre>";
  // print_r($params['utm_campaign']);
  // echo "<pre>";

// $PopUp='';
$source = "KP_WebSite";
$country = "India";

$honeypot=$_REQUEST['firstname'];

// echo '<pre>'; print_r($_REQUEST); 

if(empty($honeypot && $json->success==1)){
  if((isset($_POST['name']))&&(isset($_POST['phone']))&&(isset($_POST['email'])))
{ //shubham.patni@kumarworld.com, roshan.anand@kumarworld.com, atul.rathod@kumarworld.com, sanjeev.deshpande@megapolis.co.in, kumar.saurabh@megapolis.co.in, pallavi.shendge@megapolis.co.in


  $servername = "localhost";
  $username = "KumarProspera";
  $password = "KumarProspera";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=project-con-form", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  // var_dump($_POST);


  // $sql = "INSERT INTO conform (`name`, `email`, `mobile`, `comment`, `project`,`source`)
  // VALUES ('$name','$email','$mobile','$message','$project', '$source' )";

  $query = "INSERT INTO conform SET name=:name,email=:email,mobile=:mobile,comment=:message,project=:project,source=:source";

  $stmt = $conn->prepare($query);
  $name = htmlspecialchars(strip_tags($name));
  $email = htmlspecialchars(strip_tags($email));
  $mobile = htmlspecialchars(strip_tags($mobile));
  $message = htmlspecialchars(strip_tags($message));
  $project = htmlspecialchars(strip_tags($project));
  $source = "KP_WebSite";

  $stmt->bindParam(":name",$name);
  $stmt->bindParam(":email",$email);
  $stmt->bindParam(":mobile",$mobile);
  // $stmt->bindParam(":tym", $tym);
  $stmt->bindParam(":message", $message);
  $stmt->bindParam(":project", $project);
  $stmt->bindParam(":source", $source);



  $campaign= 'KP_Digital';
  $source= 'KP_WebSite';

  if(isset($_COOKIE['__gtm_campaign_url'])){
    $utm_sourceUrl =$_COOKIE['__gtm_campaign_url'];    
  }

  // parse_url() function to parse the URL
  // and return an associative array which
  // contains its various components
  $utmUrl=parse_url($utm_sourceUrl);
  // var_dump(parse_url($utmUrl));

  // parse_str() function to parse the
  // string passed via URL
  parse_str($utmUrl['query'], $params);
  // echo ' Hi '.$params['utm_campaign'].' your emailID is '.$params['utm_medium'];
  $utmSource=$params['utm_source'];
  $utmCampaign=$params['utm_campaign'];
  $utmMedium=$params['utm_medium'];
  $utmTerm=$params['utm_term'];

  if(is_null($utmSource)){
      $utmSource='Organic';
  };
  if (is_null($utmMedium)) {
      $utmMedium='';
  };
  if (is_null($utmCampaign)) {
      $utmCampaign='';
  };
  // $siteUrl='https://www.kumarprospera.com';
  if(is_null($utm_sourceUrl)){
      $utm_Url=$siteUrl;
  }
  else{
      $utm_Url=$utm_sourceUrl;
  };

  $utm_Term='1BHK(hardcoded)';
  $utm_Content='Any UTM Info';

  // echo "<pre>";
  // print_r($params['utm_campaign']);
  // echo "<pre>";


  if (isset($_REQUEST['EnquireNowPopUp'])) {
      $PopUp=$_REQUEST['EnquireNowPopUp'];
  }


  if (isset($_REQUEST['offer_enquire_modal'])) {
      $PopUp=$_REQUEST['offer_enquire_modal'];
  }

 


  //print sql;
  if($stmt->execute()){
       // ----------------------Qudra Integreation Start-------------
     $post = array (
       'Name'=> $name,
       'Email'=>$email,
       'Phone'=>$mobile,
       'Remarks'=>$PopUp,
       'Project'=>$project,
       'LandingPage'=>$utm_Url,
       'Referral'=>$source,
       'Utm_Source'=>$utmSource,
       'Utm_Medium'=>$utmMedium,
       'Utm_Campaign'=>$utmCampaign,
       'Country'=>$country
     );
     $qString=http_build_query($post);
           // echo "<pre>";
           // print_r($qString);
           // echo "<pre>";
           // var_dump($qString);
           // $RQurl = 'https://quadraleads.in/QleadsKW/EnquiryModule/Common/EnquiryToExternalSource?Name='.$name.'&Email='.$email.'&Phone='.$mobile.'&Remarks='.$PopUp.'&Project='.$proj.'&LandingPage='.$siteUrl.'&Referral='.$source.'&Utm_Source='.$utmSource.'&Utm_Medium='.$utmMedium.'&Utm_Campaign='.$utmCampaign.'&Country='.$country;
     $ch = curl_init();
     // curl_setopt($ch, CURLOPT_URL,"https://quadraleads.in/QleadsKW/EnquiryModule/Common/EnquiryToExternalSource");
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_HEADER,true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER);
     $resp = trim(curl_exec($ch));
           // $resp = curl_exec($ch);
     $json = json_decode($resp);

     if ($e = curl_error($ch)) {
       echo $e;
     }
     else{
       $decoded = json_decode($resp);
               // print_r($resp);
               // echo "<pre>";
               // print_r($decoded);
               // echo "<pre>";
               // var_dump($decoded);
       $encoded = json_encode($decoded,true);
               // var_dump  ($encoded);

               // foreach ($decoded as $key => $value) {
               // echo $key .':'.$value.'<br>';
               //     }
     }
     curl_close ($ch);
       // ----------------------Qudra Integreation End-------------


    // var_dump($err);die();

      // $to = "richard.mudaliar@megapolis.co.in, pooja.bhosale@kumarworld.com, hanmant.sankpal@kumarworld.com, hemraj.wagh@kumarworld.com, ";
    // $to = " hemraj.wagh@kumarworld.com,richard.mudaliar@megapolis.co.in,hanmant.sankpal@kumarworld.com,pooja.bhosale@kumarworld.com";
    $to = " hemraj.wagh@kumarworld.com ";

  // $from = $email; 
  // $name = $_REQUEST['name']; 
    //$phone = $_REQUEST['phone'];
  // $countricode=$_REQUEST['countryCode'];

    // $mobile= $_REQUEST['phone'];// $countricode.$phone;
    // $message = $_REQUEST['message'];
    $subject = "Kumar Properties Enquiry - " .$project; 

    $body  = '<html><body>';
    $body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';    
    $body .= "<tr style='background : #eee;'><td><strong>Name:</strong> </td><td>" .$name. "</td></tr>";
    $body .= "<tr><td><strong>Email :</strong> </td><td>" . $email. "</td></tr>";
    $body .= "<tr><td><strong>Phone :</strong> </td><td>" .  $mobile. "</td></tr>";
    $body .= "<tr><td><strong>Project :</strong> </td><td>"  .$project. "</td></tr>";
    $body .= "<tr><td><strong>Form :</strong> </td><td>"  .$PopUp. "</td></tr>";
    $body .= "<tr><td><strong>Site URL :</strong> </td><td>"  .$siteUrl. "</td></tr>";
    $body .= "<tr><td><strong>UTM Source :</strong> </td><td> ".$utmSource."</td></tr>";
    $body .= "<tr><td><strong>Campaign Medium :</strong> </td><td> ".$utmMedium."</td></tr>";
    $body .= "<tr style='background: #eee;'><td><strong>Campaign Name :</strong> </td><td> ".$utmCampaign."</td></tr>";
    $body .= "</table>";
    $body .= "</body></html>";

    $headers = "From: Kumar-PalmspringTower@kumarpalmspring.com \r\n";
    //$headers .='X-Mailer: PHP/' . phpversion();
    //$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $send = mail($to, $subject, $body, $headers);
  // echo json_encode(array('status' => 'success'));
    header('Location: /KumarPA/thank-you.php');
  }

}
else{
  $_SESSION['errors'] = $err;
  $_SESSION['postval'] = $_POST;
  // header('Location: /index.php');
}
// -----------IssetPost------------ 
}
// ---------honyClose----------   
$email = 'EMAIL_ADDRESS';
$list_id = 'db737affd0';
$api_key = 'd1ce4d09562e5eb3b319dc58f7876511-us19';

$data_center = substr($api_key,strpos($api_key,'-')+1);

$url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members';

$json = json_encode([
  'email_address' => $from,
  'merge_fields' => ['FNAME'=>$name,'PHONE'=> $mobile],
    'status'        => 'subscribed', //pass 'subscribed' or 'pending'
  ]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
$result = curl_exec($ch);
//echo $result ;
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
//echo $status_code;



function validate_phone_number($phone)
{    
 if (strlen($phone) <= 10) {
  return true;
} else {
 return false;
}
}

if(isset($_COOKIE['__gtm_campaign_url'])){
  unset($_COOKIE['__gtm_campaign_url']);    
};

?>