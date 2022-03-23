<?php
$service_plan_id = "fee24c9402574a0caa5c7251242faa5e";
$bearer_token = "90560a857fd346a19e548826852ee904";

//Any phone number assigned to your API
$send_from = "+447520651795";
//May be several, separate with a comma ,
$recipient_phone_numbers = "+2347045889792"; 
$message = "
Acct:226**938
DT:22/03/2022:2:24:02PM
NIP CR/TITUS ISEK ONYAM/WBP
DR Amt:15,000.00
REF:1986453150
From Zenith Bank
";

//Hello Paul, testing {$recipient_phone_numbers} from {$send_from}

// Check recipient_phone_numbers for multiple numbers and make it an array.
if(stristr($recipient_phone_numbers, ','))
{
  $recipient_phone_numbers = explode(',', $recipient_phone_numbers);
}else{
  $recipient_phone_numbers = [$recipient_phone_numbers];
}

// Set necessary fields to be JSON encoded
$content = [
  'to' => array_values($recipient_phone_numbers),
  'from' => $send_from,
  'body' => $message
];

$data = json_encode($content);

$ch = curl_init("https://us.sms.api.sinch.com/xms/v1/{$service_plan_id}/batches");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $bearer_token);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    echo $result;
}
curl_close($ch);
?>