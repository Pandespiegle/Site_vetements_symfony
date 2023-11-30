<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Vetement;
use App\Repository\CategorieRepository;
use App\Repository\MarqueRepository;
use App\Repository\TailleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class VetementFormType extends AbstractType
{

    private  $categorieRepository;
    private $marqueRepository;
    private $tailleRepository;

    public function __construct(CategorieRepository $categorieRepository, MarqueRepository $marqueRepository, TailleRepository $tailleRepository)
    {
        $this->categorieRepository = $categorieRepository;
        $this->marqueRepository = $marqueRepository;
        $this->tailleRepository = $tailleRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du vêtement',
            ])
            ->add('prix', null, [
                'label' => 'Prix (en €)',
            ]) 
            ->add('imageUrl', null, [
                'label' => 'URL de l\'image',
            ])
            ->add('categorie', ChoiceType::class, [
                'choices'  => $this->categorieRepository->findAllValues(),
                'choice_label' => 'name',
            ])
            ->add('marque', ChoiceType::class, [
                'choices' => $this->marqueRepository->findAllValues(),
                'choice_label' => 'name',
            ]) 

            ->add('tailles', ChoiceType::class, [
                'choices' => $this->tailleRepository->findAllValues(),
                'choice_label' => 'name',
                'expanded'      => true,
                'multiple'      => true,
                'data' => [],
            ]) 
            ->add('commentaire', null, [
                'label' => 'Commentaire (optionnel)',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vetement::class,
        ]);
    }
}
