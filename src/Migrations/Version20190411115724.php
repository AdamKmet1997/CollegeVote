<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190411115724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA595031F7D');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA5ED766068');
        $this->addSql('DROP INDEX IDX_8004EBA595031F7D ON support');
        $this->addSql('DROP INDEX IDX_8004EBA5ED766068 ON support');
        $this->addSql('ALTER TABLE support ADD user_id INT NOT NULL, ADD vote_id INT NOT NULL, DROP username_id, DROP voteid_id');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA572DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id)');
        $this->addSql('CREATE INDEX IDX_8004EBA5A76ED395 ON support (user_id)');
        $this->addSql('CREATE INDEX IDX_8004EBA572DCDAFC ON support (vote_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA5A76ED395');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA572DCDAFC');
        $this->addSql('DROP INDEX IDX_8004EBA5A76ED395 ON support');
        $this->addSql('DROP INDEX IDX_8004EBA572DCDAFC ON support');
        $this->addSql('ALTER TABLE support ADD username_id INT DEFAULT NULL, ADD voteid_id INT DEFAULT NULL, DROP user_id, DROP vote_id');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA595031F7D FOREIGN KEY (voteid_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA5ED766068 FOREIGN KEY (username_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8004EBA595031F7D ON support (voteid_id)');
        $this->addSql('CREATE INDEX IDX_8004EBA5ED766068 ON support (username_id)');
    }
}
