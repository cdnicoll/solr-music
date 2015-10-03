<?php

namespace cdnicoll\solrMusicBundle\Services;


use Symfony\Component\Config\Definition\Exception\Exception;

class iTunesXMLParserService
{
//    protected $file_name;
//    protected $data;

    public function parseXMLPlst($xmlFile)
    {
        $dom = new \DOMDocument();
        $dom->load( $xmlFile );


        $plist_node = $dom->documentElement;
        $first_dict_node = NULL;

        // First <dict> contains version-info + tracks-node
        foreach ( $plist_node->childNodes as $child ) {
            if ( 'dict' === $child->nodeName ) {
                $first_dict_node = $child;
                break;
            }
        }
        // Fell-through: Parse
        $nodes = $this->parseDict($first_dict_node);
        //$nodes = $this->parseiTunesPlaylists($nodes);

        return $nodes;
    }

    protected function parseDict( $baseNode ) {
        $dicts = array();
        $current_key = NULL;
        $current_value = NULL;
        foreach ( $baseNode->childNodes as $child ) {
            $dict = NULL;
            switch ( $child->nodeName ) {
                case '#text':
                    break;
                case 'key':
                    $current_key = $child->textContent;
                    $current_value = NULL;
                    break;
                case 'array':
                    $current_value = $this->parseDict( $child );
                    break;
                case 'dict':
                    $current_value = (object) $this->parseDict( $child );
                    break;
                case 'true':
                case 'false':
                    $current_value = 'true' === $child->nodeName;
                    break;
                case 'integer':
                    $current_value = (int) $child->textContent;
                    break;
                default:
                    $current_value = $child->textContent;
                    if ( preg_match( '/^(Music Folder|Location)$/', $current_key ) ) {
                        $current_value = urldecode( stripslashes( $current_value ) );
                    }
            }

            if ( NULL !== $current_value ) {
                if ( 'array' === $baseNode->nodeName ) {
                    $dicts[] = $current_value;
                }
                else if ( NULL !== $current_key ) {
                    $dicts[ $current_key ] = $current_value;
                    $current_key = NULL;
                }
                $current_value = NULL;
            }
        }

        return $dicts;
    }

    protected function parseiTunesPlaylists($xmlObj)
    {

        if(!isset($xmlObj['Playlists'])) {
            Throw new Exception('No Playlists to work with');
        }

        $tracks = (array)$xmlObj['Tracks'];
        foreach($xmlObj['Playlists'] as $key=>&$playList) {
            $newItems = [];

            // Check to see we can edit the playlist
            if(!property_exists($playList, 'Playlist Items')) {
                unset($xmlObj['Playlists'][$key]);
                continue;
            }

            foreach ($playList->{'Playlist Items'} as $item) {
                $trackId = $item->{'Track ID'};
                $newItems[] = $tracks[$trackId];
            }

            $playList->{'Playlist Items'} = $newItems;

        }

        return $xmlObj;
    }






}