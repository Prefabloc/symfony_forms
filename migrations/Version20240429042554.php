<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429042554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agregat_carriere_production_chargeuse (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agregat_carriere_production_mobile (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, etage1 VARCHAR(255) DEFAULT NULL, etage2 VARCHAR(255) DEFAULT NULL, etage3 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agregat_carriere_production_pelle (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agregat_concassage_production_chargeuse (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agregat_concassage_production_pelle (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE btpproduction (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exforman_production_alimentation (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prefabloc_production (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prefabloc_saisie_production (id INT AUTO_INCREMENT NOT NULL, production_id INT NOT NULL, zero_quatre DOUBLE PRECISION NOT NULL, six_dix DOUBLE PRECISION NOT NULL, cem DOUBLE PRECISION NOT NULL, adjuvant DOUBLE PRECISION NOT NULL, huile DOUBLE PRECISION NOT NULL, eau DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_2E4D1A1FECC6147F (production_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production_article (id INT AUTO_INCREMENT NOT NULL, societe_id INT NOT NULL, reference VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_172F83BBFCF77503 (societe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prefabloc_saisie_production ADD CONSTRAINT FK_2E4D1A1FECC6147F FOREIGN KEY (production_id) REFERENCES prefabloc_production (id)');
        $this->addSql('ALTER TABLE production_article ADD CONSTRAINT FK_172F83BBFCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prefabloc_saisie_production DROP FOREIGN KEY FK_2E4D1A1FECC6147F');
        $this->addSql('ALTER TABLE production_article DROP FOREIGN KEY FK_172F83BBFCF77503');
        $this->addSql('DROP TABLE agregat_carriere_production_chargeuse');
        $this->addSql('DROP TABLE agregat_carriere_production_mobile');
        $this->addSql('DROP TABLE agregat_carriere_production_pelle');
        $this->addSql('DROP TABLE agregat_concassage_production_chargeuse');
        $this->addSql('DROP TABLE agregat_concassage_production_pelle');
        $this->addSql('DROP TABLE btpproduction');
        $this->addSql('DROP TABLE exforman_production_alimentation');
        $this->addSql('DROP TABLE prefabloc_production');
        $this->addSql('DROP TABLE prefabloc_saisie_production');
        $this->addSql('DROP TABLE production_article');
        $this->addSql('DROP TABLE societe');
    }
}
