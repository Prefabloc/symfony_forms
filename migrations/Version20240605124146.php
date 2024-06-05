<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605124146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consommation_machine (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE identification_prestation ADD document_id VARCHAR(255) DEFAULT NULL, ADD signer_id VARCHAR(255) DEFAULT NULL, ADD pdf_sans_signature VARCHAR(255) DEFAULT NULL, CHANGE signature signature_id VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE consommation_machine');
        $this->addSql('ALTER TABLE identification_prestation ADD signature VARCHAR(255) DEFAULT NULL, DROP signature_id, DROP document_id, DROP signer_id, DROP pdf_sans_signature');
    }
}
