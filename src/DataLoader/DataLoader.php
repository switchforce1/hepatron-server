<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 19/08/2018
 * Time: 21:06
 */

namespace App\DataLoader;


use App\Helper\Generic\CsvHelper;
use App\Helper\Generic\FileHelper;
use phpDocumentor\Reflection\Types\Boolean;

abstract class DataLoader implements  LoaderInterface
{
    /**
     * Load data relative location/path
     */
    const LOAD_DATA_RELATIVE_PATH = FileHelper::FILES_RELATIVE_PATH.DIRECTORY_SEPARATOR.'load_data';

    /**
     * @var FileHelper
     */
    private $fileHelper;

    /**
     * @var CsvHelper
     */
    private $csvHelper;

    /**
     * DataLoader constructor.
     * @param FileHelper $fileHelper
     * @param CsvHelper $csvHelper
     */
    public function __construct(FileHelper $fileHelper, CsvHelper $csvHelper)
    {
        $this->fileHelper = $fileHelper;
        $this->csvHelper = $csvHelper;
    }


    /**
     * @return bool
     * @throws \Exception
     */
    public function load(): bool
    {
        try{
            $data = $this->getLoadData();
        }catch(\Exception $exception){
            throw new \Exception($exception->getMessage());
        }

        if(empty($data)){
            return false;
        }
        foreach ($data as $key => $element){
            if($key > 0){
                try{
                    $this->loadElement($element);
                }catch (\Exception $exception){
                    $errors[] = "Une erreur";
                }
            }
        }
        return true;
    }

    /**
     * @return array|null
     * @throws \Exception
     */
    public function getLoadData(): ?array
    {
        try{
            $data = $this->csvHelper->readData($this->getLoadDataFilePath(), ';');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
        return $data;
    }

    /**
     * @return string
     */
    protected function getLoadDataDirectory()
    {
        return $this->fileHelper->getProjetDir().DIRECTORY_SEPARATOR.self::LOAD_DATA_RELATIVE_PATH;
    }

    /**
     * Recupere le nom du fichier de données
     * @return string
     */
    abstract protected function getLoadDataFilePath(): string;

    /**
     * @param array $element
     * @return bool
     */
    abstract protected function loadElement(array $element);
}