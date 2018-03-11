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

    public function all()
    {
        return $this->recyclingCentres;
    }

    protected function generateObjects()
    {

        $recyclingUrl = public_path("/api/recycling.json");
        $this->recyclingCentres = json_decode(file_get_contents($recyclingUrl));
    }
}
