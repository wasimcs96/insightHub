<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Lang;

class ApiService {

  private $baseURL;
  private $headers;
  private $resource;
  private $params;
  private $request;

  public function __construct($baseURL, $resource = '', $params = []){
    // dd($baseURL);
    $this->resource = $resource;
    $this->params = $params;
    $this->baseURL = $baseURL;
    $this->headers = [
      'Content-Type' => 'application/json',
      'Accept' => 'application/json'
    ];
    $this->request = Http::withHeaders($this->headers);
  }


  public function setHeader($key, $value){

    $this->headers[$key] = $value;

    $this->request = Http::withHeaders($this->headers);

  }

  public function setBasicAuth($username, $password){

    $this->request->withBasicAuth($username, $password);

  }

  public function get(){

    $response = $this->request->get($this->baseURL.$this->resource.$this->generateQueryString($this->params));

    if(!$response->successful()){

      return false;//$this->getErrorMessages($response->json());


    }

    return $response->json();

  }

  public function post(){

    $response = $this->request->post($this->baseURL.$this->resource,$this->params);

    if(!$response->successful()){

      return $this->getErrorMessages($response->json());

    }

    return $response->json();

  }

  public function update(){

  }

  public function put(){

    $response = $this->request->put($this->baseURL.$this->resource,$this->params);

    if(!$response->successful()){

      return $this->getErrorMessages($response->json());

    }

    return $response->json();

  }

  public function delete(){

    $response = $this->request->delete($this->baseURL.$this->resource,$this->params);

    if(!$response->successful()){

      return $this->getErrorMessages($response->json());

    }

    return $response->json();

  }

  private function generateQueryString($data){

    $str = sizeof($data) > 0 ? "?" : "";

    if(sizeof($data) > 0){

      foreach ($data as $key => $value) {

        if(!is_array($value)){

          $str .= "&".$key."=".$value;

        }else{

          foreach ($value as $k => $v) {

            $str .= "&".$key."=".$v;

          }

        }


      }

    }

    return $str;

  }

  private function getErrorMessages($response){

    if(isset($response['errorCode'])){

      $errors = [Lang::get('error_codes.'.$response['errorCode'])];

    }else{

      $errors = [Lang::get('auth.an_error_occurred')];

    }

    throw ValidationException::withMessages($errors);

  }
}
