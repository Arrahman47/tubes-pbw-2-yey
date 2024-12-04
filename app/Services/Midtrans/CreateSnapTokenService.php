<?php
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
 
class CreateSnapTokenService extends Midtrans
{
    protected $order;
 
    public function __construct($order)
    {
        parent::__construct();
 
        $this->order = $order;
    }
 
    public function getSnapToken($id_token,$arr,$user)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $id_token,
                'gross_amount' => 10000,
            ],
            'item_details' => [
            ],
            'customer_details' => [
                'first_name' => $user[0]->username,
                'email' => $user[0]->email,
                'phone' => $user[0]->no_hp,
            ]
        ];
        $test = array();
        $total = 0;
        for($i=0;$i<count($arr);$i+=4){
				$price = $arr[$i+3];
				if ($price == 0){
					$price = 1000000;
				}
                array_push($test,
                [
                    'id' => $id_token,
                    'name' => $arr[$i],
                    'quantity' =>1,
                    'price' => $price,
                ]);
				$total+=$price;
        }
        $params['item_details']=$test;
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}