<?php

namespace App\Libraries\Recycling;

class RecyclingRepository
{

    protected $recyclingCentres = [];

    public function __construct()
    {
        $this->generateObjects();

        // dd($this->recyclingCentres);
    }

    public function all($type = null)
    {   
        if($type) {
            $centres = [];

            foreach ($this->recyclingCentres as $centre) {
                if(isset($centre->{$type}) && $centre->{$type} == "Yes") {
                    $centres[] = $centre;
                }
            }

            return $centres;
        } else {
            return $this->recyclingCentres;
        }
    }

    protected function generateObjects()
    {

        $recyclingUrl = public_path("/api/recycling.json");
        $this->recyclingCentres = json_decode(file_get_contents($recyclingUrl));
    }
}
