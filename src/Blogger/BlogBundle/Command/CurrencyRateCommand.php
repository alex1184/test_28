<?php


namespace Blogger\BlogBundle\Command;

use Blogger\BlogBundle\Entity\CurrencyRate;
use Blogger\BlogBundle\Entity\Result;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CurrencyRateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:get-rates');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.89 Safari/537.36';
        $timeout= 120;
        $dir            = dirname(__FILE__);
        $cookie_file    = $dir . '/cookies/' . md5('127.0.0.1') . '.txt';

        $ch = curl_init('http://www.cbr.ru/scripts/XML_daily.asp');
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt($ch, CURLOPT_ENCODING, "" );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_AUTOREFERER, true );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout );
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/xml']);
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com/');
        $content = curl_exec($ch);
        curl_close($ch);

        if(!$content){
            $output->write("Can't get  result");
            die();
        }
        $serializer = \JMS\Serializer\SerializerBuilder::create()
            ->setPropertyNamingStrategy(
                new \JMS\Serializer\Naming\SerializedNameAnnotationStrategy(
                    new \JMS\Serializer\Naming\IdenticalPropertyNamingStrategy()
                )
            )
            ->build();
        $data = $serializer->deserialize($content, Result::class, 'xml');
        $em = $this->getContainer()->get('doctrine')
            ->getRepository(CurrencyRate::class)
            ->findAll();

        if(empty($em)){
            $em = $this->getContainer()->get('doctrine')->getManager();
            foreach($data->valutes AS $currency){
                $em->persist($currency);
                $em->flush();
            }
        } else {
            $em = $this->getContainer()->get('doctrine');
            foreach($data->valutes AS $currency){
                $c = $em->getRepository(CurrencyRate::class)->findOneBy(['NumCode' => $currency->getNumcode()]);
                $em = $this->getContainer()->get('doctrine')->getManager();
                if($c){
                    $c->setNominal($currency->getNominal());
                    $c->setCharCode($currency->getCharcode());
                    $c->setValue($currency->getValue());
                    $c->setName($currency->getName());
                } else {
                    $em->persist($currency);
                }
                $em->flush();
            }
        }
        $output->write("Ok");
    }
}