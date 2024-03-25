<?php

namespace App\DataFixtures;

use App\Entity\Setting;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SettingFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $setting = $this->createSetting();

        $manager->persist($setting);

        $manager->flush();
    }

    private function createSetting(): Setting
    {
        $setting = new Setting();

        $setting->setWebsiteName("electrotecth");
        $setting->setWebsiteUrl("https://electrotecth.com");
        $setting->setDescription("Acheter des produits interessants.");
        $setting->setEmail("electrotecth@gmail.com");
        $setting->setPhone("06 05 05 05 05");
        $setting->setStreet("06 Rue du Pape");
        $setting->setCity("Paris");
        $setting->setPostalCode("75000");
        $setting->setState("France");
        $setting->setFacebookLink("https://facebook.com");
        $setting->setInstagramLink("https://instagram.com");
        $setting->setTiktokLink("https://tiktok.com");
        $setting->setCreatedAt(new DateTimeImmutable());
        $setting->setUpdatedAt(new DateTimeImmutable());

        return $setting;
    }
}
