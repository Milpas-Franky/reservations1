<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220421112239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists_types DROP FOREIGN KEY FK_29173A3A8EB23357');
        $this->addSql('ALTER TABLE artists_types DROP FOREIGN KEY FK_29173A3A54A05007');
        $this->addSql('DROP INDEX IDX_29173A3A54A05007 ON artists_types');
        $this->addSql('ALTER TABLE artists_types ADD id INT AUTO_INCREMENT NOT NULL, ADD artist_id INT NOT NULL, ADD type_id INT NOT NULL, DROP artists_id, DROP types_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE artists_types ADD CONSTRAINT FK_29173A3AB7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id)');
        $this->addSql('ALTER TABLE artists_types ADD CONSTRAINT FK_29173A3AC54C8C93 FOREIGN KEY (type_id) REFERENCES types (id)');
        $this->addSql('CREATE INDEX IDX_29173A3AB7970CF8 ON artists_types (artist_id)');
        $this->addSql('CREATE INDEX IDX_29173A3AC54C8C93 ON artists_types (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists_types MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE artists_types DROP FOREIGN KEY FK_29173A3AB7970CF8');
        $this->addSql('ALTER TABLE artists_types DROP FOREIGN KEY FK_29173A3AC54C8C93');
        $this->addSql('DROP INDEX IDX_29173A3AB7970CF8 ON artists_types');
        $this->addSql('DROP INDEX IDX_29173A3AC54C8C93 ON artists_types');
        $this->addSql('ALTER TABLE artists_types DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE artists_types ADD artists_id INT NOT NULL, ADD types_id INT NOT NULL, DROP id, DROP artist_id, DROP type_id');
        $this->addSql('ALTER TABLE artists_types ADD CONSTRAINT FK_29173A3A8EB23357 FOREIGN KEY (types_id) REFERENCES types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artists_types ADD CONSTRAINT FK_29173A3A54A05007 FOREIGN KEY (artists_id) REFERENCES artists (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_29173A3A54A05007 ON artists_types (artists_id)');
        $this->addSql('CREATE INDEX IDX_29173A3A8EB23357 ON artists_types (types_id)');
        $this->addSql('ALTER TABLE artists_types ADD PRIMARY KEY (artists_id, types_id)');
    }
}
