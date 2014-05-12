<?php
namespace Appitized\Inapppurchase\ReceiptValidation\GooglePlay;

use ReceiptValidator\RunTimeException;
use Config;

class GooglePlayValidator
{
    protected $client = null;
    protected $play_client = null;

    protected $package_name = null;
    protected $purchase_token = null;
    protected $product_id = null;
    
    public function __construct()
    {
        $this->client = new \Google_Client();
        $this->client->setClientId(Config::get('inapppurchase::googleplay.client_id'));
        $this->client->setClientSecret(Config::get('inapppurchase::googleplay.client_secret'));
        
        try {
            $this->client->setAccessToken(file_get_contents('/tmp/google_access_token.txt'));
        } catch (\Exception $e) {
            echo 'Unable to load existing token - ' . $e->getMessage() . PHP_EOL;
        }
        
        if ($this->client->isAccessTokenExpired()) {
            echo 'Access Token Expired' . PHP_EOL;
            $this->client->refreshToken(Config::get('inapppurchase::googleplay.refresh_token'));
            
            file_put_contents('/tmp/google_access_token.txt', $this->client->getAccessToken());
        }
        
        $this->play_client = new \Google_Service_AndroidPublisher($this->client); 
    }

    public function setPackageName($package_name)
    {
        $this->package_name = $package_name;
        
        return $this;
    }
    
    public function setPurchaseToken($purchase_token)
    {
        $this->purchase_token = $purchase_token;
        
        return $this;
    }

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
        
        return $this;
    }
    
    public function setReceipt($package_name, $purchase_token, $product_id)
    {
        $this->setPackageName($package_name);
        $this->setPurchaseToken($purchase_token);
        $this->setProductId($product_id);

        return $this;
    }

    public function validate()
    {
        $response = null;
        try {
            $response = $this->play_client->inapppurchases->get($this->package_name, $this->product_id, $this->purchase_token);
        } catch (\Exception $e) {
            echo 'Unable to load reciept - ' . $e->getMessage() . PHP_EOL;
        }
        
       return $response;
    }
}