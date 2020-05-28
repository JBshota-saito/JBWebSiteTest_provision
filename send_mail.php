<?php
 
$base_url = 'https://api.sendgrid.com/api/mail.send.json';
 
function assertion($condition, $reason) {
  if (!$condition) die(json_encode(array(
    'message' => 'error',
    'reason' => $reason
  )));
}
 
header('Content-Type: application/json');
 
$content = $_GET['content'] or '';
assertion(!empty($content), 'Content is null.');
 
$payloads = array(
  'api_user' => 'azure_8d7c17769c070674e7f7a53650331d0a@azure.com',
  'api_key' => 'P@ssw0rd',
  'from' => 'elsartshe@yahoo.co.jp',
  'to' => 'elsartshe@yahoo.co.jp',
  'subject' => '‚¨–â‡‚¹ƒ[ƒ‹',
  'text' => $content
);
 
$curl = curl_init($base_url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($payloads));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
$response = curl_exec($curl);
assertion($response !== false, 'Something went wrong.');
 
curl_close($curl);
 
echo $response;
 
?>