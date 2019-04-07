<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403160524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE polling ADD support_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE polling ADD CONSTRAINT FK_CA3A2250315B405 FOREIGN KEY (support_id) REFERENCES vote (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CA3A2250315B405 ON polling (support_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE polling DROP FOREIGN KEY FK_CA3A2250315B405');
        $this->addSql('DROP INDEX UNIQ_CA3A2250315B405 ON polling');
        $this->addSql('ALTER TABLE polling DROP support_id');
    }
}
