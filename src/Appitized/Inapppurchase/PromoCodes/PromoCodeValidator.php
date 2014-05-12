<?php
namespace Appitized\Inapppurchase\PromoCodes;
use Carbon\Carbon;

class PromoCodeValidator extends \Eloquent {

	public function isValid()
	{
		$now = Carbon::today();
		$expires = new Carbon($this->expires);
		
		return $expires->gte($now);
	}
}