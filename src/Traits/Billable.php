<?php

namespace Shengamo\Billing\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use App\Models\TeamSubscription;

trait Billable
{

//    public function refund($paymentIntent, array $options = [])
//    {
//        // return StripeRefund::create(
//        //     ['payment_intent' => $paymentIntent] + $options,
//        //     $this->stripeOptions()
//        // );
//    }

//    public function newSubscription(string $subscription, string $plan):
//    {
//        return new SubscriptionBuilder($this, $subscription, $plan);
//    }

    public function onTrial(string $subscription = 'default', string $plan = null): bool
    {
        $subscription = $this->subscription($subscription);

        if (is_null($subscription)) {
            return $this->trial_ends_at && Carbon::parse($this->trial_ends_at)->isFuture();
        }
        return false;
    }

    public function onGenericTrial(): bool
    {
        return $this->trial_ends_at && Carbon::parse($this->trial_ends_at)->isFuture();
    }

    public function subscribed(string $subscription = 'microSME'): bool
    {
        $subscription = $this->subscription($subscription);

        if (is_null($subscription)) {
            return false;
        }

        return true;
    }

    public function subscription(string $subscription = 'microSME'): ?TeamSubscription
    {
        return $this->subscriptions->sortByDesc(
            function ($value) {
                return $value->created_at->getTimestamp();
            }
        )->first(
            function ($value) use ($subscription) {
                return Carbon::parse($value->ends_at)->isFuture();
            }
        );
    }

    public function subscriptionEndDate(): string
    {
        $sub = $this->subscriptions->sortByDesc(
            function ($value) {
                return $value->created_at->getTimestamp();
            }
        )->first(
            function ($value) {
                return ($value->ends_at);
            }
        );
        return Carbon::parse($sub->ends_at)->toFormattedDateString();
    }

    public function subscriptionEndIn(): string
    {
        $sub = $this->subscriptions->sortByDesc(
            function ($value) {
                return $value->created_at->getTimestamp();
            }
        )->first(
            function ($value) {
                return ($value->ends_at);
            }
        );
        return Carbon::parse($sub->ends_at)->diffForHumans();
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(TeamSubscription::class, $this->getForeignKey())->orderBy('created_at', 'desc');
    }

    public function hasIncompletePayment(string $subscription = 'microSME'): bool
    {
        if ($subscription = $this->subscription($subscription)) {
            return $subscription->hasIncompletePayment();
        }

        return false;
    }
}
