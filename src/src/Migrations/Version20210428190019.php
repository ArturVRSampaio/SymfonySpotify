<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428190019 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE avaliation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, music_id INT DEFAULT NULL, INDEX IDX_6EDCC7EFA76ED395 (user_id), INDEX IDX_6EDCC7EF399BBB13 (music_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avaliation ADD CONSTRAINT FK_6EDCC7EFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avaliation ADD CONSTRAINT FK_6EDCC7EF399BBB13 FOREIGN KEY (music_id) REFERENCES music (id)');
        $this->addSql('ALTER TABLE address CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE credit_card CHANGE user_id user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE avaliation');
        $this->addSql('ALTER TABLE address CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE credit_card CHANGE user_id user_id INT DEFAULT NULL');
    }
}
