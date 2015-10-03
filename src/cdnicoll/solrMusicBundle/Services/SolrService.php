<?php

namespace cdnicoll\solrMusicBundle\Services;

/**
 * Class SolrService
 *
 * @author  Cody Nicoll <cdnicoll@gmail.com>
 * @package cdnicoll\solrMusicBundle\Services
 */
class SolrService
{

    /**
     * @var \Solarium\Client $solrClient Solr Client
     */
    protected $solrClient;

    /**
     * Class Constructor
     *
     * @param \Solarium\Client $solrClient Solr Client
     */
    public function __construct($solrClient)
    {
        $this->solrClient = $solrClient;
    }

    // @todo: docblock
    public function insertRow($data)
    {
        // get an update query instance
        $update = $this->solrClient->createUpdate();

        // create a new document for the data
        $doc1 = $update->createDocument();
        //$doc1->foo = $data['foo'];
        //$doc1->foo2 = $data['fing'];
        //var_dump($data['fing']);
        //exit(var_dump(["DEBUG_TRACE::100115174001",error_get_last()]));



        foreach($data as $key=>$value) {
            $doc1->$key = $value;
            print_r($key);
            print_r($value);
        }


        $update->addDocuments(array($doc1));
        $update->addCommit();

        $result = $this->solrClient->update($update);

        // @todo: Catch errors and throw exceptions

        // @todo: Return true if completed
        return true;
    }

    // @todo: docblock
    public function getPaginatedTracks($start, $end)
    {
        $select = [
            'query' => '*:*',
            'start' => $start,
            'rows' => $end,
        ];

        $query = $this->solrClient->createSelect($select);
        $resultSet = $this->solrClient->select($query);

        return $resultSet->getResponse()->getBody();
        //exit(var_dump(["DEBUG_TRACE::100115133921",error_get_last()]));

    }


}