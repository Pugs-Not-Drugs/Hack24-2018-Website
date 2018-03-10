<?php

namespace App\Libraries\Pollution;

class PollutionService {


    public function get()
    {

        $result = file_get_contents(
            "http://api.waqi.info/feed/@3200/?token=" . env('POLLUTION_KEY')
        );
        
        if (!empty($result)) {
            return json_decode($result)->data;
        }

        return null;
    }

}
