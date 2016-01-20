<?

namespace Mrafalko\CommandRunnerBundle\DependencyInjection;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Application;

class CommandHelper {

    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

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

    public function buildCommandFromQuery($command, Request $request) {
        $params = $request->get('params');

        if (!is_array($params)) {
            // Bad params
            $params = array();
        }

        $options = $request->get('options');

        if (!is_array($options)) {
            // Bad options
            $options = array();
        }

        $preparedOptions = array();
        foreach ($options as $option => $value) {
            $preparedOptions['--' . $option] = $value;
        }

        $string = $command;

        foreach ($params as $param) {
            $string .= ' ' . $param;
        }

        foreach ($preparedOptions as $key => $option) {
            if (empty($option)) {
                $string .= ' ' . $key;
            } else {
                $string .= ' ' . sprintf('%s=%s', $key, html_entity_decode($option));
            }
        }

        return $string;
    }


}

?>