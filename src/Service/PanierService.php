<?php

namespace App\Service;

use App\Entity\Plat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    private RequestStack $requestStack;

    private EntityManagerInterface $em;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    public function addToCart(int $id): void
    {
        $panier = $this->getSession()->get('panier', []);
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $this->getSession()->set('panier', $panier);
    }

    public function removeToCart(int $id)
    {
        $panier = $this->getSession()->get('panier', []);
        if ($panier[$id]>1) {
            $panier[$id]--;
        } else {
            unset($panier[$id]);
        }
        $this->getSession()->set('panier', $panier);
    }

    public function removePanier()
    {
        return $this->getSession()->remove('panier');
    }

    //    public function removePanier(int $id) {
//        $panier = $this->requestStack->getSession()->get('panier', []);
//        unset($panier[$id]);
//        return $this->getSession()->set('panier', $panier);
//    }

    public function getTotal(): array
    {
        $panier = $this->getSession()->get('panier');
        $panierData = [];
        if ($panier) {
            foreach ($panier as $id => $quantite) {
                $plat = $this->em->getRepository(Plat::class)->findOneBy(['id' => $id]);
                if (!$plat) {
                    //Supprimer le plat puis continuer en sortant de la boucle
                }
                $panierData[] = [
                    'plat' => $plat,
                    'quantite' => $quantite,
                ];
            }
        }
        return $panierData;
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }

}