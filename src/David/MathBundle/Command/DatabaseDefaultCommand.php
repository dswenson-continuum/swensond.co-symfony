<?php
namespace David\MathBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use David\MathBundle\Entity\Card;

class DatabaseDefaultCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this->setName('load-defaults')->setDescription('Build database defaults');
	}

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $cards = array();
        for($i=1; $i<=28; $i++){
            $cards[] = array("name"=>"AutoGenCardTest","cost"=>mt_rand(0, 10),"attack"=>mt_rand(0, 10),"defense"=>mt_rand(0, 10),"description"=>"Autocard ".$i,"image"=>"http://devimg.com/200/200/");
        }
        foreach($cards as $card_array){
            $card = new Card();
            foreach($card_array as $key=>$value){
                $Key = "set".ucfirst($key);
                $card->$Key($value);
            }
            $em->persist($card);
        }
        $em->flush();
    }
}
