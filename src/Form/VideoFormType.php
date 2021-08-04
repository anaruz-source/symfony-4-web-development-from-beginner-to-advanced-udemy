<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename', TextType::class, ['label' => 'set filename', 'data' => 'data example'])
            ->add('description', TextareaType::class, ['required' => false])
            ->add('size')
            ->add('format')
            ->add('duration')
            ->add('save', SubmitType::class)
            ->add('agreeTerms', CheckboxType::class, ['label' => 'agree ?', 'mapped' => false]) // not mapped to Database!
            ->add('file', FileType::class, ['label' => 'Video (MP4 file)'])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $video = $event->getData();
            $form = $event->getForm();

            if (!$video || null === $video->getId()) {
                $form->add('created_at',
                            DateType::class,
                            ['label' => 'Set Date', 'widget' => 'single_text']);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
