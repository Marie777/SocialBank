<?php
/**
 * Created by PhpStorm.
 * User: Mmarie
 * Date: 4/30/2016
 * Time: 6:32 AM
 */

namespace AppBundle\Form\Type;

use AppBundle\Form\DataTransformer\DestinationTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionFormType extends AbstractType {
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * TransactionFormType constructor.
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', NumberType::class)
            ->add('dueDate', DateType::class)
            ->add('destination', TextType::class, [
                'invalid_message' => 'Account number doesn\'t exist',
            ])
            ->add('submit', SubmitType::class)
            ->get('destination')->addModelTransformer(new DestinationTransformer($this->om));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Transaction',
        ]);
    }
}