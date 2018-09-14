<?php

namespace App\Traits;

trait SessionKey
{

    private function retrieveSessKey()
    {
        $sessKey = request()->header('SESS-KEY');
        $sessKey = $sessKey ?: request('sess_key');
        $sessKey = $sessKey ?: request()->cookie('sess_key');
        return $sessKey;
    }

}
