<?php

declare(strict_types=1);

namespace App\Form;

use App\Utils\BattleNetHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Laurent Bassin <laurent@bassin.info>
 */
class RealmType extends AbstractType
{
    /**
     * @var BattleNetHelper
     */
    private $battleNetHelper;

    /**
     * RealmType constructor.
     * @param BattleNetHelper $battleNetHelper
     */
    public function __construct(BattleNetHelper $battleNetHelper)
    {
        $this->battleNetHelper = $battleNetHelper;
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => $this->battleNetHelper->getRealms()
        ]);
    }

    /**
     * @return string
     */
    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
