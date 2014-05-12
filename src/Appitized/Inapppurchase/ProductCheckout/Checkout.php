<?php

namespace Appitized\Inapppurchase\ProductCheckout;
use Appitized\Inapppurchase\IapProduct as Product;
use Appitized\Inapppurchase\UserConsumable;
use Appitized\Inapppurchase\UserPurchase;
use Appitized\Inapppurchase\PromoCodes\PromoCode;


class Checkout {

	protected $products = array();
	protected $user;
	protected $consumable;
	protected $purchase;

	public function __construct(\User $user)
	{
		$this->consumable = new UserConsumable;
		$this->purchase = new UserPurchase; 
		$this->user = $user;
	}

	public function addProduct(Product $product, $quantity = null)
	{
		$this->products[] = array(
			'product' => $product, 
			'quantity' => $quantity
		);

		return $this;
	}

	public function usePromoCode($code)
	{
		//find code
		$code = PromoCode::find(1);

		if($code->isValid())
		{
			$this->addProduct($code->product, $code->$quantity);
			return $this;
		}
		else
		{
			return 'error';
		}
	}

	public function savePurchases()
	{
		foreach($this->products as $product)
		{
			$this->saveProduct($product);
		}
	}

	private function saveProduct($product)
	{
		if($product['product']->consumable)
		{
			$this->storeConsumable($product);
		}
		else
		{
			$this->storePurchase($product);
		}
	}

	private function storeConsumable($product)
	{
		$purchase = $this->consumable->firstOrCreate(array(
			'user_id' => $this->user->id,
			'product_key' => $product['product']->product_key,
		));
		$purchase->quantity += $product['quantity'];
		$purchase->save();

		return $purchase;
	}

	private function storePurchase($product)
	{
		$purchase = $this->purchase->firstOrCreate(array(
			'user_id' => $this->user->id,
			'product_key' => $product['product']->product_key
		));

		return $purchase;
	}


	
}