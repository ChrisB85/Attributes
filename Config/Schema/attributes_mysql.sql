-- -----------------------------------------------------
-- Drops
-- -----------------------------------------------------

DROP TABLE IF EXISTS attribute_types;
DROP TABLE IF EXISTS attributes;
DROP TABLE IF EXISTS attribute_options;


-- -----------------------------------------------------
-- Table alternate_logins
-- -----------------------------------------------------

CREATE	TABLE IF NOT EXISTS attribute_types (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	entity_id INT UNSIGNED NOT NULL,
	ordering INT UNSIGNED NOT NULL,
	is_public TINYINT(1) NOT NULL,
	is_multiple TINYINT(1) NOT NULL,
	use_option TINYINT(1) NOT NULL,
	is_required TINYINT(1) NOT NULL,
	input_type INT(2) UNSIGNED NOT NULL,
	regexp_validation VARCHAR(150) NOT NULL,
	moment VARCHAR(10) NOT NULL, -- create / update / both
	code VARCHAR(45) NOT NULL,
	message VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE attribute_types ADD INDEX atttyp_ent_idx (entity_id ASC);


-- -----------------------------------------------------
-- Table alternate_logins
-- -----------------------------------------------------

CREATE	TABLE IF NOT EXISTS attributes (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	attribute_type_id INT UNSIGNED NOT NULL,
	parent_entityid INT UNSIGNED NOT NULL,
	value VARCHAR(200) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE attributes ADD INDEX att_atttyp_idx (attribute_type_id ASC);

-- -----------------------------------------------------
-- Table alternate_logins
-- -----------------------------------------------------

CREATE	TABLE IF NOT EXISTS attribute_options (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	attribute_type_id INT UNSIGNED NOT NULL,
	code VARCHAR(45) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE attributes ADD INDEX attopt_atttyp_idx (attribute_type_id ASC);

-- -----------------------------------------------------
-- Constraints
-- -----------------------------------------------------

ALTER TABLE attribute_types ADD
CONSTRAINT atttyp_ent_fk FOREIGN KEY (entity_id) REFERENCES entities (id)
ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE attributes ADD
CONSTRAINT att_atttyp_fk FOREIGN KEY (attribute_type_id) REFERENCES attribute_types (id)
ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE attribute_options ADD
CONSTRAINT attopt_atttyp_fk FOREIGN KEY (attribute_type_id) REFERENCES attribute_types (id)
ON DELETE NO ACTION ON UPDATE NO ACTION;


-- -----------------------------------------------------
-- Views
-- -----------------------------------------------------

CREATE VIEW view_attributes AS
SELECT
attributes.id,
attributes.value,
attributes.parent_entityid,
attributes.attribute_type_id,
attribute_types.id AS attribute_types_id,
attribute_types.code,
attribute_types.ordering,
attribute_types.is_public,
attribute_types.is_required,
attribute_types.is_multiple,
attribute_types.use_option,
attribute_types.input_type,
attribute_types.moment,
Entity.id AS entity_id,
Entity.alias AS entity_alias
FROM attribute_types	
JOIN attributes ON attributes.attribute_type_id = attribute_types.id
LEFT JOIN entities Entity ON Entity.id = attribute_types.entity_id;

