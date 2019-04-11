<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190411115059 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA59D86650F');
        $this->addSql('DROP INDEX IDX_8004EBA59D86650F ON support');
        $this->addSql('ALTER TABLE support CHANGE user_id_id username_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA5FC1EE0EB FOREIGN KEY (username_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8004EBA5FC1EE0EB ON support (username_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA5FC1EE0EB');
        $this->addSql('DROP INDEX IDX_8004EBA5FC1EE0EB ON support');
        $this->addSql('ALTER TABLE support CHANGE username_id_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA59D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8004EBA59D86650F ON support (user_id_id)');
    }
}
