<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 21/08/2018
 * Time: 05:45
 */

namespace App\Command\Middle\LoadData;

use App\DataLoader\Middle\VisibilyLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoadVisibilityCommand extends Command
{
    /**
     * @var VisibilyLoader
     */
    private $visibilityLoader;

    /**
     * LoadVisibilityCommand constructor.
     * @param VisibilyLoader $visibilityLoader
     */
    public function __construct(VisibilyLoader $visibilityLoader)
    {
        parent::__construct();
        $this->visibilityLoader = $visibilityLoader;
    }

    /**
     * Configurations
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('hepatron:load:visibility')

            // the short description shown while running "php bin/console list"
            ->setDescription('Load visibilities in database')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to load visibilities from csv file')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Chargement des visibilés des publications');
        $loadingResult = $this->visibilityLoader->load();
        if(!$loadingResult){
            $io->error($loadingResult);
        }
        $io->success("Chargement éffectué!");
    }
}