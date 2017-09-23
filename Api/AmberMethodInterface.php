<?php

namespace Amber\ClientApiBundle\Api;


use Psr\Http\Message\ResponseInterface;

interface AmberMethodInterface
{
  /**
   * Returns URI of the method.
   *
   * @return string
   */
  public function getUri(): string;

  /**
   * Returns HTTP method of this endpoint.
   *
   * @return string
   */
  public function getMethod(): string;

  /**
   * Returns query parameters.
   *
   * @return array
   */
  public function getQueryParameters(): array;

  /**
   * Returns array data to be sent in the body of the request as JSON.
   *
   * @return array
   */
  public function getJsonData(): array;

  /**
   * Sets array data to be sent in the body of the request as JSON.
   *
   * @param array $data
   * @return mixed
   */
  public function setJsonData(array $data);

  /**
   * Set raw response.
   *
   * @param \Psr\Http\Message\ResponseInterface $response
   * @return mixed
   */
  public function setHttpResponse(ResponseInterface $response);

  /**
   * Returns raw HTTP response.
   *
   * @return \Psr\Http\Message\ResponseInterface
   */
  public function getHttpResponse();

  /**
   * Returns typed, method-specific result of operation.
   *
   * @return mixed
   */
  public function getResult();
}