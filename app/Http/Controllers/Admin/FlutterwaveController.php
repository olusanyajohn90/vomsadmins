<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOwnerRequest;

use function PHPUnit\Framework\callback;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use logger;
use Illuminate\Support\Facades\Log;
use App\Models\Admin\Certificate;

class FlutterwaveController extends Controller
{
    //


      /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize(Request $request)
    {
        //This generates a payment reference
        $reference = Flutterwave::generateReference();






        $id = $request->id;










      # log laravel request into console
    //    $this->logRequest($request);
        // log::info($request);




        // DB::table('')->insert($payp);




        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => 2000,
            'tx_ref' => $reference,
            'currency' => "NGN",
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => "OLUSANYA.JOHN90@GMAIL.COM",
                "phone_number" => "08101178915",
                "name" => "john",
            ],



            "customizations" => [
                "title" => 'Vehicle Certificate',
                "description" => "Pay For Certificate",

            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong

            return;
        }



// dd($payment['data']);
Certificate::where('id',$id )
->update(['payment_status_id' => 2]);
         return redirect($payment['data']['link']);
       // return Redirect()->back();

    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {





        $status = request()->status;
        $datas = request();


        //if payment is successful
        if ($status ==  'successful') {

        $transactionID = Flutterwave::getTransactionIDFromCallback();
        $flum = Flutterwave::verifyTransaction($transactionID);

//  $data = $flum->status;

         $payp = array();

         $payp['amount'] = $flum['data']['amount'];
         $payp['full_name'] = $flum['data']['customer']['name'];
         $payp['email'] = $flum['data']['customer']['email'];
         $payp['phone_number'] = $flum['data']['customer']['phone_number'];
         $payp['transaction_id'] = $flum['data']['tx_ref'];



//   dd($payp);
//   dd($flum['data']['tx_ref']);
        DB::table('payments')->insert($payp);














        }
        elseif ($status ==  'cancelled'){
            //Put desired action/code after transaction has been cancelled here
            return Redirect()->back();
        }
        else{
            //Put desired action/code after transaction has failed here
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here
        return Redirect()->back();

    }

}
