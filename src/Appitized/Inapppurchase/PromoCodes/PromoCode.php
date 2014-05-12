<?php

namespace Appitized\Inapppurchase\PromoCodes;
use Appitized\Inapppurchase\PromoCodes\PromoCodeValidator;

class PromoCode extends PromoCodeValidator{

	protected $table = "iap_promo_codes";
	protected $fillable = array('product_key','code','quantity','expires');
	public $timestamps = false;

	public function product()
	{
		return $this->belongsTo('IapProduct','product_key');
	}

}