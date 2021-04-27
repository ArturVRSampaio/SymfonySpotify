<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427144052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7DA76ED395');
        $this->addSql('DROP INDEX IDX_DD5A5B7DA76ED395 ON plan');
        $this->addSql('ALTER TABLE plan DROP user_id');
        $this->addSql('ALTER TABLE user ADD plan_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E899029B FOREIGN KEY (plan_id) REFERENCES plan (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E899029B ON user (plan_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plan ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DD5A5B7DA76ED395 ON plan (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E899029B');
        $this->addSql('DROP INDEX IDX_8D93D649E899029B ON user');
        $this->addSql('ALTER TABLE user DROP plan_id');
    }
}
