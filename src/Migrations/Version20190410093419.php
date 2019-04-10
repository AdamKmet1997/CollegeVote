<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190410093419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE support');
        $this->addSql('ALTER TABLE vote CHANGE support likes INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE support (id INT AUTO_INCREMENT NOT NULL, supporter_id_id INT DEFAULT NULL, question_id_id INT DEFAULT NULL, INDEX IDX_8004EBA5B1D8A5D (supporter_id_id), INDEX IDX_8004EBA54FAF8F53 (question_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA54FAF8F53 FOREIGN KEY (question_id_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA5B1D8A5D FOREIGN KEY (supporter_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vote CHANGE likes support INT DEFAULT NULL');
    }
}
