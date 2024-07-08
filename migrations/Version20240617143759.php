<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617143759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493C105691');
        $this->addSql('CREATE TABLE recette_user (recette_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C0933C1289312FE9 (recette_id), INDEX IDX_C0933C12A76ED395 (user_id), PRIMARY KEY(recette_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recette_user ADD CONSTRAINT FK_C0933C1289312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_user ADD CONSTRAINT FK_C0933C12A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8443C105691');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844C72A4771');
        $this->addSql('ALTER TABLE recette_coach DROP FOREIGN KEY FK_C3ADE55A3C105691');
        $this->addSql('ALTER TABLE recette_coach DROP FOREIGN KEY FK_C3ADE55A89312FE9');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE recette_coach');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP INDEX IDX_8D93D6493C105691 ON user');
        $this->addSql('ALTER TABLE user DROP coach_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, coach_id INT DEFAULT NULL, subscribe_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FE38F8443C105691 (coach_id), INDEX IDX_FE38F844C72A4771 (subscribe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recette_coach (recette_id INT NOT NULL, coach_id INT NOT NULL, INDEX IDX_C3ADE55A89312FE9 (recette_id), INDEX IDX_C3ADE55A3C105691 (coach_id), PRIMARY KEY(recette_id, coach_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, age INT NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, salary INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8443C105691 FOREIGN KEY (coach_id) REFERENCES coach (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844C72A4771 FOREIGN KEY (subscribe_id) REFERENCES abonner (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE recette_coach ADD CONSTRAINT FK_C3ADE55A3C105691 FOREIGN KEY (coach_id) REFERENCES coach (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_coach ADD CONSTRAINT FK_C3ADE55A89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_user DROP FOREIGN KEY FK_C0933C1289312FE9');
        $this->addSql('ALTER TABLE recette_user DROP FOREIGN KEY FK_C0933C12A76ED395');
        $this->addSql('DROP TABLE recette_user');
        $this->addSql('ALTER TABLE `user` ADD coach_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6493C105691 FOREIGN KEY (coach_id) REFERENCES coach (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D6493C105691 ON `user` (coach_id)');
    }
}
