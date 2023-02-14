<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214130408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergy (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT NOT NULL, user_id INT NOT NULL, openingday_id INT NOT NULL, openinghour_id INT NOT NULL, guest_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E00CEDDEB1E7706E (restaurant_id), INDEX IDX_E00CEDDEA76ED395 (user_id), INDEX IDX_E00CEDDE2FA0D13C (openingday_id), INDEX IDX_E00CEDDE48D7E013 (openinghour_id), INDEX IDX_E00CEDDE9A4AA658 (guest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_allergy (booking_id INT NOT NULL, allergy_id INT NOT NULL, INDEX IDX_910F07953301C60 (booking_id), INDEX IDX_910F0795DBFD579D (allergy_id), PRIMARY KEY(booking_id, allergy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE daytime (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', favorite TINYINT(1) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_957D8CB8B1E7706E (restaurant_id), INDEX IDX_957D8CB812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guest (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_daytime (menu_id INT NOT NULL, daytime_id INT NOT NULL, INDEX IDX_13F4B32ECCD7E912 (menu_id), INDEX IDX_13F4B32E7D165 (daytime_id), PRIMARY KEY(menu_id, daytime_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE openingday (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT NOT NULL, day VARCHAR(255) NOT NULL, open TINYINT(1) NOT NULL, INDEX IDX_C5AEC5BFB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE openinghour (id INT AUTO_INCREMENT NOT NULL, starthour TIME NOT NULL, endhour TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE openinghour_openingday (openinghour_id INT NOT NULL, openingday_id INT NOT NULL, INDEX IDX_F957227248D7E013 (openinghour_id), INDEX IDX_F95722722FA0D13C (openingday_id), PRIMARY KEY(openinghour_id, openingday_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address LONGTEXT NOT NULL, zipcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nbseatings INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setmenu (id INT AUTO_INCREMENT NOT NULL, menu_id INT NOT NULL, title VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, shortdesc LONGTEXT NOT NULL, description LONGTEXT NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_48C628A1CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setmenu_dish (setmenu_id INT NOT NULL, dish_id INT NOT NULL, INDEX IDX_4D1BE2AB91A13B00 (setmenu_id), INDEX IDX_4D1BE2AB148EB0CB (dish_id), PRIMARY KEY(setmenu_id, dish_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, guest_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6499A4AA658 (guest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_allergy (user_id INT NOT NULL, allergy_id INT NOT NULL, INDEX IDX_93BC5CBFA76ED395 (user_id), INDEX IDX_93BC5CBFDBFD579D (allergy_id), PRIMARY KEY(user_id, allergy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE2FA0D13C FOREIGN KEY (openingday_id) REFERENCES openingday (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE48D7E013 FOREIGN KEY (openinghour_id) REFERENCES openinghour (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql('ALTER TABLE booking_allergy ADD CONSTRAINT FK_910F07953301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_allergy ADD CONSTRAINT FK_910F0795DBFD579D FOREIGN KEY (allergy_id) REFERENCES allergy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE menu_daytime ADD CONSTRAINT FK_13F4B32ECCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_daytime ADD CONSTRAINT FK_13F4B32E7D165 FOREIGN KEY (daytime_id) REFERENCES daytime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE openingday ADD CONSTRAINT FK_C5AEC5BFB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE openinghour_openingday ADD CONSTRAINT FK_F957227248D7E013 FOREIGN KEY (openinghour_id) REFERENCES openinghour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE openinghour_openingday ADD CONSTRAINT FK_F95722722FA0D13C FOREIGN KEY (openingday_id) REFERENCES openingday (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE setmenu ADD CONSTRAINT FK_48C628A1CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE setmenu_dish ADD CONSTRAINT FK_4D1BE2AB91A13B00 FOREIGN KEY (setmenu_id) REFERENCES setmenu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE setmenu_dish ADD CONSTRAINT FK_4D1BE2AB148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6499A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql('ALTER TABLE user_allergy ADD CONSTRAINT FK_93BC5CBFA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergy ADD CONSTRAINT FK_93BC5CBFDBFD579D FOREIGN KEY (allergy_id) REFERENCES allergy (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEB1E7706E');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEA76ED395');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE2FA0D13C');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE48D7E013');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9A4AA658');
        $this->addSql('ALTER TABLE booking_allergy DROP FOREIGN KEY FK_910F07953301C60');
        $this->addSql('ALTER TABLE booking_allergy DROP FOREIGN KEY FK_910F0795DBFD579D');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB8B1E7706E');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB812469DE2');
        $this->addSql('ALTER TABLE menu_daytime DROP FOREIGN KEY FK_13F4B32ECCD7E912');
        $this->addSql('ALTER TABLE menu_daytime DROP FOREIGN KEY FK_13F4B32E7D165');
        $this->addSql('ALTER TABLE openingday DROP FOREIGN KEY FK_C5AEC5BFB1E7706E');
        $this->addSql('ALTER TABLE openinghour_openingday DROP FOREIGN KEY FK_F957227248D7E013');
        $this->addSql('ALTER TABLE openinghour_openingday DROP FOREIGN KEY FK_F95722722FA0D13C');
        $this->addSql('ALTER TABLE setmenu DROP FOREIGN KEY FK_48C628A1CCD7E912');
        $this->addSql('ALTER TABLE setmenu_dish DROP FOREIGN KEY FK_4D1BE2AB91A13B00');
        $this->addSql('ALTER TABLE setmenu_dish DROP FOREIGN KEY FK_4D1BE2AB148EB0CB');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6499A4AA658');
        $this->addSql('ALTER TABLE user_allergy DROP FOREIGN KEY FK_93BC5CBFA76ED395');
        $this->addSql('ALTER TABLE user_allergy DROP FOREIGN KEY FK_93BC5CBFDBFD579D');
        $this->addSql('DROP TABLE allergy');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_allergy');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE daytime');
        $this->addSql('DROP TABLE dish');
        $this->addSql('DROP TABLE guest');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_daytime');
        $this->addSql('DROP TABLE openingday');
        $this->addSql('DROP TABLE openinghour');
        $this->addSql('DROP TABLE openinghour_openingday');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE setmenu');
        $this->addSql('DROP TABLE setmenu_dish');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_allergy');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
