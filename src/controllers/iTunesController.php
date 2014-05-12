<?php

namespace Appitized\Inapppurchase\Controllers;
use Appitized\Inapppurchase\ProductCheckout\Checkout;
use Appitized\Inapppurchase\ReceiptValidation\iTunes\iTunesValidator;
use Input;
use Response;
use User;

class iTunesController extends \BaseController {

	public function __construct(iTunesValidator $validator)
	{
		$this->validator = $validator;
	}

	/**
	* @param string receipt
	* @param integer user
	* @param string product
	* @param integer quantity
	*/
	public function postIndex()
	{
		$receipt = Input::get('receipt');
		$user_id = Input::get('user');
		$product = Input::get('product'); 
		$quantity = Input::get('quantity');

		$response = $this->validator->setReceiptData($receipt)->validate();
	
		if($response->getResultCode() == 0)
		{
			$checkout = new Checkout(User::find($user_id));
			$checkout->addProduct($product, $quantity);
			
			return $checkout->savePurchases();
		}
		else
		{
			return Response::json($response->getError(), 200);			
		}
	}
}