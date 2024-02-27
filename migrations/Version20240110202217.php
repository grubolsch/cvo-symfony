<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110202217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE album_smurf (album_id INT NOT NULL, smurf_id INT NOT NULL, INDEX IDX_2C467D581137ABCF (album_id), INDEX IDX_2C467D58F22CFF1F (smurf_id), PRIMARY KEY(album_id, smurf_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album_smurf ADD CONSTRAINT FK_2C467D581137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_smurf ADD CONSTRAINT FK_2C467D58F22CFF1F FOREIGN KEY (smurf_id) REFERENCES smurf (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album_smurf DROP FOREIGN KEY FK_2C467D581137ABCF');
        $this->addSql('ALTER TABLE album_smurf DROP FOREIGN KEY FK_2C467D58F22CFF1F');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE album_smurf');
    }
}
