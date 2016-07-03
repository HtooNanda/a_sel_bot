<?php
// parameters
$hubVerifyToken = 'TOKEN123456abcd';
$accessToken = "EAAPOkx4I7FcBAKwYh17UUQ2ksRPdKx2ES4JhZCF2etLmrvqUn1lDbj4ZBbLqvKweANMiUeq9ZBHwKurk84bo8jTYI22b5Wm0rHzobsyvnXsx0WDi5XHa7R3lTvwkrX4bqRt8bh8yKhy06Em59ZA0RzyIaUcwwaSLmNWUQTkGvgZDZD";
// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
  exit;
}
// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);
$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];
$answer = "Luu Lo Pyaw Kwerrr!";
if($messageText == "hi" || $messageText == "Hi" || $messageText == "HI") {
    $answer = "Hi Par Khin Mya!";
}

if($messageText == "Min Ga Lar Bar") {
    $answer = "မင်ဂါပါ";
}
if($messageText == "Fuck U") {
    $answer = "Go Fuck Yourself :3";
}
if($messageText == "Hyaung") {
    $answer = "Omms Pyaw";
}
if($messageText == "Calculate" || $messageText == "calculate" || $messageText == "calc") {
    $answer = "Dont't you have a calculator? :3";
}
if($messageText == "MPT Loan" || $messageText == "mptloan" || $messageText == "mloan") {
    $answer = "Type *800# and call.The Loan Amount is 800 Kyats.";
}
if($messageText == "Telenor Loan" || $messageText == "telenorloan" || $messageText == "tloan") {
    $answer = "Type *500# and call.The Loan Amount is 700 Kyats.";
}
if($messageText == "Ooredoo Loan" || $messageText == "ooredooloan" || $messageText == "oloan") {
    $answer = "Type *125# and call.The Loan Amount is 800 Kyats.";
}
if($messageText == "-_-") {
    $answer = "Phin Khan Chin Loe lar, Nyay :p";
}
$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);
//based on http://stackoverflow.com/questions/36803518