<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26.10.2018
 * Time: 12:53
 */

namespace Blogger\BlogBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class GetCoursesCommand extends ContainerAwareCommand
{

    private $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
    protected function configure()
    {
        $this->setName('app:get-courses')
             ->setDescription('Requests currency rates from the site www.cbr.ru')
            ->setHelp('This command allows you get currency rates from the site www.cbr.ru');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $courses = file_get_contents($this->url);

        if(!$courses){
            throw new \Exception('Не удалось получить ответ от сервера');
        }



    }
}