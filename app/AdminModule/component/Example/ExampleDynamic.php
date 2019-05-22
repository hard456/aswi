<?php


namespace App\AdminModule\Components;


use App\Utils\Form;
use Nette\Application\UI\Control;
use Nette\Forms\Container;

/**
 * Ukázkový dynamický formulář - SMAZAT PŘI PŘEDÁNÍ!
 *
 * @package App\AdminModule\Components
 */
class ExampleDynamic extends Control
{
    public function render()
    {
        $this->template->setFile(__DIR__ . '/ExampleDynamic.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $form = new Form;

        $min = 1; // Minimální počet kopií které se zobrazí ve formuláři (tj. 1 = minimálně jednou tam budou ty prvky)

        $form->addText('element', 'Další prvky');

        // Definice dynamických prvků
        $multiplier = $form->addMultiplier('books', function (Container $container)
        {
            $container->addText('line', 'Řádka');
            $container->addText('book', 'Knížka');
        }, $min);

        // Definice tlačítek pro přidání / odebrání řádku
        $multiplier->addCreateButton('Add')->addClass('btn btn-primary');
        $multiplier->addRemoveButton('Remove')->addClass('btn btn-danger');

        $form->setDefaults($this->getContainerDefaults());

        $form->addSubmit('submit', 'Odeslat');
        $form->onSuccess[] = [$this, 'formSuccess'];

        return $form;
    }

    public function formSuccess(Form $form)
    {
        \Tracy\Debugger::barDump($form->getValues());
        $this->template->results = $form->getValues();
        $this->redrawControl('results');
    }

    /**
     * Vrací testovací pole s defaultníma hodnotama pro ukázku jak se plní formulář při editaci
     */
    public function getContainerDefaults()
    {
        return [
            'element' => 'Nějaký další prvky',
            'books' =>  // název kontaineru v addMultiplier
                [
                    ['line' => '1.', 'book' => 'kniha 1.'],
                    ['line' => '2.', 'book' => 'kniha 2.'],
                    ['line' => '3.', 'book' => 'kniha 3.']
                ]
        ];
    }

}

interface IExampleDynamicFactory
{
    /**
     * @return ExampleDynamic
     */
    public function create();
}