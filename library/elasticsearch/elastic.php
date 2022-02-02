<?php
use Elasticsearch\ClientBuilder;

class Elasticsearch_Elastic
{
    /**
     * Instance of Elasticsearch
     */
    private $client;

    public function __construct()
    {
        $this->client = Elasticsearch\ClientBuilder::create()
            ->setHosts(['http://localhost:9200'])
            ->build();
    }

    public function searchProduct($text)
    {
        $params = [
            'index' => 'products',
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'query' => (string)$text,
                        'fields' => [ "name", "description" ],
                    ]
                ]
            ],
            'client' => [
                'curl' => [
                    CURLOPT_HTTPHEADER => [
                        'Content-type: application/json',
                    ]
                ]
            ]
        ];
        $results = $this->client->search($params);

        if (isset($results["hits"])) {
            if ((int)$results["hits"]["total"]["value"] > 0) {
                return $results["hits"]["hits"];
            } else {
                return null;
            }
        }
    }

    public function postProduct($query, $id)
    {
        $results = $this->post($query, $id, 'products');
        return $results;
    }

    public function deleteProduct($id)
    {
        $params = [
            'index' => 'products',
            'id'    => $id,
            'client' => [
                'curl' => [
                    CURLOPT_HTTPHEADER => [
                        'Content-type: application/json',
                    ]
                ]
            ]
        ];
        $response = $this->client->delete($params);
        return $response;
    }

    private function get($index, $query)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:9200/{$index}/_search?pretty=true",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => json_encode($query),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    private function post($query, $id, $index)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:9200/{$index}/_doc/{$id}?pretty=true",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($query),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    private function delete($id, $index)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:9200/{$index}/_doc/{$id}?pretty=true",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }
}
