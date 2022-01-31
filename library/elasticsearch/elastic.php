<?php

class Elasticsearch_Elastic
{

    public function searchProduct($text)
    {
        $query = [
            'query' => [
                'multi_match' => [
                    'query' => (string)$text,
                    'fields' => [ "name", "description" ],
                ],
            ],
            "from" => 0,
            'size' => 100,
        ];
        //or URL http://localhost:9200/product/_search?q=name:samolot&pretty
        $results = $this->get('products', $query);

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
        $results = $this->delete($id, 'products');
        return $results;
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
