<?php
/**
 * File:CreateSampleCommand.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Console\Command;

use Exception;
use MSlwk\Sample\Api\Data\SampleInterface;
use MSlwk\Sample\Api\Data\SampleInterfaceFactory;
use MSlwk\Sample\Api\Data\SampleRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

//Sample CLI command used for adding new entities to the DB using
//a repository. It is available as lm_sample:sample-create and
//has two required options:
//--title
//--desc

/**
 * Class CreateSampleCommand
 * @package MSlwk\Sample\Console\Command
 */
class CreateSampleCommand extends Command
{
    /** @var string */
    public const COMMAND_NAME = 'mslwk-sample:sample-create';

    /** @var string */
    public const SAMPLE_TITLE_ARG = 'title';

    /** @var string */
    public const SAMPLE_DESC_ARG = 'desc';

    /**
     * @var SampleRepositoryInterface
     */
    private $sampleRepository;

    /**
     * @var SampleInterfaceFactory
     */
    private $sampleFactory;

    /**
     * CreateSampleCommand constructor.
     * @param SampleRepositoryInterface $sampleRepository
     * @param SampleInterfaceFactory $sampleFactory
     * @param string|null $name
     */
    public function __construct(
        SampleRepositoryInterface $sampleRepository,
        SampleInterfaceFactory $sampleFactory,
        string $name = null
    ) {
        parent::__construct($name);
        $this->sampleRepository = $sampleRepository;
        $this->sampleFactory = $sampleFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME)
            ->setDescription('Create Sample instance')
            ->addOption(
                self::SAMPLE_TITLE_ARG,
                null,
                InputOption::VALUE_REQUIRED,
                'Sample title'
            )->addOption(
                self::SAMPLE_DESC_ARG,
                null,
                InputOption::VALUE_REQUIRED,
                'Sample description'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $title = $input->getOption(self::SAMPLE_TITLE_ARG);
        $description = $input->getOption(self::SAMPLE_DESC_ARG);

        /** @var SampleInterface $sample */
        $sample = $this->sampleFactory->create();
        $sample->setTitle($title);
        $sample->setDescription($description);
        try {
            $this->sampleRepository->save($sample);
            $output->writeln('A sample was saved successfully');
        } catch (Exception $e) {
            $output->writeln("An error occurred while saving a sample: {$e->getMessage()}");
        }
    }
}
