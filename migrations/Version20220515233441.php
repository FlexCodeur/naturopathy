<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220515233441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD media_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66EA9FDD75 ON article (media_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C7294869C');
        $this->addSql('DROP INDEX IDX_6A2CA10C7294869C ON media');
        $this->addSql('ALTER TABLE media DROP articles_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66EA9FDD75');
        $this->addSql('DROP INDEX IDX_23A0E66EA9FDD75 ON article');
        $this->addSql('ALTER TABLE article DROP media_id');
        $this->addSql('ALTER TABLE media ADD articles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C7294869C FOREIGN KEY (articles_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C7294869C ON media (articles_id)');
    }
}
