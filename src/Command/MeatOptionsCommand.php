<?php declare(strict_types = 1);

namespace App\Command;

use App\Client\KebaberClient;
use App\DataProvider\MeatProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MeatOptionsCommand extends Command
{
    protected const COMMAND_DESCRIPTION = 'List Meat Options';

    protected static $defaultName = 'options:meat';

    /**
     * @var MeatProvider
     */
    private $meatProvider;

    /**
     * @param MeatProvider $meatProvider
     */
    public function __construct(MeatProvider $meatProvider)
    {
        parent::__construct(null);

        $this->meatProvider = $meatProvider;
    }

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

        $data = $this->meatProvider->provideMeat();

        foreach ($data as $i => $meat) {
            $formatted = "[<info>$i</info>] {$meat->getName()}: {$meat->getDescription()}";
            $output->writeln($formatted);
        }

        $output->writeln('');

        return 0;
    }
}
