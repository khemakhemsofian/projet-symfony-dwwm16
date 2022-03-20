<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220316144446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mail DROP FOREIGN KEY FK_5126AC48BD95B80F');
        $this->addSql('DROP INDEX IDX_5126AC48BD95B80F ON mail');
        $this->addSql('ALTER TABLE mail DROP bien_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mail ADD bien_id INT NOT NULL');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC48BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5126AC48BD95B80F ON mail (bien_id)');
    }
}
