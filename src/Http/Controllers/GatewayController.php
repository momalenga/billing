<?php

namespace Shengamo\Billing\Controllers;

use App\Models\Team;
use Carbon\Carbon;
use App\Models\User;
use App\Models\TeamSubscription;
use App\Services\FlutterwaveService;
use Shengamo\Billing\Enum\PlanEnum;

class FlutterwaveController extends Controller
{

    public function callback()
    {
        $flutterwave = new FlutterwaveService();
        $status = request()->status;
        if ($status ==  'successful') {
            $transactionID = $flutterwave->getTransactionIDFromCallback();
            $data = $flutterwave->verifyTransaction($transactionID);
            $response = collect($data['data']);

            // Add subscription
            $team = Team::find($response['meta']['team_id']);
            $team->subscribeTo(PlanEnum::find($response['meta']['plan_id']));
            $subscription=$this->addSubscription($response);

//            $order = Order::whereTxRef($response['tx_ref'])->firstOrFail();
//            $order->update(
//                [
//                    'status'=>2,
//                    'team_subscription_id'=>$subscription->id
//                ]
//            );

            if($response['payment_type']=='card') {
                $payment_data = [
                    'card_brand'=>$response['card']['type'],
                    'card_last_four'=>$response['card']['last_4digits'],
                    'card_country'=>$response['card']['country']
                ];
            }else{
                $payment_data = [
                    'network'=>$response['payment_type'],
                    'phone_number'=>$response['customer']['phone_number']
                ];
            }

            auth()->user()->currentTeam->update($payment_data);
            return redirect()->route('dashboard');
        }
        elseif ($status ==  'cancelled') {
            echo ($status);
            //Put desired action/code after transaction has been cancelled here
        }
        else{
            echo ($status);
            //Put desired action/code after transaction has failed here
        }

    }

    public function addSubscription($response)
    {
        $plan = PlanEnum::from($response['meta']['plan']);

        $subscription = TeamSubscription::firstOrCreate(
            [
                'tx_ref'=>$response['tx_ref']
            ],
            [
                'team_id'=> $response['meta']['team_id'],
                'name'=>$plan->value,
                'gateway_id'=>$response['customer']['id'],
                'gateway_name'=>'flutterwave',
                'gateway_status'=>'active',
                'quantity'=>$plan->duration(),
                'tx_ref'=>$response['tx_ref'],
                'app_fee'=>$response['app_fee'],
                'amount'=>$response['charged_amount'],
            ]
        );
        return $subscription;
    }

}
