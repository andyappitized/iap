<?php

namespace Appitized\Inapppurchase;

class UserPurchase extends \Eloquent {

	protected $fillable = array('user_id','product_key');
	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function product()
	{
		return $this->belongsTo('IapProduct');
	}

}