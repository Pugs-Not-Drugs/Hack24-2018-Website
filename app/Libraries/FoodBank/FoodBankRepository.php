<?php

namespace App\Libraries\Foodbank;

class FoodBankRepository {

    protected $foodBanks = [];

    public function __construct() {
        $this->generateFoodBanks();

        // dd($this->foodBanks);
    }


    public function all() {
        return $this->foodBanks;
    }


    protected function generateFoodBanks() {
        
        $foodBanksUrl = public_path("/api/foodBanks.json");
        $this->foodBanks = json_decode(file_get_contents($foodBanksUrl));
    }

    public function neededItems() {
        $items = [];
        foreach($this->foodBanks as $foodBank) {
            foreach($foodBank->items_needed as $needed_item) {
                if(empty($items[$needed_item])) {
                    $items[$needed_item] = 0;
                }

                $items[$needed_item] += 1;
            }
        }
        asort($items);
        $items = array_reverse($items);
        
        return $items;
    }
}