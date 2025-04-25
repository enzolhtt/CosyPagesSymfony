<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250425115510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE auteurs_livres (auteurs_id INT NOT NULL, livres_id INT NOT NULL, INDEX IDX_7BB9D45BAE784107 (auteurs_id), INDEX IDX_7BB9D45BEBF07F38 (livres_id), PRIMARY KEY(auteurs_id, livres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE auteurs_livres ADD CONSTRAINT FK_7BB9D45BAE784107 FOREIGN KEY (auteurs_id) REFERENCES auteurs (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE auteurs_livres ADD CONSTRAINT FK_7BB9D45BEBF07F38 FOREIGN KEY (livres_id) REFERENCES livres (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE livres ADD genres_id INT DEFAULT NULL, ADD editeurs_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE livres ADD CONSTRAINT FK_927187A46A3B2603 FOREIGN KEY (genres_id) REFERENCES genres (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE livres ADD CONSTRAINT FK_927187A4AB2BD8C6 FOREIGN KEY (editeurs_id) REFERENCES editeurs (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_927187A46A3B2603 ON livres (genres_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_927187A4AB2BD8C6 ON livres (editeurs_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE auteurs_livres DROP FOREIGN KEY FK_7BB9D45BAE784107
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE auteurs_livres DROP FOREIGN KEY FK_7BB9D45BEBF07F38
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auteurs_livres
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE livres DROP FOREIGN KEY FK_927187A46A3B2603
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE livres DROP FOREIGN KEY FK_927187A4AB2BD8C6
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_927187A46A3B2603 ON livres
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_927187A4AB2BD8C6 ON livres
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE livres DROP genres_id, DROP editeurs_id
        SQL);
    }
}
