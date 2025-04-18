<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);

        Validator::replacer('required', function ($message, $attribute, $rule, $parameters) {
            return "Поле $attribute обязательно для заполнения.";
        });

        Validator::replacer('numeric', function ($message, $attribute, $rule, $parameters) {
            return "Поле $attribute должно быть числовым значением.";
        });

        Validator::replacer('string', function ($message, $attribute, $rule, $parameters) {
            return "Поле $attribute должно быть строковым значением.";
        });

        Validator::replacer('min', function ($message, $attribute, $rule, $parameters) {
            $minValue = $parameters[0];
            return "Поле $attribute должно быть меньше $minValue.";
        });

        Validator::replacer('image', function ($message, $attribute, $rule, $parameters) {
            return "$attribute должен быть картинкой";
        });


        Validator::replacer('mimetypes', function ($message, $attribute, $rule, $parameters) {
            $str = "$attribute должен иметь расширения: ";
            foreach ($parameters as $value) {
                $str .= $value . " ";
            }
            return $str;
        });
    }
}
