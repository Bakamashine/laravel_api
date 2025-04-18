<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class UserObserver
{
    private function deleteUserCache() {
        Cache::forget("users");
    }
    function created() {
        $this->deleteUserCache();
    }
    
    function deleted() {
        $this->deleteUserCache();
    }
    
    function updated() {
        $this->deleteUserCache();
    }
    
    function restored() {
        $this->deleteUserCache();
    }
}