<?php declare(strict_types = 1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MeatOptionsCommand extends Command
{
    protected const COMMAND_DESCRIPTION = 'List Meat Options';

    protected static $defaultName = 'options:meat';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription(static::COMMAND_DESCRIPTION);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<comment>Listing Kebab Meat Options:</comment>');
        $output->writeln('');

        $cUrl = curl_init();
        curl_setopt($cUrl, CURLOPT_URL, 'http://kebab.io/meats');
        curl_setopt($cUrl, CURLOPT_PORT, '8000');
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($cUrl);

        $data = json_decode($json, true);

        foreach ($data as $i => $meat) {
            $formatted = "[<info>$i</info>] {$meat['name']}: {$meat['description']}";
            $output->writeln($formatted);
        }

        $output->writeln('');

        return 0;
    }
}
