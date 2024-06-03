<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603111848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointage DROP FOREIGN KEY FK_7591B201B65292');
        $this->addSql('ALTER TABLE pointage DROP FOREIGN KEY FK_7591B20F6BD1646');
        $this->addSql('DROP TABLE pointage');
        $this->addSql('DROP TABLE site');
        $this->addSql('ALTER TABLE identification_prestation CHANGE pdf_sans_signature signature VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pointage (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, employe_id INT NOT NULL, arrived_at DATETIME NOT NULL, departed_at DATETIME DEFAULT NULL, INDEX IDX_7591B201B65292 (employe_id), INDEX IDX_7591B20F6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, nom_site VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, no_rue VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pointage ADD CONSTRAINT FK_7591B201B65292 FOREIGN KEY (employe_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE pointage ADD CONSTRAINT FK_7591B20F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE identification_prestation CHANGE signature pdf_sans_signature VARCHAR(255) DEFAULT NULL');
    }
}
