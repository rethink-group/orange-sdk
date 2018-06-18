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
     * @var string The application ID for the calling application
     */
    protected $clientId;

    /**
     * @var string The application secret for the calling application
     */
    protected $clientSecret;

    /**
     * @var Http\ClientInterface The curl interface for interacting with OBR
     */
    protected $httpClient;

    /**
     * @var array The application resources such as user, organization, etc.
     */
    protected $resources = [];

    /**
     * The constructor for the OrangeBusinessRules object, which requires a
     * url, client id, and client secret to call and authorize against.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (isset($config['url'])) $this->url = $config['url'];

        if (isset($config['clientId'])) $this->clientId = $config['clientId'];

        if (isset($config['clientSecret'])) $this->clientSecret = $config['clientSecret'];
    }

    /**
     * Gets the OBR url that has been set
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url by which to call OBR
     *
     * @param string $url
     * @return RethinkGroup\SDK\OrangeBusinessRules
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Gets the client id that has been set to authenticate with OBR
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Sets the client id to authenticate with OBR
     *
     * @param string $clientId
     * @return RethinkGroup\SDK\OrangeBusinessRules
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Gets the client secret that has been set to authenticate with OBR
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Sets the client secret to authenticate with OBR
     *
     * @param string $clientSecret
     * @return RethinkGroup\SDK\OrangeBusinessRules
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * Gets the HTTP client that will be used to make curl calls to OBR
     * If one is not set, instantiate a new object and return
     *
     * @return Http\ClientInterface
     */
    public function getHttpClient()
    {
        if (!$this->httpClient) {
            $this->setHttpClient(new Client());
        }

        return $this->httpClient;
    }

    /**
     * Sets the HTTP client that will be used to make curl calls to OBR
     *
     * @param Http\ClientInterface $client
     * @return RethinkGroup\SDK\OrangeBusinessRules
     */
    public function setHttpClient($client)
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * Gets all resources
     *
     * @return array An array of all resources
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Set all resources
     *
     * @param array $resources
     * @return RethinkGroup\SDK\OrangeBusinessRules
     */
    public function setResources(array $resources = [])
    {
        $this->resources = $resources;

        return $this;
    }

    /**
     * Make the curl request to OBR
     *
     * @param string $method    The type of call to make
     * @param string $url       The additional path to append to the OBR url
     * @param array  $params    The body or URI parameters to pass with the call
     * @return array            The response from the server
     */
    public function request($method, $url, $params = array())
    {
        $client = $this->getHttpClient();
        $fullParams = [];

        if (strtolower($method) === 'get') {
            $url = $url . '?' . http_build_query($params);
        } else {
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
     * Makes a GET HTTP request
     *
     * @param  string $url
     * @param  array $params
     * @return mixed
     */
    public function get(string $url, array $params = [])
    {
        return $this->request('GET', $url, $params);
    }

    /**
     * Makes a POST HTTP request
     *
     * @param  string $url
     * @param  array $params
     * @return mixed
     */
    public function post(string $url, array $params = [])
    {
        return $this->request('POST', $url, $params);
    }

    /**
     * Makes a PATCH HTTP request
     *
     * @param  string $url
     * @param  array $params
     * @return mixed
     */
    public function patch(string $url, array $params = [])
    {
        return $this->request('PATCH', $url, $params);
    }

    /**
     * Make a PUT HTTP request
     *
     * @param  string $url
     * @param  array $params
     * @return mixed
     */
    public function put(string $url, array $params = [])
    {
        return $this->request('PUT', $url, $params);
    }

    /**
     * Make a DELETE HTTP request
     *
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

        if ( ! array_key_exists($class, $this->resources)) {
            $this->resources[$class] = new $class($this);
        }

        return $this->resources[$class];
    }

    /**
     * Retrieves the addresses resource
     *
     * @return \RethinkGroup\SDK\Resource\Address
     */
    public function addresses()
    {
        return $this->getResource('Address');
    }

    /**
     * Retrieves the authentication resource
     *
     * @return \RethinkGroup\SDK\Resource\Authentication
     */
    public function authentication()
    {
        return $this->getResource('Authentication');
    }

    /**
     * Retrieves the organizations resource
     *
     * @return \RethinkGroup\SDK\Resource\Organization
     */
    public function organizations()
    {
        return $this->getResource('Organization');
    }

    /**
     * Retrieves the users resource
     *
     * @return \RethinkGroup\SDK\Resource\User
     */
    public function users()
    {
        return $this->getResource('User');
    }

    /**
     * Retrieves the accessControl resource
     *
     * @return \RethinkGroup\SDK\Resource\AccessControl
     */
    public function accessControl()
    {
        return $this->getResource('AccessControl');
    }

    /**
     * Retrieves the organizationsRolesSkusUsers resource
     *
     * @return \RethinkGroup\SDK\Resource\OrganizationsRolesSkusUsers
     */
    public function organizationsRolesSkusUsers()
    {
        return $this->getResource('OrganizationsRolesSkusUsers');
    }

    /**
     * Retrieves the skus resource
     *
     * @return \RethinkGroup\SDK\Resource\Sku
     */
    public function skus()
    {
        return $this->getResource('Sku');
    }
}
