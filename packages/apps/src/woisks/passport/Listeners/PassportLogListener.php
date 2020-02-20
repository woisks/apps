<?php
declare(strict_types=1);

namespace Woisks\Passport\Listeners;

use Woisks\Passport\Events\PassportLogEvent;
use Woisks\Passport\Models\Repository\LogRepository;


/**
 * Class PassportLogListener
 *
 * @package Woisks\PassportRepository\Listeners
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/5/10 11:46
 */
class PassportLogListener
{


    /**
     * handle. 2019/7/26 23:24.
     *
     * @param  \Woisks\Passport\Events\PassportLogEvent  $event
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(PassportLogEvent $event)
    {

        $logRepo = app()->make(LogRepository::class);

        return $logRepo->log($event->type, $event->logID,
            $event->account_uid, $event->account_type, $event->ip,
            $event->system, $event->client, $event->brand_model, $event->device_type);

    }

}
