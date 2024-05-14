<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513121456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD can_be_produced TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE article RENAME INDEX idx_172f83bbfcf77503 TO IDX_23A0E66FCF77503');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP can_be_produced');
        $this->addSql('ALTER TABLE article RENAME INDEX idx_23a0e66fcf77503 TO IDX_172F83BBFCF77503');
    }
}
