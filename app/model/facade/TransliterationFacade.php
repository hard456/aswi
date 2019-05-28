<?php


namespace App\Model\Facade;


use App\Model\Repository\LineRepository;
use App\Model\Repository\ObjectTypeRepository;
use App\Model\Repository\SurfaceRepository;
use App\Model\Repository\SurfaceTypeRepository;
use Nette\Application\UI\Form;
use Nette\Database\Context;
use Nette\Database\Table\ActiveRow;
use Nette\Utils\ArrayHash;

class TransliterationFacade
{
    /**
     * @var SurfaceRepository
     */
    private $surfaceRepository;
    /**
     * @var LineRepository
     */
    private $lineRepository;
    /**
     * @var ObjectTypeRepository
     */
    private $objectTypeRepository;
    /**
     * @var SurfaceTypeRepository
     */
    private $surfaceTypeRepository;
    /**
     * @var Context
     */
    private $context;

    public function __construct(SurfaceRepository $surfaceRepository,
                                LineRepository $lineRepository,
                                ObjectTypeRepository $objectTypeRepository,
                                SurfaceTypeRepository $surfaceTypeRepository,
                                Context $context
    )
    {
        $this->surfaceRepository = $surfaceRepository;
        $this->lineRepository = $lineRepository;
        $this->objectTypeRepository = $objectTypeRepository;
        $this->surfaceTypeRepository = $surfaceTypeRepository;
        $this->context = $context;
    }

    /**
     * Uloží data transliterace
     *
     * @param int|null $id : ID transliterace
     * @param Form $form
     * @return bool
     */
    public function saveTransliterationData(int $id, Form $form): bool
    {
        $formValues = $form->getValues();

        $this->removeDeletedLines($id, $formValues);

        // Škaredý zanoření hodnot z formuláře v kontainerech :(
        foreach ($formValues as $objectTypeId => $surfaceContainers)
        {
            foreach ($surfaceContainers as $surfaceTypeId => $inputs)
            {
                foreach ($inputs as $key => $values)
                {
                    try
                    {
                        $lineId = (int)$values->{LineRepository::COLUMN_ID};

                        // Editace již existující řádky
                        if (!empty($lineId))
                        {
                            $this->lineRepository->fetchById($lineId)->update($values);

                        } else
                        {
                            $surface = $this->surfaceRepository->fetchSurface($id, $objectTypeId, $surfaceTypeId);

                            if ($surface === FALSE)
                            {
                                $surface = $this->surfaceRepository->insert(
                                    [
                                        SurfaceRepository::COLUMN_SURFACE_TYPE_ID => $surfaceTypeId,
                                        SurfaceRepository::COLUMN_OBJECT_TYPE_ID => $objectTypeId,
                                        SurfaceRepository::COLUMN_TRANSLITERATION_ID => $id
                                    ]
                                );

                                // Z nějakýho důvodu insert vrací počet vložených řádků a ne ActiveRow, i když je v tabulce PK,
                                //  proto se ID načítá takhle zvlášť
                                $surfaceId = $this->context->getInsertId(SurfaceRepository::COLUMN_ID);
                            }

                            $values->{LineRepository::COLUMN_SURFACE_ID} = isset($surfaceId) ? $surfaceId : $surface->{SurfaceRepository::COLUMN_ID};
                            $this->lineRepository->insert($values);
                        }
                    } catch (\Exception $exception)
                    {
                        \Tracy\Debugger::log('Nepodařilo se uložit data transliterace. Chyba: ' . $exception->getMessage(), 'transliteration-facade');
                        return FALSE;
                    }
                }
            }
        }

        return TRUE;
    }

    /**
     * Vrací data transliterace pro formulář
     *
     * @param int $id : ID transliterace
     * @return array : pole výchozích hodnot pro formulář
     */
    public function getTransliterationData(int $id): array
    {
        $surfaces = $this->surfaceRepository->findByTransliterationId($id)->fetchAll();

        $defaults = array();

        /** @var ActiveRow $surface */
        foreach ($surfaces as $surface)
        {
            // Načtení všech řádek
            $lineRows = $surface->related(LineRepository::TABLE_NAME, SurfaceRepository::COLUMN_ID)->fetchAll();
            if ($lineRows === FALSE || empty($lineRows))
            {
                continue;
            }

            $objectId = $surface->{SurfaceRepository::COLUMN_OBJECT_TYPE_ID};
            $surfaceId = $surface->{SurfaceRepository::COLUMN_SURFACE_TYPE_ID};

            $defaults[$objectId][$surfaceId] = $lineRows;
        }

        return $defaults;
    }

    /**
     * Odstraní smazané řádky z DB
     *
     * @param int $id : ID transliterace
     * @param ArrayHash $formValues : hodnoty z formuláře
     * @return int : počet smazaných řádek
     */
    public function removeDeletedLines(int $id, ArrayHash $formValues)
    {
        $deletedIds = $this->getDeletedLineIds($id, $formValues);

        return $this->lineRepository->deleteLines($deletedIds);
    }

    /**
     * Vrací ID smazaných řádek transliterace
     *
     * @param int $id : ID transliterace
     * @param ArrayHash $formValues : hodnoty z formuláře
     * @return array
     */
    private function getDeletedLineIds(int $id, ArrayHash $formValues)
    {
        $deletedIds = [];
        $oldLines = $this->getTransliterationData($id);

        // Tohle je fakt nádhera :(
        foreach ($oldLines as $objectTypeId => $surfaceContainers)
        {
            foreach ($surfaceContainers as $surfaceTypeId => $activeRows)
            {
                foreach ($activeRows as $activeRow)
                {
                    if (isset($formValues[$objectTypeId][$surfaceTypeId]))
                    {
                        $oldLineFound = FALSE;
                        foreach ($formValues[$objectTypeId][$surfaceTypeId] as $array)
                        {
                            if ($array[LineRepository::COLUMN_ID] == $activeRow->{LineRepository::COLUMN_ID})
                            {
                                $oldLineFound = TRUE;
                                break;
                            }
                        }

                        if (!$oldLineFound)
                        {
                            $deletedIds[] = $activeRow->{LineRepository::COLUMN_ID};
                        }
                    }
                }
            }
        }

        return $deletedIds;
    }
    /**
     * Vrací název inputu pro formulář
     *
     * @param string|NULL $name
     * @return string
     */
    public function getInputName(string $name): string
    {
        return str_replace(' ', '', $name);
    }
}