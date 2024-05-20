<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

use Paystack;

class PaymentController extends Controller
{
    public function redirectToGateway(Request $request)
    {
        $paymentMethod = $request->input('paymentMethod');
        $totalAmount = $request->input('total_amount');
        $userEmail = Auth::user()->email;

        if ($paymentMethod == 'paystack') {
            $reference = Str::random(10);

            $data = [
                "amount" => $totalAmount * 100, // amount in kobo
                "email" => $userEmail, // customer email
                "reference" => $reference, // unique reference
                "currency" => "NGN", // currency
                "orderID" => 23456, // unique order ID
            ];

            try {
                return Paystack::getAuthorizationUrl($data)->redirectNow();
            } catch (\Exception $e) {
                Log::error('Error redirecting to Paystack: ' . $e->getMessage());
                return Redirect::back()->withMessage([
                    'msg' => 'The Paystack token has expired. Please refresh the page and try again.',
                    'type' => 'error'
                ]);
            }
        } elseif ($paymentMethod == 'flutterwave') {
            $reference = Str::random(10);

            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => $totalAmount,
                'email' => $userEmail,
                'tx_ref' => $reference,
                'currency' => "NGN",
                'redirect_url' => route('flutterwave.callback'),
                'customer' => [
                    'email' => $userEmail,
                    "phone_number" => Auth::user()->phone,
                    "name" => Auth::user()->name,
                ],
                "customizations" => [
                    "title" => 'Payment for Order',
                    "description" => "Order payment"
                ]
            ];

            try {
                $payment = Flutterwave::initializePayment($data);

                Log::info('Flutterwave Initialization Response: ', $payment);

                if ($payment['status'] !== 'success') {
                    return Redirect::back()->withMessage([
                        'msg' => 'Failed to initiate Flutterwave payment. Please try again.',
                        'type' => 'error'
                    ]);
                }

                return redirect($payment['data']['link']);
            } catch (\Exception $e) {
                Log::error('Error redirecting to Flutterwave: ' . $e->getMessage());
                return Redirect::back()->withMessage([
                    'msg' => 'Error initiating payment. Please try again.',
                    'type' => 'error'
                ]);
            }
        }
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if ($paymentDetails['status'] === true && isset($paymentDetails['data'])) {

            // dd($paymentDetails);

            $data = $paymentDetails['data'];

            $transaction = Transactions::create([
                'payment_method' => 'paystack',
                'tx_ref' => $data['reference'],
                'amount' => $data['amount'] / 100,
                'currency' => $data['currency'],
                'ip' => $data['ip_address'],
                'amount_settled' => ($data['amount'] -  $data['fees']) / 100,
                'status' => $data['status'],
                'service_charge' => $data['fees'] / 100,
                'charged_amount' => $data['amount'] / 100,
                'payment_type' => $data['channel'],
                'narration' => $data['message'],
                'payment_date' => $data['transaction_date'],
                'user_id' => Auth::id(),
            ]);


            if ($transaction) {
                return Redirect::to('/')->with('message', 'Payment successful');
            } else {
                Log::error('Error creating transaction in the database.');
                return Redirect::route('payment.failed')->withMessage([
                    'msg' => 'Payment successful, but failed to record transaction. Please contact support.',
                    'type' => 'error'
                ]);
            }
        }
    }

    public function handleFlutterwaveCallback(Request $request)
    {
        $status = $request->input('status');
        $txRef = $request->input('tx_ref');
        $transactionId = $request->input('transaction_id');

        Log::info('Flutterwave Callback: ', $request->all());

        if ($status === 'successful') {
            try {
                $data = Flutterwave::verifyTransaction($transactionId);
                Log::info('Flutterwave Verification Response: ', $data);
                if ($data['status'] === 'success') {
                    $paymentDetails = $data['data'];

                    $transaction = Transactions::create([
                        'tx_ref' => $paymentDetails['tx_ref'],
                        'flw_ref' => $paymentDetails['flw_ref'],
                        'service_charge' => $paymentDetails['app_fee'],
                        'amount' => $paymentDetails['amount'],
                        'currency' => $paymentDetails['currency'],
                        'charged_amount' => $paymentDetails['charged_amount'],
                        'ip' => $paymentDetails['ip'],
                        'narration' => $paymentDetails['narration'],
                        'amount_settled' => $paymentDetails['amount_settled'],
                        'status' => $paymentDetails['status'],
                        'payment_type' => $paymentDetails['payment_type'],
                        'payment_method' => "flutterwave",
                        'user_id' => Auth::id(),
                    ]);

                    if ($transaction) {
                        return Redirect::to('/')->with('message', 'Payment successful');
                    } else {
                        Log::error('Error creating transaction in the database.');
                        return Redirect::route('payment.failed')->withMessage([
                            'msg' => 'Payment successful, but failed to record transaction. Please contact support.',
                            'type' => 'error'
                        ]);
                    }



                    // dd($paymentDetails);
                }
            } catch (\Exception $e) {
                Log::error('Error verifying Flutterwave transaction: ' . $e->getMessage());
            }
        } elseif ($status === 'cancelled') {
            Log::info('Flutterwave payment was cancelled.');
            return Redirect::route('payment.failed')->withMessage([
                'msg' => 'Payment was cancelled.',
                'type' => 'error'
            ]);
        } else {
            Log::info('Flutterwave payment failed.');
            return Redirect::route('payment.failed')->withMessage([
                'msg' => 'Payment failed. Please try again.',
                'type' => 'error'
            ]);
        }
    }
}
