<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326132118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE polling DROP FOREIGN KEY FK_CA3A2250AA334807');
        $this->addSql('DROP INDEX IDX_CA3A2250AA334807 ON polling');
        $this->addSql('ALTER TABLE polling ADD ans VARCHAR(255) NOT NULL, DROP answer_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE polling ADD answer_id INT NOT NULL, DROP ans');
        $this->addSql('ALTER TABLE polling ADD CONSTRAINT FK_CA3A2250AA334807 FOREIGN KEY (answer_id) REFERENCES vote (id)');
        $this->addSql('CREATE INDEX IDX_CA3A2250AA334807 ON polling (answer_id)');
    }
}
