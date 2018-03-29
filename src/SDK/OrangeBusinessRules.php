<?php

namespace RethinkGroup\SDK;

use GuzzleHttp\Client;

class OrangeBusinessRules
{
    /**
     * @var string URL that all requests are sent to.
     */
    protected $url = 'https://obr.rethinkgroup.org/api';

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var Http\ClientInterface
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $resources = [];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (isset($config['url'])) $this->url = $config['url'];

        if (isset($config['clientId'])) $this->clientId = $config['clientId'];

        if (isset($config['clientSecret'])) $this->clientSecret = $config['clientSecret'];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return string
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return string
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return string
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * @return Http\ClientInterface
     */
    public function getHttpClient()
    {
        if (!$this->httpClient) {
            return new Client();
        }

        return $this->httpClient;
    }

    /**
     * @param Http\ClientInterface $client
     */
    public function setHttpClient($client)
    {
        $this->httpClient = $client;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $params
     * @return mixed
     */
    public function request($method, $url, $params = array())
    {
        $client = $this->getHttpClient();
        $fullParams = [];

        if (strtolower($method) === 'get')
        {
            $url = $url . '?' . http_build_query($params);
        }
        else
        {
            $fullParams['body'] = json_encode($params);
        }

        $fullParams['headers'] = [
            'Content-Type'  => 'application/json',
            'X-APPLICATION-ID' => $this->getClientId(),
            'Authorization' => 'Bearer ' . $this->getClientSecret()
        ];

        $url = $this->url . "/" . $url;

        $response = $client->request($method, $url, $fullParams)->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * Make a GET HTTP request.
     * @param  string $url
     * @param  array $params
     * @return mixed
     */
    public function get(string $url, array $params = [])
    {
        return $this->request('GET', $url, $params);
    }

    /**
     * Make a POST HTTP request.
     * @param  string $url
     * @param  array $params
     * @return mixed
     */
    public function post(string $url, array $params = [])
    {
        return $this->request('POST', $url, $params);
    }

    /**
     * Make a PATCH HTTP request.
     * @param  string $url
     * @param  array $params
     * @return mixed
     */
    public function patch(string $url, array $params = [])
    {
        return $this->request('PATCH', $url, $params);
    }

    /**
     * Make a PUT HTTP request.
     * @param  string $url
     * @param  array $params
     * @return mixed
     */
    public function put(string $url, array $params = [])
    {
        return $this->request('PUT', $url, $params);
    }

    /**
     * Make a DELETE HTTP request.
     * @param  string $url
     * @return mixed
     */
    public function delete(string $url)
    {
        return $this->request('DELETE', $url);
    }

    /**
     * Returns the requested class name, optionally using a cached array so no
     * object is instantiated more than once during a request.
     *
     * @param string $class
     * @return mixed
     */
    public function getResource($class)
    {
        $class = '\RethinkGroup\SDK\Resources\\' . $class;

        if ( ! array_key_exists($class, $this->resources))
        {
            $this->resources[$class] = new $class($this);
        }

        return $this->resources[$class];
    }

    /**
     * @return \RethinkGroup\SDK\Resource\Address
     */
    public function addresses()
    {
        return $this->getResource('Address');
    }

    /**
     * @return \RethinkGroup\SDK\Resource\Authentication
     */
    public function authentication()
    {
        return $this->getResource('Authentication');
    }

    /**
     * @return \RethinkGroup\SDK\Resource\Organization
     */
    public function organizations()
    {
        return $this->getResource('Organization');
    }

    /**
     * @return \RethinkGroup\SDK\Resource\User
     */
    public function users()
    {
        return $this->getResource('User');
    }

    /**
     * @return \RethinkGroup\SDK\Resource\AccessControl
     */
    public function accessControl()
    {
        return $this->getResource('AccessControl');
    }

     /**
     * @return \RethinkGroup\SDK\Resource\OrganizationsRolesSkusUsers
     */
    public function organizationsRolesSkusUsers()
    {
        return $this->getResource('OrganizationsRolesSkusUsers');
    }
}
