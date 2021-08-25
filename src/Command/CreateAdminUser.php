<?php


namespace App\Command;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class CreateAdminUser extends Command
{
    protected static $defaultName = 'app:create-admin';

    private UserPasswordEncoderInterface $passwordEncoder;

    private EntityManagerInterface $em;

    /**
     * MarkUserAsAdminCommand constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Email konta administratora')
            ->addArgument('pass', InputArgument::REQUIRED, 'Hasło konta administratora')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $user = new User();
            $user->setFirstname('Admin')
                ->setLastname('Admin')
                ->setIsVerified(true)
                ->setEmail(
                    $input->getArgument('email')
                )
                ->setRoles(['ROLE_ADMIN']);

            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $input->getArgument('pass')
                )
            );

            $this->em->persist($user);
            $this->em->flush();
        } catch (\Exception $exception) {
            $output->writeln($exception->getMessage());

            return Command::FAILURE;
        }


        $output->writeln('User successfully generated!');

        return Command::SUCCESS;
    }
}