<?php

namespace App\service;

class Censurator
{



    public function purify($phrase)
    {
        $gros_mots = ["merde", "putain"];
        $phrase_purifiee = str_replace($gros_mots, "*****", $phrase);
        return $phrase_purifiee;
    }
}