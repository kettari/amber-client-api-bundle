<?php
/**
 * Created by PhpStorm.
 * User: ant
 * Date: 23.09.2017
 * Time: 23:08
 */

namespace Amber\ClientApiBundle\Api;


class AmberAuthenticateUserMethod extends AbstractAmberMethod
{
  /**
   * @var string
   */
  private $phone;

  /**
   * @var string
   */
  private $serviceKey;

  /**
   * Returns URI of the method.
   *
   * @return string
   */
  public function getUri(): string
  {
    return '/api/v1/account/authentication';
  }

  /**
   * Returns HTTP method of this endpoint.
   *
   * @return string
   */
  public function getMethod(): string
  {
    return 'POST';
  }

  /**
   * Returns typed, method-specific result of operation.
   *
   * @return mixed
   */
  public function getResult()
  {
    return null;
  }

  /**
   * @return string
   */
  public function getPhone(): string
  {
    return $this->phone;
  }

  /**
   * @param string $phone
   * @return \Amber\ClientApiBundle\Api\AmberAuthenticateUserMethod
   */
  public function setPhone(string $phone): AmberAuthenticateUserMethod
  {
    $this->phone = $phone;

    return $this;
  }

  /**
   * @return string
   */
  public function getServiceKey()
  {
    return $this->serviceKey;
  }

  /**
   * @param string $serviceKey
   * @return \Amber\ClientApiBundle\Api\AmberAuthenticateUserMethod
   */
  public function setServiceKey(string $serviceKey): AmberAuthenticateUserMethod
  {
    $this->serviceKey = $serviceKey;

    return $this;
  }

  /**
   * Returns array data to be sent in the body of the request as JSON.
   *
   * @return array
   */
  public function getJsonData(): array
  {
    return [
      'phone'      => $this->phone,
      'serviceKey' => $this->serviceKey,
    ];
  }


}