<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190411160305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE supporting (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, vote_id INT NOT NULL, INDEX IDX_F5BBEA5AA76ED395 (user_id), INDEX IDX_F5BBEA5A72DCDAFC (vote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE supporting ADD CONSTRAINT FK_F5BBEA5AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE supporting ADD CONSTRAINT FK_F5BBEA5A72DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE vote DROP support_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE supporting');
        $this->addSql('ALTER TABLE vote ADD support_id INT NOT NULL');
    }
}
