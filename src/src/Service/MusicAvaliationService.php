<?php


namespace App\Service;

use App\Entity\User;
use App\Entity\Music;
use App\Entity\Avaliation;
use App\Repository\AvaliationRepository;

class MusicAvaliationService
{
    /**
     * @var AvaliationRepository
     */
    private AvaliationRepository $avaliationRepository;

    public function __construct(AvaliationRepository $avaliationRepository) {

        $this->avaliationRepository = $avaliationRepository;
    }


    public function avalia(User $user,Music $music) {
        $avaliation =new Avaliation();
        $avaliation->setMusic($music);
        $avaliation->setUser($user);
        $this->avaliationRepository->save($avaliation);
        $music->addAvaliation($avaliation);
    }
}
