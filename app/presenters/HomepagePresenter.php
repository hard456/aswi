<?php

namespace App\Presenters;

use App\Components\IExampleGirdFactory;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    /** @var IExampleGirdFactory  */
    private $exampleGridFactory;

    public function __construct(IExampleGirdFactory $exampleGridFactory)
    {
        parent::__construct();

        $this->exampleGridFactory = $exampleGridFactory;
    }

    public function actionDefault(){

    }

    public function createComponentDataGrid(){
        return $this->exampleGridFactory->create();
    }
}
