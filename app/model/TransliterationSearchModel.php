<?php

namespace App\Model;


use Nette\Http\Session;
use Nette\Http\SessionSection;

class TransliterationSearchModel
{
    const SECTION_NAME = 'TransliterationSearch';
    const SECTION_EXPIRATION = 0;

    /** @var SessionSection */
    private $section;

    public function __construct(Session $session)
    {
        $this->section = $session->getSection(self::SECTION_NAME);
        $this->section->setExpiration(self::SECTION_EXPIRATION);
    }

    /**
     * @return SessionSection
     */
    public function getTransliterationSearchSection()
    {
        return $this->section;
    }

    public function setSearchTerms($searchTerms)
    {
        $this->section->searchTerms = $searchTerms;
    }

    public function getSearchTerms()
    {
        return $this->section->searchTerms;
    }
}