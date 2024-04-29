<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429083906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonner DROP FOREIGN KEY FK_D1C23F0AFB88E14F');
        $this->addSql('DROP INDEX UNIQ_D1C23F0AFB88E14F ON abonner');
        $this->addSql('ALTER TABLE abonner CHANGE utilisateur_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE abonner ADD CONSTRAINT FK_D1C23F0AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D1C23F0AA76ED395 ON abonner (user_id)');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EFB88E14F');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EC72A4771');
        $this->addSql('DROP INDEX IDX_B1DC7A1EFB88E14F ON paiement');
        $this->addSql('ALTER TABLE paiement CHANGE utilisateur_id subscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E9A1887DC FOREIGN KEY (subscription_id) REFERENCES abonnement (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EC72A4771 FOREIGN KEY (subscribe_id) REFERENCES abonner (id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1E9A1887DC ON paiement (subscription_id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonner DROP FOREIGN KEY FK_D1C23F0AA76ED395');
        $this->addSql('DROP INDEX UNIQ_D1C23F0AA76ED395 ON abonner');
        $this->addSql('ALTER TABLE abonner CHANGE user_id utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE abonner ADD CONSTRAINT FK_D1C23F0AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D1C23F0AFB88E14F ON abonner (utilisateur_id)');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E9A1887DC');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EC72A4771');
        $this->addSql('DROP INDEX IDX_B1DC7A1E9A1887DC ON paiement');
        $this->addSql('ALTER TABLE paiement CHANGE subscription_id utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES abonner (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EC72A4771 FOREIGN KEY (subscribe_id) REFERENCES abonnement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EFB88E14F ON paiement (utilisateur_id)');
        $this->addSql('ALTER TABLE `user` DROP is_verified');
    }
}
