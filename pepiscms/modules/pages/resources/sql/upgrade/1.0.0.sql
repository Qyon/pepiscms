SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE cms_menu CHANGE `item_url` `item_url` VARCHAR(512)  NOT NULL DEFAULT '' COMMENT 'Used only when page_id is NULL';

DROP TABLE IF EXISTS cms_remote_applications;

SET FOREIGN_KEY_CHECKS=1;