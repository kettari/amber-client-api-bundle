<?php

namespace Amber\ClientApiBundle\Api;


class AmberGetTicketsMethod extends AbstractAmberMethod implements AmberSecuredEndpointInterface
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
    return '/api/v1/tickets';
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
   * @return string
   */
  public function getResult()
  {
    return $this->contents ? $this->contents : $this->contents = $this->getHttpResponse(
    )
      ->getBody()
      ->getContents();
    /*return $this->deserialize(
      $this->contents ? $this->contents : $this->contents = $this->getHttpResponse(
      )
        ->getBody()
        ->getContents()
    );*/
  }

  /**
   * Returns deserialized object.
   *
   * @param $content
   * @return \Amber\ClientApiBundle\Entity\Authentication
   */
  /*private function deserialize($content): Authentication
  {
    $encoders = [new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];
    $serializer = new Serializer($normalizers, $encoders);

    return $serializer->deserialize(
      $content,
      'Amber\ClientApiBundle\Entity\Authentication',
      'json'
    );
  }*/

}