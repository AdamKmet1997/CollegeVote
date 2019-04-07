<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405155512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CD6DE06A6');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF8697D13');
        $this->addSql('DROP INDEX IDX_9474526CF8697D13 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CD6DE06A6 ON comment');
        $this->addSql('ALTER TABLE comment ADD vote_id_id INT NOT NULL, ADD comment VARCHAR(255) NOT NULL, DROP comment_id_id, DROP comment_id, CHANGE user_id_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C2E2DFC9C FOREIGN KEY (vote_id_id) REFERENCES vote (id)');
        $this->addSql('CREATE INDEX IDX_9474526C2E2DFC9C ON comment (vote_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C2E2DFC9C');
        $this->addSql('DROP INDEX IDX_9474526C2E2DFC9C ON comment');
        $this->addSql('ALTER TABLE comment ADD comment_id_id INT DEFAULT NULL, ADD comment_id INT DEFAULT NULL, DROP vote_id_id, DROP comment, CHANGE user_id_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CD6DE06A6 FOREIGN KEY (comment_id_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF8697D13 FOREIGN KEY (comment_id) REFERENCES vote (id)');
        $this->addSql('CREATE INDEX IDX_9474526CF8697D13 ON comment (comment_id)');
        $this->addSql('CREATE INDEX IDX_9474526CD6DE06A6 ON comment (comment_id_id)');
    }
}
