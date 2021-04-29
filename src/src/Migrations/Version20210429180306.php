<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210429180306 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE band (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE band_artist (band_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_F81CAB5649ABEB17 (band_id), INDEX IDX_F81CAB56B7970CF8 (artist_id), PRIMARY KEY(band_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE band_album (band_id INT NOT NULL, album_id INT NOT NULL, INDEX IDX_C57AD0DF49ABEB17 (band_id), INDEX IDX_C57AD0DF1137ABCF (album_id), PRIMARY KEY(band_id, album_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE band_artist ADD CONSTRAINT FK_F81CAB5649ABEB17 FOREIGN KEY (band_id) REFERENCES band (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE band_artist ADD CONSTRAINT FK_F81CAB56B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE band_album ADD CONSTRAINT FK_C57AD0DF49ABEB17 FOREIGN KEY (band_id) REFERENCES band (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE band_album ADD CONSTRAINT FK_C57AD0DF1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE address CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avaliation CHANGE user_id user_id INT DEFAULT NULL, CHANGE music_id music_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE credit_card CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE band_artist DROP FOREIGN KEY FK_F81CAB5649ABEB17');
        $this->addSql('ALTER TABLE band_album DROP FOREIGN KEY FK_C57AD0DF49ABEB17');
        $this->addSql('DROP TABLE band');
        $this->addSql('DROP TABLE band_artist');
        $this->addSql('DROP TABLE band_album');
        $this->addSql('ALTER TABLE address CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avaliation CHANGE user_id user_id INT DEFAULT NULL, CHANGE music_id music_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE credit_card CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
