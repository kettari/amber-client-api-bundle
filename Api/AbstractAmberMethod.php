<?php
/**
 * Created by PhpStorm.
 * User: ant
 * Date: 23.09.2017
 * Time: 22:39
 */

namespace Amber\ClientApiBundle\Api;


use Psr\Http\Message\ResponseInterface;

abstract class AbstractAmberMethod implements AmberMethodInterface
{
  /**
   * @var ResponseInterface
   */
  protected $response;

  /**
   * @var array
   */
  protected $jsonData = [];

  /**
   * @return ResponseInterface
   */
  public function getHttpResponse()
  {
    return $this->response;
  }

  /**
   * @param \Psr\Http\Message\ResponseInterface $response
   * @return \Amber\ClientApiBundle\Api\AbstractAmberMethod
   */
  public function setHttpResponse(ResponseInterface $response)
  {
    $this->response = $response;

    return $this;
  }

  /**
   * Returns array data to be sent in the body of the request as JSON.
   *
   * @return array
   */
  public function getJsonData(): array
  {
    return $this->jsonData;
  }

  /**
   * Sets array data to be sent in the body of the request as JSON.
   *
   * @param array $data
   * @return mixed
   */
  public function setJsonData(array $data)
  {
    $this->jsonData = $data;

    return $this;
  }


  /**
   * Returns query parameters.
   *
   * @return array
   */
  public function getQueryParameters(): array
  {
    return [];
  }

}