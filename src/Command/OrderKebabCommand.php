<?php declare(strict_types = 1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class OrderKebabCommand extends Command
{
    protected const COMMAND_DESCRIPTION = 'Order a Kebab';

    protected static $defaultName = 'order';

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
        $output->writeln('<comment>Ordering Kebab</comment>');

        //region Resolve Meat
        $cUrl = curl_init();
        curl_setopt($cUrl, CURLOPT_URL, 'http://kebab.io/meats');
        curl_setopt($cUrl, CURLOPT_PORT, '8000');
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($cUrl);
        $data = json_decode($json, true);

        $meatOptions = [];
        foreach ($data as $meatData) {
            $meatOptions[] = $meatData['name'];
        }

        $choiceQuestion = new ChoiceQuestion(
            '<question>What kind of meat do you want?</question>',
            $meatOptions
        );

        $meat = $this->getHelper('question')->ask(
            $input,
            $output,
            $choiceQuestion
        );

        $output->writeln('');
        $output->writeln("You have chosen: <info>{$meat}</info>");
        $output->writeln('');
        //endregion

        //region Resolve Sauce
        $cUrl = curl_init();
        curl_setopt($cUrl, CURLOPT_URL, 'http://kebab.io/sauces');
        curl_setopt($cUrl, CURLOPT_PORT, '8000');
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($cUrl);

        $sauceData = json_decode($json, true);

        $sauceOptions = [];
        foreach ($sauceData as $sauce) {
            $sauceOptions[] = $sauce['name'];
        }

        $choiceQuestion = new ChoiceQuestion(
            '<question>What kind of sauce do you want?</question>',
            $sauceOptions
        );

        $sauce = $this->getHelper('question')->ask(
            $input,
            $output,
            $choiceQuestion
        );

        $output->writeln('');
        $output->writeln("You have chosen: <info>{$sauce}</info>");
        $output->writeln('');
        //endregion

        //region Confirm Order
        $output->writeln('Your Kebab Details:');

        $output->writeln("\tMeat: <info>{$meat}</info>");
        $output->writeln("\tSauce: <info>{$sauce}</info>");

        $output->writeln('');
        $question = new ConfirmationQuestion('<question>Confirm order?</question> [Y/n]');
        $isConfirmed = $this->getHelper('question')->ask(
            $input,
            $output,
            $question
        );

        if (!$isConfirmed) {
            return 0;
        }
        //endregion

        //region Make Order
        $output->writeln('');
        $output->writeln('<info>Ordering Kebab</info>');
        $output->writeln('');

        $progressBar = new ProgressBar($output, 100);

        $progressBar->start();

        $i = 0;
        while ($i++ < 100) {
            \usleep(10000);

            $progressBar->advance();
        }
        $progressBar->finish();

        // TODO: IMPLEMENT ORDERING! !!!!!

        $output->writeln('');
        $output->writeln('');
        $output->writeln('');
        $output->writeln('<info>! Kebab Ordered !</info>');
        //endregion

        return 0;
    }
}
