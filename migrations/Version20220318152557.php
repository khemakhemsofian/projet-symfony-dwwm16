<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318152557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_bien DROP FOREIGN KEY FK_B7D72918962B83AD');
        $this->addSql('DROP INDEX IDX_B7D72918962B83AD ON image_bien');
        $this->addSql('ALTER TABLE image_bien CHANGE imagebiens_id lebien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_bien ADD CONSTRAINT FK_B7D72918E4ACAFB0 FOREIGN KEY (lebien_id) REFERENCES bien (id)');
        $this->addSql('CREATE INDEX IDX_B7D72918E4ACAFB0 ON image_bien (lebien_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_bien DROP FOREIGN KEY FK_B7D72918E4ACAFB0');
        $this->addSql('DROP INDEX IDX_B7D72918E4ACAFB0 ON image_bien');
        $this->addSql('ALTER TABLE image_bien CHANGE lebien_id imagebiens_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_bien ADD CONSTRAINT FK_B7D72918962B83AD FOREIGN KEY (imagebiens_id) REFERENCES bien (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B7D72918962B83AD ON image_bien (imagebiens_id)');
    }
}
