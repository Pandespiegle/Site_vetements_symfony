<?php

namespace App\Form;

use App\Entity\Chaussure;
use App\Repository\CategorieRepository;
use App\Repository\MarqueRepository;
use App\Repository\PointureRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ChaussureFormType extends AbstractType
{

    private  $categorieRepository;
    private $marqueRepository;
    private $pointureRepository;

    public function __construct(CategorieRepository $categorieRepository, MarqueRepository $marqueRepository, PointureRepository $pointureRepository)
    {
        $this->categorieRepository = $categorieRepository;
        $this->marqueRepository = $marqueRepository;
        $this->pointureRepository = $pointureRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du vêtement',
            ])
            ->add('prix') 
            ->add('imageUrl')
            ->add('categorie', ChoiceType::class, [
                'choices'  => $this->categorieRepository->findAllValues(),
                'choice_label' => 'name',
            ])
            ->add('marque', ChoiceType::class, [
                'choices' => $this->marqueRepository->findAllValues(),
                'choice_label' => 'name',
            ]) 

            ->add('pointures', ChoiceType::class, [
                'choices' => $this->pointureRepository->findAllValues(),
                'choice_label' => 'pointure',
                'expanded'      => true,
                'multiple'      => true,
                'data' => [],
            ]) ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chaussure::class,
        ]);
    }
}
