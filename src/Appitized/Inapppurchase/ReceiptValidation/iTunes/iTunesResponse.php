<?php
namespace Appitized\Inapppurchase\ReceiptValidation\iTunes;

class iTunesResponse
{

    /**
     * Response Codes
     *
     * @var int
     */
    const RESULT_OK = 0;

    const RESULT_APPSTORE_CANNOT_READ = 21000;

    const RESULT_DATA_MALFORMED = 21002;

    const RESULT_RECEIPT_NOT_AUTHENTICATED = 21003;

    const RESULT_SHARED_SECRET_NOT_MATCH = 21004;

    const RESULT_RECEIPT_SERVER_UNAVAILABLE = 21005;

    const RESULT_RECEIPT_VALID_BUT_SUB_EXPIRED = 21006;
    
    // special case for app review handling - forward any request that is intended for the Sandbox but was sent to Production, this is what the app review team does
    const RESULT_SANDBOX_RECEIPT_SENT_TO_PRODUCTION = 21007;

    const RESULT_PRODUCTION_RECEIPT_SENT_TO_SENDBOX = 21008;

    /**
     * Result Code
     *
     * @var int
     */
    protected $_code;
    
    /**
     * receipt info
     * @var array
     */
    protected $_receipt;

    /**
     * Constructor
     *
     * @param array $jsonResponse            
     * @return Response
     */
    public function __construct($jsonResponse = null)
    {
        if ($jsonResponse !== null) {
            $this->parseJsonResponse($jsonResponse);
        }
    }

    /**
     * Get Result Code
     *
     * @return int
     */
    public function getResultCode()
    {
        return $this->_code;
    }

    /**
     * Set Result Code
     *
     * @param int $code            
     * @return Response
     */
    public function setResultCode($code)
    {
        $this->_code = $code;
        
        return $this;
    }

    public function getError()
    {
        $code = $this->getResultCode();
        $message = $this->getErrorMessage($code);

        return array('error' => $message, 'code' => $code);
    }

    protected function getErrorMessage($code)
    {
        $class = new \ReflectionClass('Appitized\Inapppurchase\ReceiptValidation\iTunes\iTunesResponse');
        $constants = $class->getConstants();
        $constants = array_flip($constants);
        
        return $constants[$code];
    }
    
    /**
     * Get receipt info
     *
     * @return array
     */
    public function getReceipt()
    {
        return $this->_receipt;
    }
    
    /**
     * returns if the receipt is valid or not
     *
     * @return boolean
     */
    public function isValid()
    {
        if ($this->_code == self::RESULT_OK) {
            return true;
        }
        
        return false;
    }

    /**
     * Parse JSON Response
     *
     * @param string $jsonResponse            
     * @return Message
     */
    public function parseJsonResponse($jsonResponse)
    {
        if (!is_array($jsonResponse)) {
            throw new RuntimeException('Response must be a scalar value');
        }
        
        $this->_code = $jsonResponse['status'];
        
        if (array_key_exists('receipt', $jsonResponse)) {
            $this->_receipt = $jsonResponse['receipt'];
        }
        
        return $this;
    }
}