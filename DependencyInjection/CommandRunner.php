<?

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Application;

class CommandRunner {

    /** @var ContainerInterface */
    private $container;

    public function run( $command ) {

        $kernel = $this->container->get('kernel');
        $app = new Application($kernel);

        $input = new StringInput($command);
        $input->setInteractive(false);
        $output = new StreamOutput(fopen('php://temp', 'w'));

        // Run the command
        $app->doRun($input, $output);

        rewind($output->getStream());
        $response = stream_get_contents($output->getStream());

        return $response;
    }
}

?>