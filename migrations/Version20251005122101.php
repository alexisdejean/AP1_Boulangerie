<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251005122101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF041736E95');
        $this->addSql('DROP INDEX IDX_8F91ABF041736E95 ON avis');
        $this->addSql('ALTER TABLE avis CHANGE user_avis_id utilisateur_avis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF06375870D FOREIGN KEY (utilisateur_avis_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF06375870D ON avis (utilisateur_avis_id)');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63840C6E3A6');
        $this->addSql('DROP INDEX IDX_4C62E63840C6E3A6 ON contact');
        $this->addSql('ALTER TABLE contact CHANGE user_contact_id utilisateur_contact_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638D519E75C FOREIGN KEY (utilisateur_contact_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638D519E75C ON contact (utilisateur_contact_id)');
        $this->addSql('ALTER TABLE presentation DROP FOREIGN KEY FK_9B66E893B9BE1204');
        $this->addSql('DROP INDEX IDX_9B66E893B9BE1204 ON presentation');
        $this->addSql('ALTER TABLE presentation CHANGE user_presentation_id utilisateur_presentation_id INT NOT NULL');
        $this->addSql('ALTER TABLE presentation ADD CONSTRAINT FK_9B66E893BEBBC1FD FOREIGN KEY (utilisateur_presentation_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_9B66E893BEBBC1FD ON presentation (utilisateur_presentation_id)');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD70CB6804');
        $this->addSql('DROP INDEX IDX_51C88FAD70CB6804 ON prestation');
        $this->addSql('ALTER TABLE prestation CHANGE user_prestation_id utilisateur_prestation_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADBA9894D6 FOREIGN KEY (utilisateur_prestation_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_51C88FADBA9894D6 ON prestation (utilisateur_prestation_id)');
        $this->addSql('ALTER TABLE utilisateur ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF06375870D');
        $this->addSql('DROP INDEX IDX_8F91ABF06375870D ON avis');
        $this->addSql('ALTER TABLE avis CHANGE utilisateur_avis_id user_avis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF041736E95 FOREIGN KEY (user_avis_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF041736E95 ON avis (user_avis_id)');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638D519E75C');
        $this->addSql('DROP INDEX IDX_4C62E638D519E75C ON contact');
        $this->addSql('ALTER TABLE contact CHANGE utilisateur_contact_id user_contact_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63840C6E3A6 FOREIGN KEY (user_contact_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4C62E63840C6E3A6 ON contact (user_contact_id)');
        $this->addSql('ALTER TABLE presentation DROP FOREIGN KEY FK_9B66E893BEBBC1FD');
        $this->addSql('DROP INDEX IDX_9B66E893BEBBC1FD ON presentation');
        $this->addSql('ALTER TABLE presentation CHANGE utilisateur_presentation_id user_presentation_id INT NOT NULL');
        $this->addSql('ALTER TABLE presentation ADD CONSTRAINT FK_9B66E893B9BE1204 FOREIGN KEY (user_presentation_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9B66E893B9BE1204 ON presentation (user_presentation_id)');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADBA9894D6');
        $this->addSql('DROP INDEX IDX_51C88FADBA9894D6 ON prestation');
        $this->addSql('ALTER TABLE prestation CHANGE utilisateur_prestation_id user_prestation_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD70CB6804 FOREIGN KEY (user_prestation_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_51C88FAD70CB6804 ON prestation (user_prestation_id)');
        $this->addSql('ALTER TABLE utilisateur DROP is_verified');
    }
}
