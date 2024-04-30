<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430091307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonner ADD subscription_id INT NOT NULL, DROP subscription');
        $this->addSql('ALTER TABLE abonner ADD CONSTRAINT FK_D1C23F0A9A1887DC FOREIGN KEY (subscription_id) REFERENCES abonnement (id)');
        $this->addSql('CREATE INDEX IDX_D1C23F0A9A1887DC ON abonner (subscription_id)');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E9A1887DC');
        $this->addSql('DROP INDEX IDX_B1DC7A1E9A1887DC ON paiement');
        $this->addSql('ALTER TABLE paiement DROP subscription_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement ADD subscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E9A1887DC FOREIGN KEY (subscription_id) REFERENCES abonnement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B1DC7A1E9A1887DC ON paiement (subscription_id)');
        $this->addSql('ALTER TABLE abonner DROP FOREIGN KEY FK_D1C23F0A9A1887DC');
        $this->addSql('DROP INDEX IDX_D1C23F0A9A1887DC ON abonner');
        $this->addSql('ALTER TABLE abonner ADD subscription VARCHAR(255) NOT NULL, DROP subscription_id');
    }
}
