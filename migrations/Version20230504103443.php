<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504103443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD plat_id INT DEFAULT NULL, ADD texte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FD73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FEA6DF1F1 FOREIGN KEY (texte_id) REFERENCES texte (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FD73DB560 ON image (plat_id)');
        $this->addSql('CREATE INDEX IDX_C53D045FEA6DF1F1 ON image (texte_id)');
        $this->addSql('ALTER TABLE texte ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE texte ADD CONSTRAINT FK_EAE1A6EEA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_EAE1A6EEA21214B7 ON texte (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FD73DB560');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FEA6DF1F1');
        $this->addSql('DROP INDEX IDX_C53D045FD73DB560 ON image');
        $this->addSql('DROP INDEX IDX_C53D045FEA6DF1F1 ON image');
        $this->addSql('ALTER TABLE image DROP plat_id, DROP texte_id');
        $this->addSql('ALTER TABLE texte DROP FOREIGN KEY FK_EAE1A6EEA21214B7');
        $this->addSql('DROP INDEX IDX_EAE1A6EEA21214B7 ON texte');
        $this->addSql('ALTER TABLE texte DROP categories_id');
    }
}
