<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250930115042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF062B21BE7');
        $this->addSql('DROP INDEX IDX_8F91ABF062B21BE7 ON avis');
        $this->addSql('ALTER TABLE avis CHANGE id_user_avis_id user_avis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF041736E95 FOREIGN KEY (user_avis_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF041736E95 ON avis (user_avis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF041736E95');
        $this->addSql('DROP INDEX IDX_8F91ABF041736E95 ON avis');
        $this->addSql('ALTER TABLE avis CHANGE user_avis_id id_user_avis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF062B21BE7 FOREIGN KEY (id_user_avis_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF062B21BE7 ON avis (id_user_avis_id)');
    }
}
