<?php
declare(strict_types=1);


namespace Woisks\Article\Providers;


use Illuminate\Support\ServiceProvider;


/**
 * Class AppServiceProvider.
 *
 * @package Woisks\Article\Providers
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 18:55
 */
class AppServiceProvider extends ServiceProvider
{


    /**
     * boot. 2019/11/22 18:55.
     *
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }
}
