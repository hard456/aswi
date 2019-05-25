<?php


namespace App\Model\Facade;


use App\Model\Repository\LineRepository;
use App\Model\Repository\ObjectTypeRepository;
use App\Model\Repository\SurfaceRepository;
use App\Model\Repository\SurfaceTypeRepository;
use Nette\Database\Table\ActiveRow;

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
     * @param int $id
     * @param array $values
     */
    public function saveTransliterationData(int $id, array $values)
    {

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

        $surfaceTypes = $this->surfaceTypeRepository->fetchSurfaceTypes();
        $objectTypes = $this->objectTypeRepository->fetchObjectTypes();

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

            // Získání názvu typu povrchu a typu objektu
            $surfaceType = $surfaceTypes[$surface->{SurfaceRepository::COLUMN_SURFACE_TYPE_ID}];
            $objectType = $objectTypes[$surface->{SurfaceRepository::COLUMN_OBJECT_TYPE_ID}];

            $objectName = $this->getInputName($objectType);
            $surfaceName = $this->getInputName($surfaceType);

            $defaults[$objectName][$surfaceName] = $lineRows;
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