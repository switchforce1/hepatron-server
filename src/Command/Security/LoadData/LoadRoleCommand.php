<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 21/08/2018
 * Time: 05:45
 */

namespace App\Command\Security\LoadData;

use App\DataLoader\Security\RoleLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadRoleCommand extends Command
{
    /**
     * @var RoleLoader
     */
    private $roleLoader;

    /**
     * LoadRoleCommand constructor.
     * @param RoleLoader $roleLoader
     */
    public function __construct(RoleLoader $roleLoader)
    {
        parent::__construct();
        $this->roleLoader = $roleLoader;
    }


    /**
     * Configurations
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('hepatron:load:role')

            // the short description shown while running "php bin/console list"
            ->setDescription('Load roles in database')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to load roles from csv file')
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
        $loadingResult = $this->roleLoader->load();

        $output->write($loadingResult);
    }
}