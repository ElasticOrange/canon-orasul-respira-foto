<?php
/**
 * Created by IntelliJ IDEA.
 * User: smooth_op
 * Date: 10/30/15
 * Time: 6:07 AM
 * To change this template use File | Settings | File Templates.
 */
function generatePhotoURL($size, $imageName, $isVote = false)
{
    $votePrefix = '';
    if ($isVote) {
        $votePrefix = 'votes/';
    }
    switch ($size) {
        case 'full':
            return '/images/'.$votePrefix.$imageName.'.jpg';
            break;
        case 'thumb_80':
            return '/images/'.$votePrefix.'thumb_80_'.$imageName.'.jpg';
            break;
        case 'thumb_180':
            return '/images/'.$votePrefix.'thumb_180_'.$imageName.'.jpg';
            break;
        case 'thumb_132':
            return '/images/'.$votePrefix.'thumb_132_'.$imageName.'.jpg';
            break;
    }
}

function shortenUrl($urlToEncode)
{
    $url = 'https://api-ssl.bitly.com/oauth/access_token';
//open connection
    $ch = curl_init();

//set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Basic YmFyYS5jYXRhbGluQGdtYWlsLmNvbTpwYWlua2lsbGVy',
    ));
//execute post
    $result = curl_exec($ch);
    curl_close($ch);

    if ($result !== false) {
        $token = $result;

        $ch = curl_init();

        // set url
        curl_setopt(
            $ch,
            CURLOPT_URL,
            'https://api-ssl.bitly.com/v3/shorten?access_token='.$token.'&longUrl='.urlencode($urlToEncode)
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        curl_close($ch);

        if ($output !== false) {
            $shortenResponse = json_decode($output, true);

            return $shortenResponse['data']['url'];
        } else {
            return false;
        }
        // close curl resource to free up system resources
    } else {
        return false;
    }
}
