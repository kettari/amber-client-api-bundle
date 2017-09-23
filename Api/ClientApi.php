<?php

namespace Amber\ClientApiBundle\Api;

use Amber\ClientApiBundle\Exception\ClientApiException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ClientApi
{
  /**
   * @var ClientInterface
   */
  private $client;

  /**
   * @var \Psr\Log\LoggerInterface
   */
  private $logger;

  /**
   * @var string
   */
  private $phone;

  /**
   * @var string
   */
  private $serviceKey;

  /**
   * @var bool
   */
  private $authenticated = false;

  /**
   * ClientApi constructor.
   *
   * @param ClientInterface $client
   */
  public function __construct(ClientInterface $client)
  {
    $this->client = $client;
    $this->logger = new NullLogger();
  }

  /**
   * Executes API method.
   *
   * @param \Amber\ClientApiBundle\Api\AmberMethodInterface $method
   * @throws \Amber\ClientApiBundle\Exception\ClientApiException
   */
  public function execute(AmberMethodInterface $method)
  {
    // Build options
    $options = [];

    // Does endpoint secured?
    if ($method instanceof AmberSecuredEndpointInterface) {
      if (!$this->isAuthenticated()) {
        $this->authenticate();
      }
    }
    // Should we supply JSON data in the body?
    if (count($jsonData = $method->getJsonData())) {
      $options['json'] = $jsonData;
    }
    // Get query parameters
    $options['query'] = $method->getQueryParameters();

    // Does endpoint pageable?
    /*if ($method instanceof PageableTallantoMethodInterface) {
      $options['query']['total_count'] = 'true';
      $options['query']['page_size'] = $method->getPageSize();
      $options['query']['page_number'] = $method->getPageNumber();
    }*/

    $this->logger->debug(
      'Performing Guzzle {method} request to {uri}',
      [
        'method'  => $method->getMethod(),
        'uri'     => $method->getUri(),
        'options' => $options,
        'config'  => $this->client->getConfig(),
      ]
    );

    // Make request
    $response = null;
    try {
      $response = $this->client->request(
        $method->getMethod(),
        $method->getUri(),
        $options
      );
    } catch (RequestException $e) {
      throw new ClientApiException(
        'Guzzle request failed: '.$e->getResponse()
          ->getBody()
          ->getContents(), 0, $e
      );
    } catch (\Exception $e) {
      throw new ClientApiException(
        sprintf(
          'Guzzle request failed with exception %s: %s',
          get_class($e),
          $e->getMessage()
        ), 0, $e
      );
    } finally {
      $this->logger->debug(
        'Guzzle response: {code} {message}',
        [
          'code'    => $response ? $response->getStatusCode() : 'n/a',
          'message' => $response ? $response->getReasonPhrase() : 'n/a',
        ]
      );
    }
    // Assign response
    $method->setHttpResponse($response);
  }

  /**
   * Checks if ClientApi is authenticated
   *
   * @return boolean
   */
  private function isAuthenticated()
  {
    if ($this->authenticated) {
      $this->logger->debug('Already authenticated');

      return true;
    }

    $getAuthMethod = new AmberCheckAuthenticationMethod();
    $this->execute($getAuthMethod);
    $authentication = $getAuthMethod->getResult();

    $this->logger->debug(
      'Result of authentication check: {authentication_check}',
      [
        'authentication_check' => $authentication->isAuthenticated(
        ) ? 'authenticated' : 'not authenticated',
      ]
    );

    return $authentication->isAuthenticated();
  }

  /**
   * Authenticates the client.
   */
  private function authenticate()
  {
    $this->logger->debug('About to authenticate at the Amber');
    $doAuthMethod = new AmberAuthenticateMethod();
    $doAuthMethod->setPhone($this->phone)
      ->setServiceKey($this->serviceKey);
    $this->execute($doAuthMethod);
    $this->authenticated = true;
  }

  /**
   * @param \Psr\Log\LoggerInterface $logger
   *
   * @return \Amber\ClientApiBundle\Api\ClientApi
   */
  public function setLogger(LoggerInterface $logger)
  {
    $this->logger = $logger;

    return $this;
  }

  /**
   * @param string $serviceKey
   * @return \Amber\ClientApiBundle\Api\ClientApi
   */
  public function setServiceKey(string $serviceKey): ClientApi
  {
    $this->serviceKey = $serviceKey;

    return $this;
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
   * @return \Amber\ClientApiBundle\Api\ClientApi
   */
  public function setPhone(string $phone): ClientApi
  {
    $this->phone = $phone;

    return $this;
  }
}