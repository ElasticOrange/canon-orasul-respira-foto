<?php
/**
 * Created by IntelliJ IDEA.
 * User: smooth_op
 * Date: 10/30/15
 * Time: 6:07 AM
 * To change this template use File | Settings | File Templates.
 */

function generatePhotoURL ($size, $imageName,$isVote=false){
    $votePrefix="";
    if ($isVote) $votePrefix="votes/";
    switch($size){
        case 'full' :
            return '/images/'. $votePrefix. $imageName .'.jpg';
            break;
        case 'thumb_80' :
            return '/images/'.$votePrefix.'thumb_80_'. $imageName .'.jpg';
            break;
        case 'thumb_180' :
            return '/images/'.$votePrefix.'thumb_180_'. $imageName .'.jpg';
            break;
        case 'thumb_132' :
            return '/images/'.$votePrefix.'thumb_132_'. $imageName .'.jpg';
            break;
    }
}