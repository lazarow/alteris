<?php
namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160921175335 extends AbstractMigration
{
    public static $description = "Create the database structure";

    public function up(MetadataInterface $schema)
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS `material_group` (
			`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
			`idParent` int(10) UNSIGNED DEFAULT NULL,
			`name` varchar(64) NOT NULL,
			`createdAt` timestamp NOT NULL,
			`modifiedAt` timestamp NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
		$this->addSql('ALTER TABLE material_group ADD CONSTRAINT fk_material_group_idParent FOREIGN KEY (idParent) '
			. 'REFERENCES material_group(id)');
		$this->addSql('CREATE TABLE `unit` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , '
			. '`name` VARCHAR(64) NOT NULL , `abbreviation` VARCHAR(16) NOT NULL , '
			. '`createdAt` TIMESTAMP NOT NULL , `modifiedAt` TIMESTAMP NOT NULL , '
			. 'PRIMARY KEY (`id`), UNIQUE (`name`), UNIQUE (`abbreviation`)) ENGINE = InnoDB;');
		$this->addSql('CREATE TABLE `material` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , '
			. '`idGroup` INT UNSIGNED NOT NULL , `idUnit` INT UNSIGNED NOT NULL , `code` VARCHAR(16) NOT NULL , '
			. '`name` VARCHAR(64) NOT NULL , `createdAt` TIMESTAMP NOT NULL , `modifiedAt` TIMESTAMP NOT NULL , '
			. 'PRIMARY KEY (`id`), UNIQUE (`code`), UNIQUE (`name`)) ENGINE = InnoDB;');
		$this->addSql('ALTER TABLE material ADD CONSTRAINT fk_material_idGroup FOREIGN KEY (idGroup) '
			. 'REFERENCES material_group(id)');
		$this->addSql('ALTER TABLE material ADD CONSTRAINT fk_material_idUnit FOREIGN KEY (idunit) '
			. 'REFERENCES unit(id)');
    }

    public function down(MetadataInterface $schema)
    {
		$this->addSql('ALTER TABLE material_group DROP FOREIGN KEY fk_material_idUnit;');
		$this->addSql('ALTER TABLE material_group DROP FOREIGN KEY fk_material_idGroup;');
		$this->addSql('DROP TABLE IF EXISTS `material`;');
		$this->addSql('DROP TABLE IF EXISTS `unit`;');
		$this->addSql('ALTER TABLE material_group DROP FOREIGN KEY fk_material_group_idParent;');
        $this->addSql('DROP TABLE IF EXISTS `material_group`;');
    }
}
