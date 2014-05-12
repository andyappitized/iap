<?php

namespace Appitized\Inapppurchase\Controllers;
use Appitized\Inapppurchase\ProductCheckout\Checkout;
use Appitized\Inapppurchase\ReceiptValidation\GooglePlay\GooglePlayValidator;
use Input;
use Response;
use User;


class GooglePlayController extends \BaseController {

	public function __construct(Checkout $checkout, GooglePlayValidator $validator)
	{
		$this->checkout = $checkout;
		$this->validator = $validator;
	}

	/**
	* @param integer user
	* @param string product
	* @param integer quantity
	* @param string product_id
	* @param string package_name
	* @param string purchase_token
	*/
	public function postIndex()
	{
		$user_id = Input::get('user');
		$product = Input::get('product');
		$quantity = Input::get('quantity');
		//Google Receipt data
		$product_id = Input::get('product_id'); //purchase is user_id, product_key and quantity
		$package_name = Input::get('package_name');
		$purchase_token = Input::get('purchase_token');

		$this->validator->setReceipt($package_name, $product_id, $purchase_token);

		if($this->validator->validate())
		{
			$checkout = new Checkout(User::find($user_id));
			$checkout->addProduct($product, $quantity);
			
			return $checkout->savePurchases();
		}
		else
		{
			return Response::json(data, status, headers);
		}
	}
}