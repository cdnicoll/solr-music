<?php

namespace cdnicoll\solrMusicBundle\Model;

class Track
{
    protected $trackId;
    protected $size;
    protected $totalTime;
    protected $discNumber;
    protected $discCount;
    protected $year;
    protected $dateModified;
    protected $dateAdded;
    protected $bitRate;
    protected $sampleRate;
    protected $playCount;
    protected $playDate;
    protected $playDateUtc;
    protected $releaseDate;
    protected $artworkCount;
    protected $persistentId;
    protected $trackType;
    protected $purchased;
    protected $name;
    protected $artist;
    protected $albumArtist;
    protected $composer;
    protected $album;
    protected $genre;
    protected $kind;
    protected $location;

    /**
     * @return mixed
     */
    public function getTrackId()
    {
        return $this->trackId;
    }

    /**
     * @param mixed $trackId
     */
    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getTotalTime()
    {
        return $this->totalTime;
    }

    /**
     * @param mixed $totalTime
     */
    public function setTotalTime($totalTime)
    {
        $this->totalTime = $totalTime;
    }

    /**
     * @return mixed
     */
    public function getDiscNumber()
    {
        return $this->discNumber;
    }

    /**
     * @param mixed $discNumber
     */
    public function setDiscNumber($discNumber)
    {
        $this->discNumber = $discNumber;
    }

    /**
     * @return mixed
     */
    public function getDiscCount()
    {
        return $this->discCount;
    }

    /**
     * @param mixed $discCount
     */
    public function setDiscCount($discCount)
    {
        $this->discCount = $discCount;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * @param mixed $dateModified
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;
    }

    /**
     * @return mixed
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * @param mixed $dateAdded
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }

    /**
     * @return mixed
     */
    public function getBitRate()
    {
        return $this->bitRate;
    }

    /**
     * @param mixed $bitRate
     */
    public function setBitRate($bitRate)
    {
        $this->bitRate = $bitRate;
    }

    /**
     * @return mixed
     */
    public function getSampleRate()
    {
        return $this->sampleRate;
    }

    /**
     * @param mixed $sampleRate
     */
    public function setSampleRate($sampleRate)
    {
        $this->sampleRate = $sampleRate;
    }

    /**
     * @return mixed
     */
    public function getPlayCount()
    {
        return $this->playCount;
    }

    /**
     * @param mixed $playCount
     */
    public function setPlayCount($playCount)
    {
        $this->playCount = $playCount;
    }

    /**
     * @return mixed
     */
    public function getPlayDate()
    {
        return $this->playDate;
    }

    /**
     * @param mixed $playDate
     */
    public function setPlayDate($playDate)
    {
        $this->playDate = $playDate;
    }

    /**
     * @return mixed
     */
    public function getPlayDateUtc()
    {
        return $this->playDateUtc;
    }

    /**
     * @param mixed $playDateUtc
     */
    public function setPlayDateUtc($playDateUtc)
    {
        $this->playDateUtc = $playDateUtc;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return mixed
     */
    public function getArtworkCount()
    {
        return $this->artworkCount;
    }

    /**
     * @param mixed $artworkCount
     */
    public function setArtworkCount($artworkCount)
    {
        $this->artworkCount = $artworkCount;
    }

    /**
     * @return mixed
     */
    public function getPersistentId()
    {
        return $this->persistentId;
    }

    /**
     * @param mixed $persistentId
     */
    public function setPersistentId($persistentId)
    {
        $this->persistentId = $persistentId;
    }

    /**
     * @return mixed
     */
    public function getTrackType()
    {
        return $this->trackType;
    }

    /**
     * @param mixed $trackType
     */
    public function setTrackType($trackType)
    {
        $this->trackType = $trackType;
    }

    /**
     * @return mixed
     */
    public function getPurchased()
    {
        return $this->purchased;
    }

    /**
     * @param mixed $purchased
     */
    public function setPurchased($purchased)
    {
        $this->purchased = $purchased;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param mixed $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return mixed
     */
    public function getAlbumArtist()
    {
        return $this->albumArtist;
    }

    /**
     * @param mixed $albumArtist
     */
    public function setAlbumArtist($albumArtist)
    {
        $this->albumArtist = $albumArtist;
    }

    /**
     * @return mixed
     */
    public function getComposer()
    {
        return $this->composer;
    }

    /**
     * @param mixed $composer
     */
    public function setComposer($composer)
    {
        $this->composer = $composer;
    }

    /**
     * @return mixed
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @param mixed $album
     */
    public function setAlbum($album)
    {
        $this->album = $album;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param mixed $kind
     */
    public function setKind($kind)
    {
        $this->kind = $kind;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }


}