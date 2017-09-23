<?php
/**
 * Created by PhpStorm.
 * User: ant
 * Date: 23.09.2017
 * Time: 23:08
 */

namespace Amber\ClientApiBundle\Api;


use Amber\ClientApiBundle\Entity\Authentication;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AmberCheckAuthenticationMethod extends AbstractAmberMethod
{
  /**
   * @var string
   */
  private $contents;

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
    return 'GET';
  }

  /**
   * Returns typed, method-specific result of operation.
   *
   * @return Authentication
   */
  public function getResult()
  {
    return $this->deserialize(
      $this->contents ? $this->contents : $this->contents = $this->getHttpResponse(
      )
        ->getBody()
        ->getContents()
    );
  }

  /**
   * Returns deserialized object.
   *
   * @param $content
   * @return \Amber\ClientApiBundle\Entity\Authentication
   */
  private function deserialize($content): Authentication
  {
    $encoders = [new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];
    $serializer = new Serializer($normalizers, $encoders);

    return $serializer->deserialize(
      $content,
      'Amber\ClientApiBundle\Entity\Authentication',
      'json'
    );
  }

}