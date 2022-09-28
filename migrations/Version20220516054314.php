<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516054314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66EA9FDD75');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1EA9FDD75');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66EA9FDD75');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1EA9FDD75');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
    }
}
