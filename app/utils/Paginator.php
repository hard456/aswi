<?php

namespace App\Utils;


use App\Enum\EPageLimit;

class Paginator
{

    private $limit;
    private $page;

    private $pageCount;
    private $itemCount;

    private $startingPage;
    private $endingPage;

    /**
     * Implementation of spring Data Pageable to paginate and sort JPA queries
     * @param $page int query offset
     * @param $limit int query limit
     */
    public function __construct($page, $limit)
    {
        if ($page < 1)
        {
            $page = 1;
        }
        $this->page = $page;

        foreach (EPageLimit::$limits as $l)
        {
            if ($l == $limit)
            {
                $this->limit = $limit;
            }
        }
        if ($this->limit == 0)
        {
            $this->limit = EPageLimit::$defaultLimit;
        }
    }

    /**
     * @return int
     */
    public function getPageNumber()
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->limit;
    }

    public function getOffset()
    {
        return ($this->page - 1) * $this->limit;
    }

    /**
     * @return Paginator
     */
    public function next()
    {
        return $this->hasNext() ? new Paginator($this->getPageNumber() + 1, $this->getPageSize()) : $this;
    }

    /**
     * @return Paginator
     */
    public function previous()
    {
        return $this->hasPrevious() ? new Paginator($this->getPageNumber() - 1, $this->getPageSize()) : $this;
    }

    public function previousOrFirst()
    {
        return $this->hasPrevious() ? $this->previous() : $this->first();
    }

    public function first()
    {
        return new Paginator(1, $this->getPageSize());
    }

    /**
     * @return bool
     */
    public function hasPrevious()
    {
        return $this->getOffset() >= $this->limit;
    }

    /**
     * @return bool
     */
    public function hasNext()
    {
        return $this->getPageNumber() < $this->getPageCount();
    }

    /**
     * @return Paginator
     */
    public function last()
    {
        return new Paginator($this->getPageCount(), $this->getPageSize());
    }

    public function getPageCount()
    {
        return $this->pageCount;
    }

    public function getItemCount()
    {
        return $this->itemCount;
    }

    /**
     * Sets maximum possible page to be displayed and total number of items
     * @param $itemCount int total count
     */
    public function setPageCount($itemCount)
    {
        $this->itemCount = $itemCount;
        $this->pageCount = ceil($itemCount / $this->getPageSize());
        $this->setPagesList();
    }

    /**
     * Sets starting and ending page number to be displayed in template
     */
    private function setPagesList()
    {
        $offset = 2;

        if ($this->getPageNumber() + $offset >= $this->getPageCount())
        {
            $this->startingPage = max(1, $this->getPageCount() - 2 * $offset);
            $this->endingPage = $this->getPageCount();
        } else
        {
            $this->startingPage = max(1, $this->getPageNumber() - $offset);
            $this->endingPage = min($this->startingPage + 2 * $offset, $this->getPageCount());
        }
    }

    public function getStartingPage()
    {
        return $this->startingPage;
    }

    public function getEndingPage()
    {
        return $this->endingPage;
    }
}