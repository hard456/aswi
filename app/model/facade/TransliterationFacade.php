<?php


namespace App\Model\Facade;


use App\Model\Repository\LineRepository;
use App\Model\Repository\ObjectTypeRepository;
use App\Model\Repository\SurfaceRepository;
use App\Model\Repository\SurfaceTypeRepository;
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

    public function __construct(SurfaceRepository $surfaceRepository,
                                LineRepository $lineRepository,
                                ObjectTypeRepository $objectTypeRepository,
                                SurfaceTypeRepository $surfaceTypeRepository
    )
    {
        $this->surfaceRepository = $surfaceRepository;
        $this->lineRepository = $lineRepository;
        $this->objectTypeRepository = $objectTypeRepository;
        $this->surfaceTypeRepository = $surfaceTypeRepository;
    }

    /**
     * Uloží data transliterace
     *
     * @param int|null $id : ID transliterace
     * @param ArrayHash $formValues
     */
    public function saveTransliterationData(int $id, ArrayHash $formValues)
    {
        // Škaredý zanoření hodnot z formuláře v kontainerech :(
        foreach ($formValues as $objectTypeId => $surfaceContainers)
        {
            foreach ($surfaceContainers as $surfaceTypeId => $inputs)
            {
                foreach ($inputs as $key => $values)
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
                            // TODO: předělat do repository
                            $surface = $this->surfaceRepository->insert(
                                [
                                    SurfaceRepository::COLUMN_SURFACE_TYPE_ID => $surfaceTypeId,
                                    SurfaceRepository::COLUMN_OBJECT_TYPE_ID => $objectTypeId,
                                    SurfaceRepository::COLUMN_TRANSLITERATION_ID => $id
                                ]
                            );
                        }

                        $values->{LineRepository::COLUMN_SURFACE_ID} = $surface->{SurfaceRepository::COLUMN_ID};
                        $this->lineRepository->insert($values);
                    }
                }
            }
        }
    }

    /**
     * Vrací data transliterace pro formulář
     *
     * @param int $id : ID transliterace
     * @return array
     */
    public function getTransliterationData(int $id)
    {
        $surfaces = $this->surfaceRepository->findByTransliterationId($id)->fetchAll();

        $defaults = array();

        /** @var ActiveRow $surface */
        foreach ($surfaces as $surface)
        {
            // Načtení všech řádek
            $lineRows = $surface->related(LineRepository::TABLE_NAME, SurfaceRepository::COLUMN_ID)->fetchAll();
            if ($lineRows === FALSE)
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
     * Vrací název inputu pro formulář
     *
     * @param string|NULL $name
     * @return string
     */
    public function getInputName(string $name)
    {
        return str_replace(' ', '', $name);
    }
}