<?php 

function buildTitle($postfix) {
    return Illuminate\Support\Facades\Config::get('constants.siteTitle') . " -- $postfix";
}