<?php

namespace Mrafalko\CommandRunnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommandRunnerController extends Controller
{
    /**
     * @Route("/command-runner/{commandName}", name="run_command")
     * @Template()
     *
     * @param $commandName
     * @param Request $request
     * @return array
     */
    public function indexAction($commandName, Request $request)
    {

        $commandHelper = $this->get('command.helper');
        $command = $commandHelper->buildCommandFromQuery($commandName, $request);

        $response = $commandHelper->run($command);

        return array('response' => $response);
    }
}

