<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Smpp\Protocol\SmppAddress;
use App\Smpp\Protocol\SmppClient;
use App\Smpp\Protocol\GsmEncoder;
use App\Smpp\Transport\TSocket;
class SendSms extends Controller
{
    
    function printDebug($str) {
    echo date('Ymd H:i:s ').$str."\r\n";
}
public function sendsms($number,$message){

        try {
    // Construct transport and client, customize settings
    $transport = new TSocket('10.26.142.160',5016,false); // hostname/ip (ie. localhost) and port (ie. 2775)
    $transport->setRecvTimeout(10000);
    $transport->setSendTimeout(10000);
    $smpp = new SmppClient($transport);
    
    // Activate debug of server interaction
    $smpp->debug = true;        // binary hex-output
    $transport->setDebug(true); // also get TSocket debug
    
    // Open the connection
    $transport->open();
    $smpp->bindTransmitter("Test420","tes420");
    
    // Optional: If you get errors during sendSMS, try this. Needed for ie. opensmpp.logica.com based servers.
    //SmppClient::$sms_null_terminate_octetstrings = false;
    
    // Optional: If your provider supports it, you can let them do CSMS (concatenated SMS) 
    //SmppClient::$sms_use_msg_payload_for_csms = true;
    
    // Prepare message
    $encodedMessage = GsmEncoder::utf8_to_gsm0338($message);
    $from = new SmppAddress(GsmEncoder::utf8_to_gsm0338('977420'),2);
    $to = new SmppAddress($number,2,1);
    
    // Send
    $output_msg = $smpp->sendSMS($from,$to,$encodedMessage);

    // Close connection
    $smpp->close();
    return response()->json([$output_msg]);
    
} catch (Exception $e) {
    // Try to unbind
    try {
        $smpp->close();
    } catch (Exception $ue) {
        // if that fails just close the transport
        $this->printDebug("Failed to unbind; '".$ue->getMessage()."' closing transport");
        if ($transport->isOpen()) $transport->close();
    }
    
    // Rethrow exception, now we are unbound or transport is closed
    throw $e; 
}
    }
}
