<?php

use Doctrine\Common\Collections\ArrayCollection;
use Dotenv\Dotenv;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\PropertyAccess\PropertyAccess;

if (!function_exists('load_envs')) {
    /**
     * Load .env file
     */
    function load_envs()
    {
        (Dotenv::createImmutable(__DIR__))->load();
    }
}

if (!function_exists('env')) {
    function env($name, $default = null)
    {
        try {
            return $_ENV[$name];
        } catch (\Throwable $e) {
            return $default;
        }
    }
}

if (!function_exists('data_get')) {
    /**
     * Get object or array index using dot notation
     * 
     * @see https://symfony.com/doc/current/components/property_access.html#usage
     * @todo Install/use Service container (avoid to 're-instance' some classes)
     * @param object|array $objectOrArray
     * @param string $path
     * @param mixed $default
     * @return mixed
     */
    function data_get($objectOrArray, string $path, $default = null)
    {
        try {
            $propertyAcessor = PropertyAccess::createPropertyAccessor();

            return $propertyAcessor->getValue($objectOrArray, $path);
        } catch (\Throwable $e) {
            return $default;
        }
    }
}

if (!function_exists('data_set')) {
    /**
     * Set on object/array using dot notation
     * 
     * @see https://symfony.com/doc/current/components/property_access.html#writing-to-arrays
     * @see https://symfony.com/doc/current/components/property_access.html#writing-to-objects
     * @todo Install/use Service container (avoid to 're-instance' some classes)
     * @param object|array $objectOrArray
     * @param string $path
     * @param mixed $default
     * @return bool False if value cannot be set
     */
    function data_set($objectOrArray, string $path, $value)
    {
        try {
            $propertyAcessor = PropertyAccess::createPropertyAccessor();
            $propertyAcessor->setValue($objectOrArray, $path, $value);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}

if (!function_exists('collection')) {
    /**
     * Create a collection from array
     * 
     * @see https://www.doctrine-project.org/projects/doctrine-collections/en/stable/index.html
     * @param array $arr
     * @return ArrayCollection
     */
    function collection(array $arr)
    {
        return new ArrayCollection($arr);
    }
}

if (!function_exists('get_fixture')) {
    /**
     * Get fixture file data content
     * 
     * 
     */
    function get_fixture(string $fixtureName, $toArray = false)
    {
        try {
            $data = json_decode(file_get_contents(__DIR__ . "/fixtures/{$fixtureName}"));

            if ($toArray) {
                return (array) $data;
            }

            return $data;
        } catch (\Throwable $e) {
            return false;
        }
    }
}

if (!function_exists('console_out_normal')) {
    function console_out_normal(string $text): void
    {
        $output = new ConsoleOutput();
        $output->writeln($text);
    }
}

if (!function_exists('console_out_error')) {
    function console_out_error(string $text): void
    {
        $output = new ConsoleOutput();
        $output->writeln(sprintf('<error>%s</error>', $text));
    }
}

if (!function_exists('console_out_warning')) {
    function console_out_warning(string $text): void
    {
        $output = new ConsoleOutput();
        $output->writeln(sprintf('<comment>%s</comment>', $text));
    }
}

if (!function_exists('console_out_success')) {
    function console_out_success(string $text): void
    {
        $output = new ConsoleOutput();
        $output->writeln(sprintf('<info>%s</info>', $text));
    }
}

if (!function_exists('console_out_table')) {
    function console_out_table(
        OutputInterface $output,
        array $headers,
        array $rows,
        ?string $headerTitle = null,
        ?string $footerTitle = null
    ): void {
        $table = new Table($output);
        $table
            ->setHeaders($headers)
            ->setRows($rows)
            ->setHeaderTitle($headerTitle)
            ->setFooterTitle($footerTitle);

        $table->render();
    }
}

if (!function_exists('console_in_question')) {
    function console_in_question(
        InputInterface $input,
        OutputInterface $output,
        string $questionText,
        array $choices,
        bool $multiselect = false,
        int|string|null $default = null
    ) {
        $helper = new QuestionHelper();
        $question = new ChoiceQuestion($questionText, $choices, $default);
        $question->setErrorMessage('Invalid choice...');
        $question->setMultiselect($multiselect);

        return $helper->ask($input, $output, $question);
    }
}
