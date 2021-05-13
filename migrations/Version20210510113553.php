<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510113553 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE land_user (land_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1E67ED801994904A (land_id), INDEX IDX_1E67ED80A76ED395 (user_id), PRIMARY KEY(land_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE land_user ADD CONSTRAINT FK_1E67ED801994904A FOREIGN KEY (land_id) REFERENCES land (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE land_user ADD CONSTRAINT FK_1E67ED80A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE land_user');
    }
}
