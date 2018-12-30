<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 21/08/2018
 * Time: 05:45
 */

namespace App\Command\Security\LoadData;

use App\DataLoader\Security\DevUserLoader;
use App\DataLoader\Security\ProfilLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoadDevUserCommand extends Command
{
    /**
     * @var DevUserLoader
     */
    private $devUserLoader;

    /**
     * LoadProfilCommand constructor.
     * @param DevUserLoader $devUserLoader
     */
    public function __construct(DevUserLoader $devUserLoader)
    {
        parent::__construct();
        $this->devUserLoader = $devUserLoader;
    }


    /**
     * Configurations
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('hepatron:load:user')

            // the short description shown while running "php bin/console list"
            ->setDescription('Load users in database')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to load users from csv file')
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
        $io->title('Chargement des utilisateur en mode developpement.');
        $loadingResult = $this->devUserLoader->load();
        if(!$loadingResult){
            $io->error($loadingResult);
        }
        $io->success("Chargement éffectué!");
    }
}