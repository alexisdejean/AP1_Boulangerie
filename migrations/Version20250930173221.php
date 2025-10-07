<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250930173221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, DROP mail_user, DROP identifiant_user, DROP mdp_user, CHANGE nom_user nom_user VARCHAR(255) DEFAULT NULL, CHANGE prenom_user prenom_user VARCHAR(255) DEFAULT NULL, CHANGE numero_user numero_user VARCHAR(255) DEFAULT NULL, CHANGE type_user type_user VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD identifiant_user VARCHAR(255) NOT NULL, ADD mdp_user VARCHAR(255) NOT NULL, DROP email, DROP roles, CHANGE nom_user nom_user VARCHAR(255) NOT NULL, CHANGE prenom_user prenom_user VARCHAR(255) NOT NULL, CHANGE numero_user numero_user VARCHAR(255) NOT NULL, CHANGE type_user type_user VARCHAR(255) NOT NULL, CHANGE password mail_user VARCHAR(255) NOT NULL');
    }
}
