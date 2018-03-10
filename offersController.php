<?php
/*
getHotelController : accepts user's input, and return the result into HTML.
    how this class work  : 
        - get input parameters and prepare string of parameters.
        -  Sent Curl request. 
        - handle Curl respons .
        - return array of result .
*/

class getOffersController {

    // target url without parameters . 
    public $targetUrl = "https://offersvc.expedia.com/offers/v2/getOffers?"
                . "scenario=deal-finder&page=foo&uid=foo&productType=Hotel&"; 

    /*
    get parameters and return offers after filtering .
    */
    public function getHotels(){

        if (isset($_GET) && !empty($_GET)) {

        $validUrl = $this->targetUrl.$this->getParameters(); // create full Url (target Url string + parameters String) 

        $response = $this->getResponse($validUrl); //call function that sent request and return response & save the result in $response .

       return $this->responseHandler($response); // call function that checking the response ,and return array of offers .

        }else{
            return false; 
        }
    }

    /*
    create query parameters that can be passed in request 
    */
    private function getParameters()
    {
        $inputParametersStr = "";

        foreach ($_GET as $key => $input) {

            if(empty($input)){
                continue ; //ignore empty field 
            }
            $inputParametersStr .= "$key=" . urlencode($input) . "&"; // convert string into url syntax.

        }
        $inputParametersStr = trim($inputParametersStr, '&'); // separate parameters by "&" .

        return $inputParametersStr ;
    }

    /*
    sent request and return response . 

    */
    private function getResponse($validUrl){

        $curl = curl_init(); //  Initialize a cURL session

        curl_setopt($curl, CURLOPT_URL, $validUrl); // add url into request . 

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // skip ssl verification.

        curl_setopt($curl, CURLOPT_VERBOSE, 1); // to output verbose information. 

        curl_setopt($curl, CURLOPT_POST, false);
     
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //to return the transfer as a string   
   
        $response = curl_exec($curl); // Execute the cURL session . 

        curl_close($curl); // Close a cURL session.

        return $response ; 
    }

    /*
    Checking the response ,and return array of offers . 
    */
    private function responseHandler($response){

        if ($response === FALSE) { 

            throw new Exception(curl_error($curl), curl_errno($curl)); //Return a string containing error and error number
        } else { // response is True

            $reponseArray = json_decode($response, true); // Decode a $response and save it as array.

             // in case return offers with response .
            if (isset($reponseArray['offers']) && !empty($reponseArray['offers'])) {

                return $reponseArray['offers']['Hotel'];

            } else {
                return false;
            }
        }
        
    }
}

?>