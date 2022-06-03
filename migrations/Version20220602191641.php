<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602191641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pizza_order ADD size_id INT NOT NULL');
        $this->addSql('ALTER TABLE pizza_order ADD CONSTRAINT FK_3589140498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('CREATE INDEX IDX_3589140498DA827 ON pizza_order (size_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pizza_order DROP FOREIGN KEY FK_3589140498DA827');
        $this->addSql('DROP INDEX IDX_3589140498DA827 ON pizza_order');
        $this->addSql('ALTER TABLE pizza_order DROP size_id');
    }
}
