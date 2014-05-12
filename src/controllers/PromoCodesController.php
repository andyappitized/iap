<?php

namespace Appitized\Inapppurchase;
use Appitized\Inapppurchase\PromoCode;
use View;
use Input;
use Redirect;
use Carbon\Carbon;

class PromoCodesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$codes = PromoCode::paginate(10);

		return View::make('inapppurchase::index')->withCodes($codes);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = IapProduct::all();
		$products = array();
		foreach($data as $product)
		{
			$products[$product->product_key] = $product->product_name;
		}
		return View::make('inapppurchase::add')->withProducts($products);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$code = new PromoCode;
		$code->fill(Input::all());
		$code->save();

		return Redirect::route('promo.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$code = PromoCode::find($id);
		$data = IapProduct::all();
		$products = array();
		foreach($data as $product)
		{
			$products[$product->product_key] = $product->product_name;
		}

		return View::make('inapppurchase::promo-codes.edit')->withCode($code)->withProducts($products);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PromoCode::destroy($id);
		
		return Redirect::route('promo.index');
	}

}