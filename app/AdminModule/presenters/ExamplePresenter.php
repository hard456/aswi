<?php


namespace App\AdminModule\Presenters;


use App\AdminModule\Components\IExampleDynamicFactory;

class ExamplePresenter extends BaseAdminPresenter
{
    /**
     * @var IExampleDynamicFactory
     */
    private $dynamicFactory;

    public function __construct(IExampleDynamicFactory $dynamicFactory)
    {

        $this->dynamicFactory = $dynamicFactory;
    }

    public function createComponentForm()
    {
        return $this->dynamicFactory->create();
    }
}