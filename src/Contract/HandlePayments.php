<?php

namespace Shengamo\Billing\Contract;

use Illuminate\Http\RedirectResponse;

interface HandlePayments
{
    public function callback(): RedirectResponse;

    public function addSubscription($response);
}
