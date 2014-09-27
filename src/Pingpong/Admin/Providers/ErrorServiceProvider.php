<?php namespace Pingpong\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Pingpong\Validator\Exceptions\ValidationException;

class ErrorServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booted(function ()
        {
            $this->app->error(function (ValidationException $e)
            {
                return $this->app['redirect']->back()
                    ->withErrors($e->getErrors())
                    ->withError($e->getMessage())
                    ->withInput();
            });
        });
    }

}