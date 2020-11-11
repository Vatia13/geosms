<?php
/**
 * Created by Vati Child.
 * E-mail: vatia0@gmail.com
 * Date: 4/4/18
 * Time: 12:53 AM
 */

namespace Vati\SMS;

use Illuminate\Support\Facades\Facade;

class SMSFacade extends Facade
{

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sms';
    }
}

