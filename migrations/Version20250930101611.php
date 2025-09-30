<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250930101611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presentation ADD user_presentation_id INT NOT NULL');
        $this->addSql('ALTER TABLE presentation ADD CONSTRAINT FK_9B66E893B9BE1204 FOREIGN KEY (user_presentation_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9B66E893B9BE1204 ON presentation (user_presentation_id)');
        $this->addSql('ALTER TABLE prestation ADD user_prestation_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD70CB6804 FOREIGN KEY (user_prestation_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_51C88FAD70CB6804 ON prestation (user_prestation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presentation DROP FOREIGN KEY FK_9B66E893B9BE1204');
        $this->addSql('DROP INDEX IDX_9B66E893B9BE1204 ON presentation');
        $this->addSql('ALTER TABLE presentation DROP user_presentation_id');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD70CB6804');
        $this->addSql('DROP INDEX IDX_51C88FAD70CB6804 ON prestation');
        $this->addSql('ALTER TABLE prestation DROP user_prestation_id');
    }
}
