<?php

namespace App\Libraries\Foodbank;

class FoodBankRepository {

    protected $foodBanks = [];

    public function __construct() {
        $this->generateFoodBanks();

        // dd($this->foodBanks);
    }



    protected function generateFoodBanks() {
        
        $foodBanksUrl = public_path("/api/foodBanks.json");
        $this->foodBanks = json_decode(file_get_contents($foodBanksUrl));
    }
}