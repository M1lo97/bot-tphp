<?php

/// ~ Change these values! ~ ///

//link my discord https://discord.com/api/webhooks/712393159770112109/4BxndstUJlxPQPm58pcR6VHoUJXOsPLKoj0OdgEarmarcV7s-rPSmYCLMC0nMn7yycV9

// credencial api youtube AIzaSyDrlbes2sipP11Af3hBPtSZc_aAa1q9KRk


// YouTube channel ID(s)
// Can be multiple channels - eg: `array("aaaaaaaaaaaaaaaaaaaa", "bbbbbbbbbbbbbbbbbbbb")`
const CHANNELIDS = array("UCmxHABI-UVOMAZtb1eL99Ew");

// Public callback URL
const CALLBACKURL = "https://discord-apptest.herokuapp.com/";

// Secret - must match ytnotify.php; should be reasonably hard to guess
const SECRET = "PWHWTGETOHDG";

///   ///   ///  ///   ///   ///


foreach (CHANNELIDS as $chid) {
    echo "Subscribing to $chid...\n";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pubsubhubbub.appspot.com/subscribe",
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => array(
            'hub.mode' => 'subscribe',
            'hub.topic' => 'https://www.youtube.com/xml/feeds/videos.xml?channel_id=' . $chid,
            'hub.callback' => CALLBACKURL,
            'hub.secret' => SECRET,
            'hub.verify' => 'sync'
        ),
        CURLOPT_RETURNTRANSFER => TRUE
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    echo "$response\n";
}

echo "Done.\n";

?>
