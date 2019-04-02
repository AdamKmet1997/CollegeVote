<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190325175623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE polling (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, voting_id_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_CA3A22509D86650F (user_id_id), INDEX IDX_CA3A2250B3228112 (voting_id_id), INDEX IDX_CA3A2250AA334807 (answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE polling ADD CONSTRAINT FK_CA3A22509D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE polling ADD CONSTRAINT FK_CA3A2250B3228112 FOREIGN KEY (voting_id_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE polling ADD CONSTRAINT FK_CA3A2250AA334807 FOREIGN KEY (answer_id) REFERENCES vote (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE polling');
    }
}
