<?php

    class Voiture
    {
        private ?string $marque = null;
        private ?string $couleur = null;

        public function getMarque(): ?string
        {
            return $this->marque;
        }

        public function setMarque(?string $marque) : static
        {
            $this->marque = $marque;
            return $this;
        }

        public function getCouleur(): ?string
        {
            return $this->couleur;
        }

        public function setCouleur(?string $couleur) : static
        {
            $this->couleur = $couleur;
            return $this;
        }

        public function __toString()
        {
            return "Cette voiture est de marque{$this->getMarque()} et de couleur {$this->getCouleur()}";
        }
    }

    $v0 = new Voiture();
    $v0->setMarque("Ferrari");
    $v0->setCouleur("rouge");

    echo $v0;