<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529075052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pointage (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, employe_id INT NOT NULL, arrived_at DATETIME NOT NULL, departed_at DATETIME DEFAULT NULL, INDEX IDX_7591B20F6BD1646 (site_id), INDEX IDX_7591B201B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, nom_site VARCHAR(50) NOT NULL, no_rue VARCHAR(10) DEFAULT NULL, adresse VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pointage ADD CONSTRAINT FK_7591B20F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE pointage ADD CONSTRAINT FK_7591B201B65292 FOREIGN KEY (employe_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointage DROP FOREIGN KEY FK_7591B20F6BD1646');
        $this->addSql('ALTER TABLE pointage DROP FOREIGN KEY FK_7591B201B65292');
        $this->addSql('DROP TABLE pointage');
        $this->addSql('DROP TABLE site');
    }
}
